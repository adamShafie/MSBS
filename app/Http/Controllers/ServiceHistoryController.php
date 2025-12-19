<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ServiceHistory;
use App\Models\Booking;
use Stripe\ApiOperations\All;

class ServiceHistoryController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'workshop_owner') {
            $records = ServiceHistory::with('booking')->latest()->get();
            return view('workshop_owner.manage_history', compact('records'));
        }

        // User: view own service history only
        $records = ServiceHistory::whereHas('booking', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->get();

        return view('home.service_history', compact('records'));
    }
    public function add_record()
    {
        $approvedBookings = Booking::where('status', 'approved')->get();
        return view('workshop_owner.add_record', compact('approvedBookings'));
    }
    public function save_record(Request $request)
    {
        $booking = Booking::findOrFail($request->booking_id);
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'service_date' => 'required|date',
            'final_price' => 'required|numeric|min:1.00',
            'remarks' => 'nullable|string',
        ]);

        ServiceHistory::create([
            'booking_id' => $request->booking_id,
            'user_id' => $booking->user_id,
            'service_type' => $booking->service_type,
            'service_date' => $request->service_date,
            'final_price' => $request->final_price,
            'remarks' => $request->remarks
        ]);
        return redirect()->route('service_history')->with('success', 'Service record added successfully.');
    }
    public function edit_record($id)
    {
        $record = ServiceHistory::findOrFail($id);
        $approvedBookings = Booking::where('status', 'approved')->get();
        return view('workshop_owner.edit_record', compact('record', 'approvedBookings'));
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
        $record->delete();
        return redirect()->route('service_history')->with('success', 'Service record deleted successfully.');
    }
}
