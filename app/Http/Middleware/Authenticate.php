<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (Auth::guard('peserta')->check()) {
        //     return redirect('/home');
        // }
        // if (Auth::guard('peserta')->check()) {
        //     return redirect('/home');
        // }elseif (Auth::guard('admin')->check()) {
        //     return redirect('/adm/peserta');
        // }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
