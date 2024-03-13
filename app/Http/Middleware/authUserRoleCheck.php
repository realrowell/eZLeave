<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class authUserRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if (auth()->check()) {
        //     // return redirect(route('index'));
        //     if(!auth()->user()->role_id == 'rol-0002'){
        //         return redirect(route('index'));
        //     }
        // }
        if(auth()->check()){
            if(auth()->user()->role_id == 'rol-0001'){
                return redirect(route('admin_dashboard'));
            }
            elseif (auth()->user()->role_id == 'rol-0002') {
                return $next($request);
            }
            elseif (auth()->user()->role_id == 'rol-0003') {
                return redirect(route('employee_dashboard'));
            }
            else {
                auth()->logout();
                return redirect()->back()->with('warning', 'you are not autorized to access this page!');
            }
        }
        return $next($request);
    }
}
