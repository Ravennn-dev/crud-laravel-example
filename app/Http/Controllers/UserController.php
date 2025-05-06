<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'max:50'],
            'username' => ['required', 'min:5', 'max:12', 'unique:users'],
            'password' => ['required']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        User::create($incomingFields);

        return redirect('/login')->with('user_registered', 'Register Successful.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('user_loggedin', 'Login Success.');
        }


        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'max:50'],
            'username' => ['required', 'min:5', 'max:12', 'unique:users,username,' . $user->id],
            'password' => ['nullable', 'min:6']
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        /** @var \App\Models\User $user **/
        $user->save();

        return back()->with('success', 'Profile updated!');
    }
}
