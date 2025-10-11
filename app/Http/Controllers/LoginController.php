<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\InspectionTips;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $user = User::find(Auth::id());
            if ($user->role == 'admin') {
                return view('admin.home');
            } else if ($user->role == 'workshop_owner') {
                return view('workshop_owner.home');
            }
            else {

                $tips = InspectionTips::all();
                return view('home.index', compact('tips'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function home()
    {
        $tips = InspectionTips::all();
        return view('home.index', compact('tips'));
    }

    public function logout()
    {
        return view('dashboard');
    }
}
