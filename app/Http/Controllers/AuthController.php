<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    // public function register(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
    //         'password' => ['required', 'min:8', 'confirmed'],
    //     ]);

    //     $user = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //     ]);

    //     Auth::login($user);

    //     $request->session()->regenerate();

    //     return 'Register Succesfully' . $user->name;
    // }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email not found.'
            ])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Password Incorrect.'
            ])->withInput();
        }

        $request->session()->regenerate();

        return 'welcome' .$user->name;

        // dd($request->all());
    }
}
