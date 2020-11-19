<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Dashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $privilegedRoles = [
            'Tester', 'Admin'
        ];
        if (in_array(auth()->user()->role, $privilegedRoles)) {
            return $next($request);
        } else {
            return redirect(route('home'))->with('alert', [
                'type' => 'warning',
                'message' => 'You are not privileged to access this page'
            ]);
        }
    }
}
