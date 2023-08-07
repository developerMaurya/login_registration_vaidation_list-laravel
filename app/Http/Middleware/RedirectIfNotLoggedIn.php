<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        $userEmail = session('user_email');
        if (!$userEmail) {
            return redirect('/');
        }

        return $next($request);
    }
}

