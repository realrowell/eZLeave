<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use App\Models\User;
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
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
        ];
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('status_id','sta-1001')->orderBy('created_at', 'asc')->paginate(8);

        return view('profiles.employee.leave_management.pending_approval_grid',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT PENDING APPROVAL LIST
     */
    public function profile_leave_management_pending_approval_list(){
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
        ];
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->where('status_id','sta-1001')->orderBy('created_at', 'asc')->paginate(10);

        return view('profiles.employee.leave_management.pending_approval_list',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT FOR APPROVAL GRID
     */
    public function profile_leave_management_for_approval_grid(){
        // $employee = Employee::where('id',auth()->user()->employees->id)->get();
        // $leave_approval = LeaveApproval::all()->where('approver_id',auth()->user()->employees->id);
        // $leave_approval_array = ['status_id'=>'sta-1001','approver_id'=>auth()->user()->employees->id];
        $leave_approvals = LeaveApproval::where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1001');
        $leave_applications = LeaveApplication::where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1001')->orderBy('created_at', 'asc')->paginate(8);

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_approvals' => LeaveApproval::all(),

        ];

        return view('profiles.employee.leave_management.for_approval_grid',compact('leave_applications'))->with($data);
    }

    // OLD LEAVE MANAGEMENT APPROVAL  VIEW - REMOVE THIS FUNCTION AND ITS ROUTES ONCE THE NEW DESIGN IS COMPLETE
    // public function profile_leave_management_for_approval_grid(){
    //     // $employee = Employee::where('id',auth()->user()->employees->id)->get();
    //     // $leave_approval = LeaveApproval::all()->where('approver_id',auth()->user()->employees->id);
    //     // $leave_approval_array = ['status_id'=>'sta-1001','approver_id'=>auth()->user()->employees->id];
    //     $leave_approvals = LeaveApproval::where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1001');

    //     $data=[
    //         'leave_application_notes' => LeaveApplicationNote::all(),
    //         'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
    //         'leave_approvals' => LeaveApproval::all()->where('approver_id',auth()->user()->employees->id)->keyBy('leave_application_reference')->where('status_id','sta-1001')
    //     ];

    //     return view('profiles.employee.leave_management.for_approval_grid')->with($data);
    // }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT FOR APPROVAL LIST
     */
    public function profile_leave_management_for_approval_list(){
        $leave_approvals = LeaveApproval::where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1001');
        $leave_applications = LeaveApplication::where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1001')->orderBy('created_at', 'asc')->paginate(8);

        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007')
        ];
        return view('profiles.employee.leave_management.for_approval_list',compact('leave_applications'))->with($data);
    }

    // OLD LEAVE MANAGEMENT APPROVAL  VIEW - REMOVE THIS FUNCTION AND ITS ROUTES ONCE THE NEW DESIGN IS COMPLETE
    // public function profile_leave_management_for_approval_list(){
    //     $leave_approvals = LeaveApproval::where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1001');

    //     $data=[
    //         'leave_application_notes' => LeaveApplicationNote::all(),
    //         'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
    //         'leave_approvals' => LeaveApproval::all()->where('approver_id',auth()->user()->employees->id)->keyBy('leave_application_reference')->where('status_id','sta-1001')
    //     ];
    //     return view('profiles.employee.leave_management.for_approval_list')->with($data);
    // }

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
     * EMPLOYEE LEAVE MANAGEMENT HISTORY GRID
     */
    public function profile_leave_management_history_grid(){
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
        ];
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->orderBy('created_at', 'desc')->paginate(8);

        return view('profiles.employee.leave_management.history_grid',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * EMPLOYEE LEAVE MANAGEMENT HISTORY LIST
     */
    public function profile_leave_management_history_list(){
        $data=[
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::orderBy('created_at', 'asc')->get(),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
        ];
        $leave_applications = LeaveApplication::where('employee_id',auth()->user()->employees->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('profiles.employee.leave_management.history_list',compact('leave_applications'))->with($data);
    }
}
