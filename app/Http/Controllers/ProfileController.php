<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Motorcycle;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view_profile()
    {
        if (Auth::id()) {
            $user = User::find(Auth::id());
            if ($user->role == 'admin') {
                return view('admin.user_profile', compact('user'));
            }
            else if ($user->role == 'workshop_owner') {
                return view('workshop_owner.user_profile', compact('user'));
            }
            else {
                return view('home.user_profile', compact('user'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function edit_profile($id)
    {
        $user = User::find($id);
        if ($user->role == 'admin') {
            return view('admin.edit_profile', compact('user'));
        }
        else if ($user->role == 'workshop_owner') {
            return view('workshop_owner.edit_profile', compact('user'));
        }
        else {
            return view('home.edit_profile', compact('user'));
        }
    }

    public function update_profile(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->route('view_profile');
    }

    public function delete_profile($id)
    {
        $user = User::find($id);
        $motorcycles = Motorcycle::where('user_id', $id)->get();
        foreach ($motorcycles as $motorcycle) {
            $motorcycle->delete();
        }
        $user->delete();

        Auth::logout();
        return redirect()->route('/');
    }

    public function view_motorcycle()
    {
        if (Auth::id()) {
            $motorcycles = Motorcycle::where('user_id', Auth::id())->get();
            return view('home.motorcycle_details', compact('motorcycles'));
        } else {
            return redirect()->route('login');
        }
    }

    public function edit_motorcycle($id)
    {
        if (Auth::id()) {
            $motorcycle = Motorcycle::where('user_id', Auth::id())->where('motorcycle_id', $id)->first();
            return view('home.edit_motorcycle', compact('motorcycle'));
        } else {
            return redirect()->route('login');
        }
    }
    public function update_motorcycle(Request $request, $id)
    {
        $motorcycle = Motorcycle::find($id);
        $motorcycle->plate_number = $request->input('plate_number');
        $motorcycle->brand = $request->input('brand');
        $motorcycle->model = $request->input('model');
        $motorcycle->engine_capacity = $request->input('engine_capacity');
        $motorcycle->year = $request->input('year');
        $motorcycle->save();

        return redirect()->route('view_motorcycle');
    }

    public function add_motorcycle()
    {
        return view('home.add_motorcycle');
    }

    public function save_motorcycle(Request $request)
    {
        if (Auth::id()) {
            $motorcycle = new Motorcycle();
            $motorcycle->user_id = Auth::id();
            $motorcycle->plate_number = $request->input('plate_number');
            $motorcycle->brand = $request->input('brand');
            $motorcycle->model = $request->input('model');
            $motorcycle->engine_capacity = $request->input('engine_capacity');
            $motorcycle->year = $request->input('year');
            $motorcycle->save();

            return redirect()->route('view_motorcycle');
        } else {
            return redirect()->route('login');
        }
    }

    public function delete_motorcycle($id)
    {
        $motorcycle = Motorcycle::find($id);
        $motorcycle->delete();

        return redirect()->route('view_motorcycle');
    }
}
