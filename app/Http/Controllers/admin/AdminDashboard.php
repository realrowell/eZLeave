<?php

namespace App\Http\Controllers\admin;

use App\Models\LoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    //admin profile
    public function admin_dashboard(){

        $data=[
            'login_logs' => LoginLog::orderBy('created_at','desc')->get()->take(5),
            'users_count' => User::all()->count(),
            'users_count_active' => User::where('status_id','sta-2001')->count(),
            'user_count_admin' => User::where('role_id','!=','rol-0003')->count(),
        ];
        return view('profiles.admin.admin_dashboard')->with($data);
    }
}
