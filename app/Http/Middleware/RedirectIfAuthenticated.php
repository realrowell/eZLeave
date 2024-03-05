<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         if(Auth::user()->role_id=='rol-0001'){
        //             // dd('success');
        //             return redirect(route('admin_dashboard'));
        //         }
        //         elseif(Auth::user()->role_id=='rol-0002'){
        //             return redirect(route('hrstaff_dashboard'));
        //         }
        //         elseif(Auth::user()->role_id=='rol-0003'){
        //             return redirect(route('employee_dashboard'));
        //         }
        //     }
        // }

        return $next($request);
    }
}
