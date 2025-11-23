<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingApproval;
use App\Models\User;
use App\Models\Motorcycle;
use App\Models\Payment;
use Stripe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class BookingController extends Controller
{
    public function view_bookings()
    {
        $user = Auth::user();
        if ($user->role == 'workshop_owner') {
            $bookings = Booking::all();
            return view('workshop_owner.manage_bookings', compact('bookings'));
        } else {
            $bookings = Booking::with('user', 'motorcycle')
                ->where('user_id', $user->id)
                ->get();
            return view('home.view_bookings', compact('bookings'));
        }
    }

    public function service_booking()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $motorcycles = Motorcycle::where('user_id', $user->id)->get();

            return view('home.booking', compact('user', 'motorcycles'));
        } else {
            return redirect()->route('home');
        }
    }
    public function save_booking(Request $request)
    {
        $booking = new Booking();
        $booking->user_id = Auth::user()->id;
        $booking->motorcycle_id = $request->input('motorcycle_id');
        $booking->service_type = $request->input('service_type');
        $booking->preferred_date = $request->input('preferred_date');
        $booking->remarks = $request->input('remarks');
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('view_bookings')->with('success', 'Booking created successfully!');
    }

    public function edit_booking($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->status != 'pending') {
            return redirect()->route('view_bookings')->with('error', 'This booking cannot be edited as it is already ' . $booking->status . '.');
        }
        $motorcycles = Motorcycle::where('user_id', Auth::user()->id)->get();

        return view('home.edit_booking', compact('booking', 'motorcycles'));
    }

    public function update_booking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->motorcycle_id = $request->input('motorcycle_id');
        $booking->service_type = $request->input('service_type');
        $booking->preferred_date = $request->input('preferred_date');
        $booking->remarks = $request->input('remarks');
        $booking->save();

        return redirect()->route('view_bookings')->with('success', 'Booking updated successfully!');
    }
    public function delete_booking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('view_bookings')->with('success', 'Booking deleted successfully!');
    }
    public function make_payment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking_approval = BookingApproval::where('booking_id', $id)->first();
        return view('home.stripe', compact('booking', 'booking_approval'));
    }
    public function stripe()
    {
        return view('home.stripe');
    }
    public function stripePost(Request $request, $booking_id)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $price = $request->amount;
        $paymentMethodId = $request->payment_method_id;

        // Create PaymentIntent
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $price * 100,
            'currency' => 'myr',
            'payment_method' => $paymentMethodId,
            'confirm' => true,
            'payment_method_types' => ['card'],
        ]);

        // Save to DB (prevent duplicate records)
        Payment::updateOrCreate(
            ['booking_id' => $booking_id], // lookup column
            [
                'paid_amount' => $price,
                'transaction_ref' => $intent->id,
                'payment_status' => 'completed',
                'payment_date' => now(),
            ]
        );

        return redirect()->route('view_bookings')->with('success', 'Payment successful!');
    }
}
