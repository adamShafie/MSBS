<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function service_booking()
    {
        return view('home.service_booking');
    }

}
