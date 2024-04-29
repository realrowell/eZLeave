<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLeaveCredit;
use App\Models\FiscalYear;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckEmployeeRole');
    }

    /**
     * this return employee dashboard
     *
     *
     * PROFILE DASHBOARD
     */
    public function profile_dashboard(){
        return view('profiles.profile_dashboard');
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT MENU
     */
    public function profile_leave_management_menu(){
        return view('profiles.employee.leave_management.leave_menu');
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT PENDING APPROVAL GRID
     */
    public function profile_leave_management_pending_approval_grid(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007')->where('show_on_employee',true),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_credits' => EmployeeLeaveCredit::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('show_on_employee',true)->where('status_id','sta-1007')->orderBy('id','asc')->get(),
        ];
        $leave_applications = LeaveApplication::where('status_id','sta-1001')->where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(8);
        $partial_leave_applications = LeaveApplication::where('status_id','sta-1003')->where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(8);

        return view('profiles.employee.leave_management.pending_approval_grid',compact('leave_applications'),compact('partial_leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT PENDING APPROVAL LIST
     */
    public function profile_leave_management_pending_approval_list(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007')->where('show_on_employee',true),
            'leave_credits' => EmployeeLeaveCredit::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('show_on_employee',true)->where('status_id','sta-1007')->orderBy('id','asc')->get(),
        ];
        $leave_applications = LeaveApplication::where('status_id','sta-1001')->where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(20);
        $partial_leave_applications = LeaveApplication::where('status_id','sta-1003')->where('employee_id',auth()->user()->employees->id)->orderBy('created_at', 'asc')->paginate(20);

        return view('profiles.employee.leave_management.pending_approval_list',compact('leave_applications'),compact('partial_leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE aPPLICATION DETAILS PAGE
     */
    public function leaveDetailsPage($leave_application_rn){
        $leave_application = LeaveApplication::where('reference_number',$leave_application_rn)->first();
        $employee_name =    $leave_application->employees->users->last_name.", ".
                            $leave_application->employees->users->first_name." ".
                            optional($leave_application->employees->users->suffixes)->suffix_title;
        $employee_designation = $leave_application->employees->employee_positions->positions->position_description;
        $employee_subdepartment = $leave_application->employees->employee_positions->positions->subdepartments->sub_department_title;
        $employee_department = $leave_application->employees->employee_positions->positions->subdepartments->departments->department_title;
        $employee_area = $leave_application->employees->employee_positions->area_of_assignments->location_address;

        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::all()->where('leave_application_reference',$leave_application_rn)->sortByDesc('created_at'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007')->where('show_on_employee',true),
            'leave_application' => $leave_application,
            'employee_name' => $employee_name,
            'employee_designation' => $employee_designation,
            'employee_subdepartment' => $employee_subdepartment,
            'employee_area' => $employee_area,
            'employee_department' => $employee_department,
            'leave_credits' => EmployeeLeaveCredit::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('show_on_employee',true)->where('status_id','sta-1007')->orderBy('id','desc')->get(),
        ];

        return view('profiles.employee.leave_management.leave_details')->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT FOR APPROVAL GRID
     */
    public function profile_leave_management_for_approval_grid(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $partial_leave_applications = LeaveApplication::where('status_id','sta-1003')->where('second_approver_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(8);
        $leave_applications = LeaveApplication::where('status_id','sta-1001')->where('approver_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(8);

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),

        ];

        return view('profiles.employee.leave_management.for_approval_grid',compact('leave_applications'), compact('partial_leave_applications'))->with($data);
    }


    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT FOR APPROVAL GRID
     */
    public function profile_leave_management_approval_history_list(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $leave_approvalss = LeaveApproval::all()->where('status_id','sta-1002')
                            ->where(function($leave_application, $key) {return $leave_application->reference_number;});

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            // 'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),
            'leave_approvals' => LeaveApproval::where('approver_id',auth()->user()->id)->where('status_id','sta-1002')->orderBy('created_at','desc')->get(),
        ];

        return view('profiles.employee.leave_management.approval_history_list' )->with($data);
    }


    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT FOR APPROVAL LIST
     */
    public function profile_leave_management_for_approval_list(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $partial_leave_applications = LeaveApplication::where('status_id','sta-1003')->where('second_approver_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(8);
        $leave_applications = LeaveApplication::where('status_id','sta-1001')->where('approver_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(8);

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),

        ];
        return view('profiles.employee.leave_management.for_approval_list',compact('leave_applications'), compact('partial_leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT CENCELLED GRID
     */
    public function profile_leave_management_cancelled_grid(){
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
        ];
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('status_id','sta-1005')->orderBy('created_at', 'desc')->paginate(8);

        return view('profiles.employee.leave_management.cancelled_grid',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT CENCELLED LIST
     */
    public function profile_leave_management_cancelled_list(){
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
        ];
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('status_id','sta-1005')->orderBy('created_at', 'desc')->paginate(10);

        return view('profiles.employee.leave_management.cancelled_list',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT PENDING AVAILMENT GRID
     */
    public function profile_leave_management_pending_availment_grid(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $current_date = Carbon::now();

        $leave_applications = LeaveApplication::where('status_id','sta-1002')->where('employee_id',auth()->user()->employees->id)->where('end_date','>=',$current_date->toDateString())->orderBy('created_at', 'asc')->paginate(8);

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),

        ];
        return view('profiles.employee.leave_management.pending_availment_grid',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT PENDING AVAILMENT GRID
     */
    public function profile_leave_management_pending_availment_list(){
        $current_date = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_date->toDateString())->where('fiscal_year_end','>=',$current_date->toDateString())->first();


        $leave_applications = LeaveApplication::where('status_id','sta-1002')->where('employee_id',auth()->user()->employees->id)->where('end_date','>=',$current_date->toDateString())->orderBy('created_at', 'asc')->paginate(20);

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),

        ];
        return view('profiles.employee.leave_management.pending_availment_list',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT HISTORY GRID
     */
    public function profile_leave_management_history_grid(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'desc')->paginate(8);

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),
        ];

        return view('profiles.employee.leave_management.history_grid',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT HISTORY LIST
     */
    public function profile_leave_management_history_list(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'desc')->get();

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'desc')->get(),
            'leave_applications' => $leave_applications,
        ];

        return view('profiles.employee.leave_management.history_list' )->with($data);
    }
}
