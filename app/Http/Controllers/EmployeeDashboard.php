<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class EmployeeDashboard extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function employee_dashboard(){
        $data=[
            'pending_leaves_count' => LeaveApplication::all()->where('status_id','sta-1001')->count(),
            'approved_leaves_count' => LeaveApplication::all()->where('status_id','sta-1002')->count(),
        ];
        return view('profiles.profile_dashboard')->with($data);
    }
}
