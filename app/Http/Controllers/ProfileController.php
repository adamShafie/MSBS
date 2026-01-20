<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Motorcycle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        // Find the motorcycle record or fail
        $motorcycle = Motorcycle::findOrFail($id);

        // Validate input with uniqueness check for plate_number
        $validated = $request->validate([
            'plate_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('motorcycles', 'plate_number')->ignore($motorcycle->id),
            ],
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'engine_capacity' => 'required|integer',
            'year' => 'required|integer',
        ]);

        // Update record with validated data
        $motorcycle->update($validated);

        // Redirect back with success message
        return redirect()->route('view_motorcycle')->with('success', 'Motorcycle updated successfully!');
    }

    public function add_motorcycle()
    {
        return view('home.add_motorcycle');
    }

    public function save_motorcycle(Request $request)
    {
        if (Auth::id()) {
            $validated = $request->validate([
                'plate_number' => 'required|string|max:255|unique:motorcycles,plate_number',
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'engine_capacity' => 'required|integer',
                'year' => 'required|integer',
            ]);

            $motorcycle = new Motorcycle();
            $motorcycle->user_id = Auth::id();
            $motorcycle->plate_number = $validated['plate_number'];
            $motorcycle->brand = $validated['brand'];
            $motorcycle->model = $validated['model'];
            $motorcycle->engine_capacity = $validated['engine_capacity'];
            $motorcycle->year = $validated['year'];
            $motorcycle->save();

            return redirect()->route('view_motorcycle')->with('success', 'Motorcycle added successfully!');
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
