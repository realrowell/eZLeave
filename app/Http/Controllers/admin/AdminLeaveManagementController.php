<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveCredit;
use App\Models\FiscalYear;
use App\Models\LeaveApplication;
use App\Models\LeaveCreditLog;
use App\Models\ProfilePhoto;
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
        $profile_photo = ProfilePhoto::where('user_id',$user->id)->first();

        if(optional($user->employees->employee_positions)->reports_tos == null){
            $reports_to = "NONE";
        }
        else{
            $reports_to = optional(optional($user->employees->employee_positions->reports_tos)->users)->first_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->middle_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->last_name." ".
                        optional(optional(optional($user->employees->employee_positions->reports_tos)->users)->suffixes)->suffix_title;
                        // ." - ".$user->employees->employee_positions->reports_tos->employee_positions->positions->position_description;
        }

        if(optional($user->employees->employee_positions)->second_reports_tos == null){
            $second_reports_to = "NONE";
        }
        else{
            $second_reports_to = optional(optional($user->employees->employee_positions->second_reports_tos)->users)->first_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->middle_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->last_name." ".
            optional(optional(optional($user->employees->employee_positions->second_reports_tos)->users)->suffixes)->suffix_title;
            // ." - ".$user->employees->employee_positions->second_reports_tos->employee_positions->positions->position_description;
        }

        // compute the total length of service
        $current_date = Carbon::now();
        $current_date = new DateTime(Carbon::now());
        $date_hired = new DateTime($user->employees->date_hired);
        $length_of_service = $current_date->diff($date_hired);
        $length_of_service = $length_of_service->format('%a');
        $length_of_service = $length_of_service/365;
        $length_of_service = number_format((float)$length_of_service, 2, '.', '');

        $leave_credits = EmployeeLeaveCredit::where('employee_id',$user->employees->id)->where('status_id','sta-1007')->get();
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        $data=[
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_credits' => EmployeeLeaveCredit::where('employee_id',$user->employees->id)->get()->first(),
            'user' => $user,
            'length_of_service' => $length_of_service,
            'employee_leavecredit_histories' => EmployeeLeaveCredit::where('employee_id',$user->employees->id)->where('status_id','sta-1007')->orderBy('id','desc')->get(),
            'employee_leavecredits' => EmployeeLeaveCredit::where('employee_id',$user->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1007')->orderBy('id','desc')->get(),
            'employee_leavecredit_logs' => LeaveCreditLog::where('employee_id',$user->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->get(),
            'employee_leave_applications' => LeaveApplication::where('employee_id',$user->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->get(),
            'reports_to' => $reports_to,
            'second_reports_to' => $second_reports_to,
            'profile_photo' => $profile_photo,
        ];

        return view('profiles.admin.account_management.visit_employee_leave_view')->with($data);
    }
}
