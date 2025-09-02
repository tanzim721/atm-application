<?php

namespace App\Http\Controllers;

use App\Jobs\SendOtpJob;
use App\Jobs\SendMailJob;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function registrationSuccess()
    {
        return view('auth.success');
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'status' => 'in:active,inactive',
            'password' => 'required|string|min:8|confirmed',
        ]);

        for ($i=0; $i <= 2; $i++) { 
            dispatch(new SendMailJob((object)$request->all()));
        }
        

        // Create the user
        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'status' => $request->status ?? 'active',
            'password' => bcrypt($request->password),
        ]);

        // dispatch(new SendOtpJob($request))->onQueue('otp');
        dispatch(new SendOtpJob())->onQueue('otp');


        return redirect()->route('registration.success');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function userDashboard()
    {
        $user = auth()->user();
        dd($user);
        return view('user.dashboard', compact('user'));
    }
    public function userLogout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login');
    }

    public function sendOtp(Request $request)
    {
        dispatch(new SendOtpJob())->onQueue('otp');
        return back()->with('success', 'OTP has been sent to your email.');
    }


}
