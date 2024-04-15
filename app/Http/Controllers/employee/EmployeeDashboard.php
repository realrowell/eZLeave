<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveCredit;
use App\Models\FiscalYear;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use Carbon\Carbon;
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
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        $data=[
            'pending_leaves_count' => LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1001')->count(),
            'approved_leaves_count' => LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1002')->count(),
            'leave_credits' => EmployeeLeaveCredit::where('fiscal_year_id',$current_fiscal_year->id)->where('employee_id',auth()->user()->employees->id)->where('show_on_employee',true)->where('status_id','sta-1007')->orderBy('id','desc')->get(),
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::where('status_id','sta-1007')->where('show_on_employee',true)->get(),
        ];
        return view('profiles.profile_dashboard')->with($data);
    }
}
