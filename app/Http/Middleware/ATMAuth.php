<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ATMAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $session = Session::get('atm_session');

        if (!$session) {
            return redirect()->route('atm.welcome')->withErrors(['error' => 'Please insert your card and enter PIN']);
        }

        // Check session timeout (15 minutes)
        $loginTime = $session['login_time'];
        if ($loginTime->diffInMinutes(now()) > 15) {
            Session::forget('atm_session');
            return redirect()->route('atm.welcome')->withErrors(['error' => 'Session expired for security reasons']);
        }

        return $next($request);
    }
}
