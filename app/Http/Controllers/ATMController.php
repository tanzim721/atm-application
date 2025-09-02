<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ATMController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function authenticate(Request $request)
    {
        // Authentication logic here
        // On success, store session data
        session(['atm_session' => ['login_time' => now()]]);
        return redirect()->route('atm.dashboard');
    }

    public function dashboard()
    {
        return view('atm.dashboard');
    }

    public function logout()
    {
        session()->forget('atm_session');
        return redirect()->route('atm.welcome')->with('status', 'Logged out successfully');
    }
}
