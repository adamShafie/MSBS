<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingApproval;
use App\Models\Motorcycle;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function view_bookings(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'workshop_owner') {
            $query = Booking::with('user', 'motorcycle');
        } else {
            $query = Booking::with('user', 'motorcycle')
                            ->where('user_id', $user->id);
        }

        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // ✅ Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('motorcycle', function($mq) use ($search) {
                    $mq->where('model', 'like', "%{$search}%")
                       ->orWhere('plate_number', 'like', "%{$search}%");
                })
                ->orWhere('service_type', 'like', "%{$search}%");
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->get();

        return $user->role == 'workshop_owner'
            ? view('workshop_owner.manage_bookings', compact('bookings'))
            : view('home.view_bookings', compact('bookings'));
    }
        public function getAvailableSlots(Request $request)
    {
        $date = $request->input('date');
        $bookingId = $request->input('booking_id'); // keep current booking slot visible

        $slots = [
            "09:00-10:00",
            "10:00-11:00",
            "11:00-12:00",
            "13:00-14:00",
            "14:00-15:00",
            "15:00-16:00",
            "16:00-17:00",
            "17:00-18:00",
        ];

        $availableSlots = [];
        foreach ($slots as $slot) {
            $count = Booking::where('preferred_date', $date)
                            ->where('time_slot', $slot)
                            ->where('id', '!=', $bookingId)
                            ->count();

            if ($count < 3) {
                $availableSlots[] = $slot;
            }
        }

        // Always include current booking slot even if full
        $currentBooking = Booking::find($bookingId);
        if ($currentBooking && !in_array($currentBooking->time_slot, $availableSlots)) {
            $availableSlots[] = $currentBooking->time_slot;
        }

        return response()->json($availableSlots);
    }
    public function service_booking(Request $request)
    {
        $user = Auth::user();
        $motorcycles = Motorcycle::where('user_id', $user->id)->get();

        // Default to today or user-selected date
        $date = $request->input('preferred_date', now()->toDateString());

        $slots = [
            "09:00-10:00",
            "10:00-11:00",
            "11:00-12:00",
            "13:00-14:00",
            "14:00-15:00",
            "15:00-16:00",
            "16:00-17:00",
            "17:00-18:00",
        ];

        $availableSlots = [];
        foreach ($slots as $slot) {
            $count = Booking::where('preferred_date', $date)
                            ->where('time_slot', $slot)
                            ->count();
            if ($count < 3) {
                $availableSlots[] = $slot;
            }
        }

        return view('home.booking', compact('user', 'motorcycles', 'availableSlots', 'date'));
    }

    public function save_booking(Request $request)
    {
        $validated = $request->validate([
            'motorcycle_id' => 'required|exists:motorcycles,motorcycle_id',
            'service_type' => 'required|string|max:255',
            'preferred_date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        // Ensure motorcycle belongs to user
        if (!Motorcycle::where('motorcycle_id', $validated['motorcycle_id'])
                       ->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['motorcycle_id' => 'Invalid motorcycle selection.']);
        }

        // Limit slot capacity to 3
        $count = Booking::where('preferred_date', $validated['preferred_date'])
                        ->where('time_slot', $validated['time_slot'])
                        ->count();
        if ($count >= 3) {
            return back()->withErrors(['time_slot' => 'This time slot is fully booked.']);
        }

        Booking::create([
            'user_id' => Auth::id(),
            'motorcycle_id' => $validated['motorcycle_id'],
            'service_type' => $validated['service_type'],
            'preferred_date' => $validated['preferred_date'],
            'time_slot' => $validated['time_slot'],
            'remarks' => $validated['remarks'],
            'status' => 'pending',
        ]);

        return redirect()->route('view_bookings')->with('success', 'Booking created successfully!');
    }

    public function edit_booking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status != 'pending') {
            return redirect()->route('view_bookings')->with('error', 'This booking cannot be edited as it is already ' . $booking->status . '.');
        }

        $motorcycles = Motorcycle::where('user_id', Auth::id())->get();

        $slots = [
            "09:00-10:00",
            "10:00-11:00",
            "11:00-12:00",
            "13:00-14:00",
            "14:00-15:00",
            "15:00-16:00",
            "16:00-17:00",
            "17:00-18:00",
        ];

        $availableSlots = [];
        foreach ($slots as $slot) {
            $count = Booking::where('preferred_date', $booking->preferred_date)
                            ->where('time_slot', $slot)
                            ->where('id', '!=', $booking->id) // exclude current booking
                            ->count();

            if ($count < 3 || $slot == $booking->time_slot) {
                $availableSlots[] = $slot;
            }
        }

        return view('home.edit_booking', compact('booking', 'motorcycles', 'availableSlots'));
    }

    public function update_booking(Request $request, $id)
    {
        $validated = $request->validate([
            'motorcycle_id' => 'required|exists:motorcycles,motorcycle_id',
            'service_type' => 'required|string|max:255',
            'preferred_date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);

        if ($booking->status != 'pending') {
            return redirect()->route('view_bookings')
                             ->with('error', 'Only pending bookings can be updated.');
        }

        // Slot capacity check
        $count = Booking::where('preferred_date', $validated['preferred_date'])
                        ->where('time_slot', $validated['time_slot'])
                        ->where('id', '!=', $booking->id) // exclude current booking
                        ->count();
        if ($count >= 3) {
            return back()->withErrors(['time_slot' => 'This time slot is fully booked.']);
        }

        $booking->update($validated);

        return redirect()->route('view_bookings')->with('success', 'Booking updated successfully!');
    }

    public function delete_booking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status != 'pending') {
            return redirect()->route('view_bookings')
                             ->with('error', 'Only pending bookings can be deleted.');
        }

        $booking->delete();
        return redirect()->route('view_bookings')->with('success', 'Booking deleted successfully!');
    }

    public function make_payment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking_approval = BookingApproval::where('booking_id', $id)->first();

        //Create or update a payment record with NULL transaction_ref
        Payment::updateOrCreate(
            ['booking_id' => $id],
            [
                'paid_amount' => 0,
                'transaction_ref' => null,       // ✅ leave null until Stripe returns ID
                'payment_status' => 'pending',   // ✅ use status for pending
                'payment_date' => null,
            ]
        );

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

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $price * 100,
            'currency' => 'myr',
            'payment_method' => $paymentMethodId,
            'confirm' => true,
            'payment_method_types' => ['card'],
        ]);

        Payment::updateOrCreate(
            ['booking_id' => $booking_id],
            [
                'paid_amount' => $price,
                'transaction_ref' => $intent->id,   // ✅ Stripe unique ID
                'payment_status' => 'completed',
                'payment_date' => now(),
            ]
        );

        $booking = Booking::findOrFail($booking_id);
        $booking->status = 'paid';
        $booking->save();

        return redirect()->route('view_bookings')->with('success', 'Payment successful!');
    }
}
