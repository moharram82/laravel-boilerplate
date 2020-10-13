<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (User::all()->count() > 1) {
                if (! Auth::user()->hasRole('Admin')) {
                    abort('401');
                }
            }

            return $next($request);
        }

        return response()->redirectToRoute('login');
    }
}
