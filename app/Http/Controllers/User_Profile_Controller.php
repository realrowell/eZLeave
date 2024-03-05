<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;

class User_Profile_Controller extends Controller
{
    public function profile_user_profile(){
        $users=User::all();
        $employees=Employee::all();
        return view('profiles.user_profile')
        ->with('users',$users)
        ->with('employees',$employees);
    }

    public function profile_user_profile_edit(){
        return view('profiles.user_profile_edit');
    }
}
