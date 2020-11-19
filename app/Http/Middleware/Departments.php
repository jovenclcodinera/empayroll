<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Departments
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
            'Tester', 'Admin', 'Unassigned'
        ];
        if (! in_array(auth()->user()->role, $privilegedRoles)) {
            return redirect(route('home'))->with('alert', [
                'type' => 'warning',
                'message' => 'You are not privileged to access this page'
            ]);
        }
        return $next($request);
    }
}
