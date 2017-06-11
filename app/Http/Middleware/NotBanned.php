<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NotBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->isNotBanned() ) {
            return $next($request);
        }

        $request->session()->flash('alert-danger', 'Your account has been banned. Please contact admin@example.com to rectify.');
        return redirect()->route('welcome');
    }
}
