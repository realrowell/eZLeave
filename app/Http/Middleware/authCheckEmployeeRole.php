<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class authCheckEmployeeRole
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
                Log::info('USER ACCESS NOTICE || No Access Rights || User id: '. auth()->user()->id.' | User email: '.auth()->user()->email.' | Role: '.auth()->user()->roles?->role_title.' | Page want to access: employee');
                return redirect(route('admin_dashboard'))->with('warning', 'The page you are accessing is for employee only');
            }
            elseif (auth()->user()->role_id == 'rol-0002') {
                Log::info('USER ACCESS NOTICE || No Access Rights || User id: '. auth()->user()->id.' | User email: '.auth()->user()->email.' | Role: '.auth()->user()->roles?->role_title.' | Page want to access: employee');
                return redirect(route('hrstaff_dashboard'))->with('warning', 'The page you are accessing is for employee only');
            }
            elseif (auth()->user()->role_id == 'rol-0003') {
                if(auth()->user()->status_id == 'sta-2001'){
                    // Log::info('User with ID '. auth()->user()->id.' | User name: '.auth()->user()->first_name.auth()->user()->middle_name.auth()->user()->last_name. ' has access the employee page.');
                    return $next($request);
                }
                else{
                    Log::warning('USER ACCESS NOTICE || Account Deactivated || The user tries to access a deactivated account || User id: '. auth()->user()->id.' | User email: '.auth()->user()->email.' | Role: '.auth()->user()->roles?->role_title.' | Page want to access: employee');
                    auth()->logout();
                    return redirect(route('index'))->with('error','Your account has been deactivated by the administrator! If you believe that this was a mistake, please contact support!');
                }
            }
            else {
                Log::warning('USER ACCESS NOTICE || Failed Access || User id: '. auth()->user()->id.' | User email: '.auth()->user()->email.' | Role: '.auth()->user()->roles?->role_title.' | Page want to access: employee');
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
