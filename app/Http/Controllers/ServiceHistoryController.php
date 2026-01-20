<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ServiceHistory;
use App\Models\Booking;
use Stripe\ApiOperations\All;

class ServiceHistoryController extends Controller
{
    public function index(Request $request)
    {
        // Base query with relationships
        $query = ServiceHistory::with(['booking.motorcycle', 'user']);

        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('service_type', 'like', "%{$search}%")
                  ->orWhere('final_price', 'like', "%{$search}%")
                  ->orWhereHas('booking.motorcycle', function($mq) use ($search) {
                      $mq->where('brand', 'like', "%{$search}%")
                         ->orWhere('model', 'like', "%{$search}%")
                         ->orWhere('plate_number', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('id', 'like', "%{$search}%");
                  });
            });
        }

        // ✅ Role-based branching
        if (Auth::user()->role === 'workshop_owner') {
            // Workshop owner sees ALL records
            $records = $query->latest()->get();
            return view('workshop_owner.manage_history', compact('records'));
        } else {
            // Normal user sees ONLY their own records
            $records = $query->whereHas('booking', function ($q) {
                $q->where('user_id', Auth::id());
            })->latest()->get();

            return view('home.service_history', compact('records'));
        }
    }
    public function add_record()
    {
        // Get all bookings that have been paid
        $paidBookings = Booking::where('status', 'paid')
            ->with(['motorcycle', 'bookingApproval', 'user'])
            ->get();

        return view('workshop_owner.add_record', compact('paidBookings'));
    }
    public function save_record(Request $request)
    {
        $booking = Booking::findOrFail($request->booking_id);

        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'service_date' => 'required|date',
            'time_slot' => 'required|string',
            'final_price' => 'required|numeric|min:1.00',
            'remarks' => 'nullable|string',
        ]);

        // ✅ Create service history record
        ServiceHistory::create([
            'booking_id' => $request->booking_id,
            'user_id' => $booking->user_id,
            'service_type' => $booking->service_type,
            'service_date' => $request->service_date,
            'time_slot' => $request->time_slot,
            'final_price' => $request->final_price,
            'remarks' => $request->remarks
        ]);

        // ✅ Update booking status from 'paid' → 'completed'
        $booking->update([
            'status' => 'completed'
        ]);

        return redirect()->route('service_history')->with('success', 'Service record added successfully.');
    }
    public function edit_record($id)
    {
        $record = ServiceHistory::findOrFail($id);

        // Get all bookings that have been paid (same as add_record)
        $paidBookings = Booking::where('status', 'paid')
            ->with(['motorcycle', 'bookingApproval', 'user'])
            ->get();

        return view('workshop_owner.edit_record', compact('record', 'paidBookings'));
    }
    public function update_record(Request $request, $id)
    {
        $record = ServiceHistory::findOrFail($id);
        $booking = Booking::findOrFail($request->booking_id);

        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'service_date' => 'required|date',
            'final_price' => 'required|numeric|min:1.00',
            'remarks' => 'nullable|string',
        ]);

        $record->update([
            'booking_id' => $request->booking_id,
            'user_id' => $booking->user_id,
            'service_type' => $booking->service_type,
            'service_date' => $request->service_date,
            'final_price' => $request->final_price,
            'remarks' => $request->remarks
        ]);

        return redirect()->route('service_history')->with('success', 'Service record updated successfully.');
    }
    public function delete_record($id)
    {
        $record = ServiceHistory::findOrFail($id);

        // ✅ Revert booking status back to 'paid'
        $booking = $record->booking;
        if ($booking && $booking->status === 'completed') {
            $booking->update(['status' => 'paid']);
        }

        $record->delete();

        return redirect()->route('service_history')->with('success', 'Service record deleted successfully and booking reverted to paid.');
    }

}
