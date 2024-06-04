<?php

namespace App\Http\Controllers\hr_staff;

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

class HrStaffLeavePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckHrRole');
    }

    public function hrstaff_leave_menu(){
        return view('profiles.hr_staff.hr_leave_management.hr_leave_management_menu');
    }

    /**
     *
     *
     *
     * RETURN HR Leave Applications View
     */
    public function hrstaff_leave_management(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('role_id','rol-0003')->where('status_id','sta-2001')->orderBy('last_name', 'asc')->get();
        $leave_applications = LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'desc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
            'users' => $users,
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_all',compact('leave_applications'))->with($data);
    }


    /**
     *
     *
     *
     * RETURN HR Leave Application fiscal year View
     */
    public function hrstaff_fy_leave_management($fiscal_year){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('status_id','sta-2001')->paginate(10);
        $leave_applications = LeaveApplication::where('fiscal_year_id',$fiscal_year)->orderBy('created_at', 'desc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_all',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Leave Application Search View
     */
    public function hrstaff_leave_management_search(Request $request){
        $input_search = $request->search_input;
        // dd($input_search[1]);
        $input_filter = $request->search_filter;

        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('role_id','rol-0003')->where('status_id','sta-2001')->get();
        $leave_applications = LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'desc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
            'users' => $users,
        ];

        if($input_filter == '1'){
            $leave_applications = LeaveApplication::where('reference_number',$input_search)->orderBy('created_at', 'desc')->paginate(15);
            return view('profiles.hr_staff.hr_leave_management.leave_management_all',compact('leave_applications'))->with($data);
        }
        elseif($input_filter == '2'){
            // $users = User::where('first_name','LIKE','%'.$input_search.'%')
            //                     ->orWhere('middle_name','LIKE','%'.$input_search.'%')
            //                     ->orWhere('last_name','LIKE','%'.$input_search.'%')
            //                     ->first();
            // dd($input_search);
            $leave_applications = LeaveApplication::where('employee_id',$input_search)->orderBy('created_at', 'desc')->paginate(20);

            if($leave_applications==null){
                return redirect()->back()->with('error','No Data Found!');
            }
            else{
                return view('profiles.hr_staff.hr_leave_management.leave_management_all',compact('leave_applications'))->with($data);
            }
        }
        else{
            return view('profiles.hr_staff.hr_leave_management.leave_management_all',compact('leave_applications'))->with($data);
        }

    }

    /**
     *
     *
     *
     * RETURN HR Leave Credits View
     */
    public function hrstaff_leave_credits(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        // dd($current_fiscal_year->fiscal_year_title);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
        ];
        $employee_leavecredits = EmployeeLeaveCredit::where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1007')->orderBy('created_at','desc')->get();

        return view('profiles.hr_staff.hr_leave_management.hrstaff_leave_credits',compact('employee_leavecredits'))->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Leave Credits View
     */
    public function hrstaff_fy_leave_credits($fiscal_year){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
        ];
        $employee_leavecredits = EmployeeLeaveCredit::where('fiscal_year_id',$fiscal_year)->where('status_id','sta-1007')->orderBy('created_at','desc')->paginate(20);

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
        $fy = $request['fiscal_year'];

        $employee = User::where('first_name',$search_input)
                        ->orWhere('last_name',$search_input)
                        ->orWhere('middle_name',$search_input)
                        ->first();

        if(is_null($employee)){
            return back() -> with('error','Employee not found!');
        }else{
            $employee_leavecredits = EmployeeLeaveCredit::where('status_id','sta-1007')->where('employee_id',$employee->employees->id)->where('fiscal_year_id',$fy)->paginate(20);
            $data=[
                'employees' => Employee::all()->where('status_id','sta-2001')
                                            ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                            ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                            ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
                'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
                'employee_leavecredits' => $employee_leavecredits,
            ];

            dd($employee_leavecredits);
            return view('profiles.hr_staff.hr_leave_management.hrstaff_leave_credits')->with($data);
        }
    }

    /**
     *
     *
     *
     * HR LEAVE APPLICATION DETAILS PAGE
     */
    public function hr_leaveDetailsPage($leave_application_rn){
        $leave_application = LeaveApplication::where('reference_number',$leave_application_rn)->first();
        if($leave_application == null){
            abort(419);
        }

        $employee_name =    $leave_application->employees->users->last_name.", ".
                            $leave_application->employees->users->first_name." ".
                            optional($leave_application->employees->users->suffixes)->suffix_title;
        $employee_designation = $leave_application->employees->employee_positions->positions->position_description;
        $employee_subdepartment = $leave_application->employees->employee_positions->positions->subdepartments->sub_department_title;
        $employee_department = $leave_application->employees->employee_positions->positions->subdepartments->departments->department_title;
        $employee_area = $leave_application->employees->employee_positions->area_of_assignments->location_address;

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;}),
            'leave_application_notes' => LeaveApplicationNote::all(),
            'leave_approvals' => LeaveApproval::all()->where('leave_application_reference',$leave_application_rn)->sortByDesc('created_at'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007')->where('show_on_employee',true),
            'leave_application' => $leave_application,
            'employee_name' => $employee_name,
            'employee_designation' => $employee_designation,
            'employee_subdepartment' => $employee_subdepartment,
            'employee_area' => $employee_area,
            'employee_department' => $employee_department,
        ];

        return view('profiles.hr_staff.hr_leave_management.leave_details')->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Pending Leave Application View
     */
    public function hrstaff_leave_pending_approval(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('status_id','sta-2001')->paginate(10);
        $leave_applications = LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1001')->orWhere('status_id','sta-1003')->orderBy('created_at', 'desc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_pending_approval',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Pending Leave Application View
     */
    public function hrstaff_leave_pending_availment(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('status_id','sta-2001')->paginate(10);
        // $leave_applications = LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1001')->orWhere('status_id','sta-1003')->orderBy('created_at', 'desc')->paginate(20);

        $leave_applications = LeaveApplication::where('status_id','sta-1002')->where('end_date','>=',$current_year->toDateString())->where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'asc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_pending_availment',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Approved Leave Application View
     */
    public function hrstaff_leave_approved(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('status_id','sta-2001')->paginate(10);
        $leave_applications = LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1002')->orderBy('created_at', 'desc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_approved',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Cancelled Leave Application View
     */
    public function hrstaff_leave_cancelled(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('status_id','sta-2001')->paginate(10);
        $leave_applications = LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1005')->orderBy('created_at', 'desc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_cancelled',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Rejected Leave Application View
     */
    public function hrstaff_leave_rejected(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $users = User::where('status_id','sta-2001')->paginate(10);
        $leave_applications = LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1004')->orderBy('created_at', 'desc')->paginate(20);

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001')
                                        ->sortBy(function($employees, $key) {return $employees->users->last_name;})
                                        ->where(function($employees, $key) {return $employees->users->status_id=='sta-2001';})
                                        ->where(function($employees, $key) {return $employees->users->role_id=='rol-0003';}),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes'=>LeaveApplicationNote::all(),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'leave_approvals'=>LeaveApproval::orderBy('created_at', 'desc')->get(),
        ];
        return view('profiles.hr_staff.hr_leave_management.leave_management_reject',compact('leave_applications'))->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Leave types View
     */
    public function hrstaff_leave_types(){
        $leavetypes = LeaveType::where('status_id','sta-1007')->orwhere('status_id','sta-1008')->get();

        return view('profiles.hr_staff.hr_leave_management.leave_types',
        [
            'leavetypes'=>$leavetypes
        ]);
    }

}
