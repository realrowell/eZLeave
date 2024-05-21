<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveCredit;
use App\Models\FiscalYear;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use App\Models\Notification;
use Carbon\Carbon;
use DateTime;
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
        $this->middleware('authCheckEmployeeRole');
    }

    public function employee_dashboard(){
        $current_year = Carbon::now();
        $current_date = new DateTime($current_year);
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        // dd($current_date);
        $data=[
            'pending_leaves_count' => LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1001')->count(),
            'approved_leaves_count' => LeaveApplication::where('status_id','sta-1002')->where('employee_id',auth()->user()->employees->id)->where('end_date','>=',$current_year->toDateString())->count(),
            'for_approval_count' => LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)
                                                        ->where('fiscal_year_id',$current_fiscal_year->id)
                                                        ->where('status_id','sta-1001')
                                                        ->where('approver_id',auth()->user()->employees->id)
                                                        ->orWhere('status_id','sta-1003')
                                                        ->where('second_approver_id',auth()->user()->employees->id)
                                                        ->count(),
            'leave_credits' => EmployeeLeaveCredit::where('fiscal_year_id',$current_fiscal_year->id)
                                                    ->where('employee_id',auth()->user()->employees->id)
                                                    ->where('show_on_employee',true)
                                                    ->where('status_id','sta-1007')
                                                    // ->where('expiration','<=',$current_date)
                                                    ->orderBy('id','desc')
                                                    ->get(),
            'leave_applications' => LeaveApplication::where('start_date','<=',$current_year->toDateString())->where('end_date','>=',$current_year->toDateString())->where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1002')->get(),
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::where('status_id','sta-1007')->where('show_on_employee',true)->get(),
            'notifications' => Notification::where('employee_id',auth()->user()->id)->orWhere('author_id',auth()->user()->id)->where('status_id','sta-1007')->get(),
        ];
        return view('profiles.employee.profile.profile_dashboard')->with($data);
    }
}
