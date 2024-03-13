<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveCredit;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class AdminLeaveManagementController extends Controller
{

    public function __construct(){
        $this->middleware('authCheckAdminRole');
    }

    public function visit_employee_leave_ms($username){
        $user=User::where('user_name',$username)->get()->first();

        // compute the total length of service
        $current_date = Carbon::now();
        $current_date = new DateTime(Carbon::now());
        $date_hired = new DateTime($user->employees->date_hired);
        $length_of_service = $current_date->diff($date_hired);
        $length_of_service = $length_of_service->format('%a');
        $length_of_service = $length_of_service/365;
        $length_of_service = number_format((float)$length_of_service, 2, '.', '');

        $data=[
            'leave_credits' => EmployeeLeaveCredit::where('employee_id',$user->employees->id)->get()->first(),
        ];

        return view('profiles.admin.account_management.visit_employee_leave_view',[
            'user'=>$user,
            'length_of_service' => $length_of_service,
        ])->with($data);
    }
}
