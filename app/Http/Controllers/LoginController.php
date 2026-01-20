<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\InspectionTips;
use App\Models\Booking;
use App\Models\ServiceHistory;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $user = User::find(Auth::id());

            if ($user->role == 'admin') {
                $usersCount = User::count();
                $bookingsCount = Booking::count();
                $completedServicesCount = ServiceHistory::count();
                $recentBookings = Booking::latest()->take(5)->get();

                return view('admin.home', compact(
                    'usersCount',
                    'bookingsCount',
                    'completedServicesCount',
                    'recentBookings'
                ));
            } else if ($user->role == 'workshop_owner') {
                // ✅ Collect dashboard data for ALL bookings, not just by user
                $totalBookings = Booking::count();

                $pendingApprovals = Booking::where('status', 'pending')->count();

                $completedServices = ServiceHistory::count();
                $recentBookings = Booking::latest()
                    ->take(5)
                    ->get();

                return view('workshop_owner.home', compact(
                    'totalBookings',
                    'pendingApprovals',
                    'completedServices',
                    'recentBookings'
                ));
            } else {
                // ✅ Dashboard data for normal user
                $tips = InspectionTips::all();

                $bookingsCount = Booking::where('user_id', $user->id)
                    ->where('status', '!=', 'completed')
                    ->count();

                $pendingPaymentsCount = Booking::where('user_id', $user->id)
                    ->where('status', 'approved')
                    ->whereHas('payment', function ($q) {
                        $q->where('payment_status', 'pending');
                    })
                    ->count();

                $completedServicesCount = ServiceHistory::where('user_id', $user->id)->count();

                $recentBookings = Booking::where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();

                return view('home.index', compact(
                    'tips',
                    'bookingsCount',
                    'pendingPaymentsCount',
                    'completedServicesCount',
                    'recentBookings'
                ));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function home()
    {
        return view('dashboard');
    }

    public function logout()
    {
        return view('dashboard');
    }
}
