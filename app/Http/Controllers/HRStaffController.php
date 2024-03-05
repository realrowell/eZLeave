<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AreaOfAssignment;
use App\Models\Employee;
use App\Models\EmployeeLeaveCredit;
use App\Models\EmployeePosition;
use App\Models\EmploymentStatus;
use App\Models\Gender;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use App\Models\MaritalStatus;
use App\Models\Position;
use App\Models\SubDepartment;
use App\Models\Suffix;
use App\Models\User;

class HRStaffController extends Controller
{
    /**
     * 
     *
     * 
     * RETURN HR DASHBOARD
     */
    public function hrstaff_dashboard(){
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes' => LeaveApplicationNote::all(),
            'employee_leavecredits' => EmployeeLeaveCredit::orderBy('created_at', 'desc')->get()->where('status_id','sta-1007')->take(5),
            'pending_leaves_count' => LeaveApplication::all()->where('status_id','sta-1001')->count(),
            'approved_leaves_count' => LeaveApplication::all()->where('status_id','sta-1002')->count(),
            'cancelled_count' => LeaveApplication::all()->where('status_id','sta-1005')->count(),
            'leave_approvals' => LeaveApproval::all(),
            'leave_applications' => LeaveApplication::orderBy('created_at', 'desc')->get()->take(5),
        ];
        return view('profiles.hr_staff.hr_leave_management.hrstaff_dashboard')->with($data);
    }
    
    /**
     * 
     *
     * 
     * RETURN HR Leave Credits View
     */
    public function hrstaff_leave_credits(){
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
        ];
        $employee_leavecredits = EmployeeLeaveCredit::where('status_id','sta-1007')->paginate(20);

        return view('profiles.hr_staff.hr_leave_management.hrstaff_leave_credits',compact('employee_leavecredits'))->with($data);
    }

    /**
     * 
     *
     * 
     * RETURN HR Leave Credits Search View
     */
    public function hrstaff_leave_credits_search(Request $request){
        $search_input = $request['search_input'];
        $employee = User::where('first_name',$search_input)->orWhere('last_name',$search_input)->first();
        
        if(is_null($employee)){
            return back() -> with('error','Employee not found!');
        }else{
            $data=[
                'employees' => Employee::all()->where('status_id','sta-2001')
                                            ->sortBy(function($employees, $key) {return $employees->users->last_name;}),
                'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            ];
            $employee_leavecredits = EmployeeLeaveCredit::where('status_id','sta-1007')->where('employee_id',$employee->employees->id)->paginate(20);
    
            return view('profiles.hr_staff.hr_leave_management.hrstaff_leave_credits',compact('employee_leavecredits'))->with($data);
        }
    }

    public function hrstaff_leave_management(){
        $users = User::where('status_id','sta-2001')->paginate(10);
        $leave_applications = LeaveApplication::orderBy('created_at', 'desc')->paginate(15);
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'asc')->get(),
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_all',compact('leave_applications'))->with($data);
    }

    public function hrstaff_leave_management_search(Request $request){
        $input_search = explode(' ',$request->search_input);
        // dd($input_search[1]);
        $input_filter = $request->search_filter;
        
        $leave_applications = LeaveApplication::orderBy('created_at', 'desc')->paginate(15);
        $users = User::where('status_id','sta-2001')->paginate(10);
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'asc')->get(),
        ];
        
        if($input_filter == '1'){
            $leave_applications = LeaveApplication::where('reference_number',$input_search)->orderBy('created_at', 'desc')->paginate(15);
            return view('profiles.hr_staff.hr_leave_management.leave_management_all_search',compact('leave_applications'))->with($data);
        }
        elseif($input_filter == '2'){
            $employee = User::where('first_name',$input_search)->orWhere('last_name',$input_search)->first();
            if($employee==null){
                return redirect()->back()->with('error','No Data Found!');
            }
            else{
                $leave_applications = LeaveApplication::where('employee_id',$employee->employees->id)->orderBy('created_at', 'desc')->paginate(100);
                return view('profiles.hr_staff.hr_leave_management.leave_management_all_search',compact('leave_applications'))->with($data);
            }
        }
        else{
            return view('profiles.hr_staff.hr_leave_management.leave_management_all_search',compact('leave_applications'))->with($data);
        }
            
    }

    public function hrstaff_leave_pending_approval(){
        $leave_applications = LeaveApplication::where('status_id','sta-1001')->orderBy('created_at', 'asc')->paginate(10);
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all()
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_pending_approval',compact('leave_applications'))->with($data);
    }

    public function hrstaff_leave_approved(){
        $leave_applications = LeaveApplication::where('status_id','sta-1002')->orderBy('created_at', 'desc')->paginate(10);
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'asc')->get()
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_approved',compact('leave_applications'))->with($data);
    }

    public function hrstaff_leave_cancelled(){
        $leave_applications = LeaveApplication::where('status_id','sta-1005')->paginate(10);
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'asc')->get()
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_cancelled',compact('leave_applications'))->with($data);
    }

    public function hrstaff_leave_rejected(){
        $leave_applications = LeaveApplication::where('status_id','sta-1004')->paginate(10);
        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'asc')->get()
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_reject',compact('leave_applications'))->with($data);
    }
}