<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class authCheckAdminRole
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
                //log
                // Log::info('User with ID '. auth()->user()->id.' | User name: '.auth()->user()->first_name.auth()->user()->middle_name.auth()->user()->last_name. ' has accessed the admin page.');
                return $next($request);
            }
            elseif (auth()->user()->role_id == 'rol-0002') {
                Log::info('User with ID '. auth()->user()->id.' | User name: '.auth()->user()->first_name.auth()->user()->middle_name.auth()->user()->last_name. ' tries to access the admin page.');
                return redirect(route('hrstaff_dashboard'))->with('warning', 'you are not autorized to access this page!');
            }
            elseif (auth()->user()->role_id == 'rol-0003') {
                Log::info('User with ID '. auth()->user()->id.' | User name: '.auth()->user()->first_name.auth()->user()->middle_name.auth()->user()->last_name. ' tries to access the admin page.');
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
