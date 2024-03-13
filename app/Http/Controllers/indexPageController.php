<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexPageController extends Controller
{
    public function index(){
        if(Auth::check()){
            if(Auth::user()->role_id == 'rol-0001'){
                return redirect(route('admin_dashboard'));
            }
            elseif (Auth::user()->role_id == 'rol-0002') {
                return redirect(route('hrstaff_dashboard'));
            }
            elseif (Auth::user()->role_id == 'rol-0003') {
                return redirect(route('employee_dashboard'));
            }
            else {
                Auth::logout();
                return redirect()->back()->with('warning', 'you are not autorized to access this page!');
            }
        }
        return view('home_login');
    }
}
