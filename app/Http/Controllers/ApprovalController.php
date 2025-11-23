<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingApproval;
use App\Models\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ApprovalController extends Controller
{
    public function booking_details($id)
    {
        $booking = Booking::findOrFail($id);
        return view('workshop_owner.booking_details', compact('booking'));
    }
    public function set_price(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        BookingApproval::updateOrCreate(
            [
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'quoted_price' => $request->quoted_price,
                'decision' => 'approved',
                'approved_at' => now()
            ]
        );
        Payment::create([
            'booking_id' => $booking->id,
            'paid_amount' => 0.00,
            'transaction_ref' => 'PENDING',
            'payment_status' => 'PENDING',
            'payment_date' => null,
        ]);
        $booking->status = 'approved';
        $booking->save();
        return redirect()->route('view_bookings', $id)->with('success', 'Quoted price set successfully!');
    }
    public function reject_booking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        BookingApproval::updateOrCreate(
            [
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'decision' => 'rejected',
                'approved_at' => now()
            ]
        );
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->route('view_bookings', $id)->with('success', 'Quoted price set successfully!');
    }
}
