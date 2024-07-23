<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
                Log::info('USER ACCESS NOTICE || No Access Rights || User id: '. auth()->user()->id.' | User email: '.auth()->user()->email.' | Role: '.auth()->user()->roles?->role_title.' | Page want to access: hrstaff');
                return redirect(route('admin_dashboard'))->with('warning', 'The page you are accessing is for hr staff only');
            }
            elseif (auth()->user()->role_id == 'rol-0002') {
                // Log::info('User with ID '. auth()->user()->id.' | User name: '.auth()->user()->first_name.auth()->user()->middle_name.auth()->user()->last_name. ' has access the hr staff page.');
                return $next($request);
            }
            elseif (auth()->user()->role_id == 'rol-0003') {
                Log::info('USER ACCESS NOTICE || No Access Rights || User id: '. auth()->user()->id.' | User email: '.auth()->user()->email.' | Role: '.auth()->user()->roles?->role_title.' | Page want to access: hrstaff');
                return redirect(route('employee_dashboard'));
            }
            else {
                Log::warning('USER ACCESS NOTICE || Failed Access || User id: '. auth()->user()->id.' | User email: '.auth()->user()->email.' | Role: '.auth()->user()->roles?->role_title.' | Page want to access: hrstaff');
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
