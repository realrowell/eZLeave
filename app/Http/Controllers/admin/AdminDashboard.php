<?php

namespace App\Http\Controllers\admin;

use App\Models\LoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    //admin profile
    public function admin_dashboard(){
        $data=[
            'login_logs' => LoginLog::orderBy('date_time','desc')->get()->take(5)
        ];
        return view('profiles.admin.admin_dashboard')->with($data);
    }
}
