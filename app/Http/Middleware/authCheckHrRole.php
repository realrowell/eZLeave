<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class authCheckHrRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(auth()->user()->role_id == 'rol-0001'){
                return redirect(route('admin_dashboard'))->with('warning', 'The page you are accessing is for hr staff only');
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
        elseif(!auth()->check()){
            return redirect(route('index'))->with('info','please login first');
        }
        return $next($request);
    }
}
