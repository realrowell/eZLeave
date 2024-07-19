<?php

namespace App\Http\Controllers\hr_staff;

use App\Http\Controllers\Controller;
use App\Models\AreaOfAssignment;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeLeaveCredit;
use App\Models\EmploymentStatus;
use App\Models\FiscalYear;
use App\Models\Gender;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveCreditLog;
use App\Models\LeaveType;
use App\Models\MaritalStatus;
use App\Models\Notification;
use App\Models\Position;
use App\Models\ProfilePhoto;
use App\Models\Role;
use App\Models\SubDepartment;
use App\Models\Suffix;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

class HrStaffPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckHrRole');
    }

    /**
     *
     *
     *
     * RETURN HR DASHBOARD
     */
    public function hrstaff_dashboard(){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes' => LeaveApplicationNote::all(),
            'employee_leavecredits' => EmployeeLeaveCredit::where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'desc')->get()->where('status_id','sta-1007')->take(5),
            'pending_leaves_count' => LeaveApplication::where('status_id','sta-1001')->where('fiscal_year_id',$current_fiscal_year->id)->count(),
            'approved_leaves_count' => LeaveApplication::where('status_id','sta-1002')->where('fiscal_year_id',$current_fiscal_year->id)->count(),
            'pending_availment_count' => LeaveApplication::where('status_id','sta-1002')->where('end_date','>=',$current_year->toDateString())->where('fiscal_year_id',$current_fiscal_year->id)->count(),
            'leave_approvals' => LeaveApproval::all(),
            'leave_applications' => LeaveApplication::where('fiscal_year_id',$current_fiscal_year->id)->orderBy('created_at', 'desc')->get()->take(5),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'notifications' => Notification::where('author_id','!=','employee_id')->where('author_id','!=',auth()->user()->id)->where('status_id','sta-1007')->orderBy('created_at','asc')->get()->take(5),
        ];
        return view('profiles.hr_staff.hr_leave_management.hrstaff_dashboard')->with($data);
    }

    /**
     *
     *
     *
     * RETURN HR Dashboard with fiscal year View
     */
    public function hrstaff_fy_dashboard($fiscal_year){
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();

        $data=[
            'employees' => Employee::all()->where('status_id','sta-2001'),
            'leavetypes' => LeaveType::all()->where('status_id','sta-1007'),
            'leave_application_notes' => LeaveApplicationNote::all(),
            'employee_leavecredits' => EmployeeLeaveCredit::where('fiscal_year_id',$fiscal_year)->orderBy('created_at', 'desc')->get()->where('status_id','sta-1007')->take(5),
            'pending_leaves_count' => LeaveApplication::where('status_id','sta-1001')->where('fiscal_year_id',$fiscal_year)->count(),
            'approved_leaves_count' => LeaveApplication::where('status_id','sta-1002')->where('fiscal_year_id',$fiscal_year)->count(),
            'pending_availment_count' => LeaveApplication::where('status_id','sta-1005')->where('end_date','>=',$current_year->toDateString())->where('fiscal_year_id',$fiscal_year)->count(),
            'leave_approvals' => LeaveApproval::all(),
            'leave_applications' => LeaveApplication::where('fiscal_year_id',$fiscal_year)->orderBy('created_at', 'desc')->get()->take(5),
            'fiscal_years' => FiscalYear::all()->where('status_id','sta-1007'),
            'current_fiscal_year' => $current_fiscal_year,
            'notifications' => Notification::where('author_id','!=','employee_id')->where('author_id','!=',auth()->user()->id)->where('status_id','sta-1007')->orderBy('created_at','asc')->get()->take(5),
        ];

        return view('profiles.hr_staff.hr_leave_management.hrstaff_dashboard')->with($data);
    }

    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES IN GRID
     */
    public function hrstaff_employee_management_employees_grid(){
        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->orderBy('last_name','asc')->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get(),
            'employment_statuses' => EmploymentStatus::all(),
            'departments' => Department::all()->where('status_id','sta-1007'),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
        ];

        return view('profiles.hr_staff.employee_management.employees_grid_view',compact('users'))->with($data);
    }



    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES IN LIST
     */
    public function hrstaff_employee_management_employees_list(){
        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->orderBy('last_name','asc')->get();
        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'departments' => Department::all()->where('status_id','sta-1007'),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'users' => $users,
        ];
        return view('profiles.hr_staff.employee_management.employees_list_view')->with($data);
    }



    /**
     * SEARCH RESULT
     *
     *
     * SHOW EMPLOYEES SEARCH RESULT IN GRID
     */
    public function hrstaff_employee_management_employees_grid_search(Request $request){
        $input_search = $request->search_input;
        $users = User::where('role_id','rol-0003')->where('status_id','sta-2001')->where('last_name','LIKE','%' .$input_search. '%')
                        ->orWhere('first_name','LIKE','%' .$input_search. '%')
                        ->orWhere('middle_name','LIKE','%' .$input_search. '%')
                        // ->orWhere('user_name','LIKE','%' .$input_search. '%')
                        // ->orWhere('email','LIKE','%' .$input_search. '%')
                        ->paginate(20);
        $data=[
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'departments' => Department::all()->where('status_id','sta-1007'),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'users' => $users,
        ];

        return view('profiles.hr_staff.employee_management.employees_grid_view')->with($data);
    }

    /**
     * SEARCH RESULT
     *
     *
     * SHOW EMPLOYEES SEARCH RESULT IN LIST
     */
    public function hrstaff_employee_management_employees_list_search(Request $request){
        $input_search = $request->search_input;
        $users = User::where('role_id','rol-0003')->where('status_id','sta-2001')->where('last_name','LIKE','%' .$input_search. '%')
                        ->orWhere('first_name','LIKE','%' .$input_search. '%')
                        ->orWhere('middle_name','LIKE','%' .$input_search. '%')
                        // ->orWhere('user_name','LIKE','%' .$input_search. '%')
                        // ->orWhere('email','LIKE','%' .$input_search. '%')
                        ->paginate(20);
        $data=[
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'departments' => Department::all()->where('status_id','sta-1007'),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'users' => $users,
        ];
        return view('profiles.hr_staff.employee_management.employees_list_view')->with($data);
    }
    /**
     * REGULAR
     *
     *
     * SHOW REGULAR EMPLOYEES IN GRID
     */
    public function hrstaff_employee_management_regular_grid(){

        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->orderBy('last_name','asc')
                        ->whereHas('employees', function ($query) {
                            return $query->where('employment_status_id', '=', 'ems-0001');
                        })->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get(),
            'employment_statuses' => EmploymentStatus::all(),
            'departments' => Department::all()->where('status_id','sta-1007'),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
        ];

        return view('profiles.hr_staff.employee_management.employees_regular_grid_view',compact('users'))->with($data);
    }

    /**
     * REGULAR
     *
     *
     * SHOW REGULAR EMPLOYEES IN LIST
     */
    public function hrstaff_employee_management_regular_list(){

        $users = Employee::where('status_id','sta-2001')->where('employment_status_id','ems-0001')->paginate(15);
        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];
        return view('profiles.hr_staff.employee_management.employees_regular_list_view',compact('users'))->with($data);
    }

    /**
     * PROBATIONARY
     *
     *
     * SHOW REGULAR EMPLOYEES IN GRID
     */
    public function hrstaff_employee_management_probationary_grid(){
        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->orderBy('last_name','asc')
                        ->whereHas('employees', function ($query) {
                            return $query->where('employment_status_id', '=', 'ems-0002');
                        })->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get(),
            'employment_statuses' => EmploymentStatus::all(),
            'departments' => Department::all()->where('status_id','sta-1007'),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
        ];

        return view('profiles.hr_staff.employee_management.employees_probi_grid_view',compact('users'))->with($data);
    }


    /**
     * PROBATIONARY
     *
     *
     * SHOW REGULAR EMPLOYEES IN LIST
     */
    public function hrstaff_employee_management_probationary_list(){

        $users = Employee::where('status_id','sta-2001')->where('employment_status_id','ems-0002')->paginate(15);
        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];
        return view('profiles.hr_staff.employee_management.employees_probi_list_view',compact('users'))->with($data);
    }

    public function visit_profile_view($username){
        $user=User::where('user_name',$username)->first();
        $employees=Employee::all();
        $profile_photo = ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first();

        // compute the total length of service
        $current_date = Carbon::now();
        $current_date = new DateTime(Carbon::now());
        $date_hired = new DateTime($user->employees->date_hired);
        $length_of_service = $current_date->diff($date_hired);
        $length_of_service = $length_of_service->format('%a');
        $length_of_service = $length_of_service/365;
        $length_of_service = number_format((float)$length_of_service, 2, '.', '');

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

        if($user->employees->address_id == null){
            $employee_address = "N/A";
        }
        else{
            $employee_address = $user->employees->employee_addresses->address_line_1.", ".
                                $user->employees->employee_addresses->city.", ".
                                $user->employees->employee_addresses->province.", ".
                                $user->employees->employee_addresses->region;
        }

        return view('profiles.hr_staff.employee_management.visit_user_view',[
            'user'=>$user,
            'employees'=>$employees,
            'length_of_service' => $length_of_service,
            'reports_to' => $reports_to,
            'second_reports_to' => $second_reports_to,
            'profile_photo' => $profile_photo,
            'employee_address' => $employee_address,
        ]);
    }

    public function visit_profile_update($username){
        $user=User::where('user_name',$username)->get()->first();
        $employees=Employee::all();
        $user_reports_tos=User::where('status_id','sta-2001')->orderBy('last_name','asc')->get();
        $profile_photo = ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first();
        $hrstaffs = User::where('role_id','rol-0002')->where('status_id','sta-2001')->get();

        // dd($user_reports_to_name);

        if(optional($user->employees->employee_positions)->reports_tos == null){
            $reports_to_hr = User::where('id',$user->employees->employee_positions->reports_to_id)->first();
            if($reports_to_hr == null){
                $reports_to =  "NONE";
            }
            else{
                $reports_to = $reports_to_hr->first_name." ".$reports_to_hr->last_name;
            }
        }
        else{
            $reports_to = optional(optional($user->employees->employee_positions->reports_tos)->users)->first_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->middle_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->last_name." ".
                        optional(optional(optional($user->employees->employee_positions->reports_tos)->users)->suffixes)->suffix_title;
        }

        if(optional($user->employees->employee_positions)->second_reports_tos == null){
            $second_reports_to_hr = User::where('id',$user->employees->employee_positions->second_superior_id)->first();
            if($second_reports_to_hr == null){
                $second_reports_to =  "NONE";
            }
            else{
                $second_reports_to = $second_reports_to_hr->first_name." ".$second_reports_to_hr->last_name;
            }
        }
        else{
            $second_reports_to = optional(optional($user->employees->employee_positions->second_reports_tos)->users)->first_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->middle_name." ".
            optional(optional($user->employees->employee_positions->second_reports_tos)->users)->last_name." ".
            optional(optional(optional($user->employees->employee_positions->second_reports_tos)->users)->suffixes)->suffix_title;
        }

        $data=[
            // 'users' => User::where('status_id','sta-2001')->paginate(5),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::all()->where('status_id','sta-1007'),
            'employment_statuses' => EmploymentStatus::all(),
            'departments' => Department::where('status_id','sta-1007')->orderBy('department_title','asc')->get(),
            'subdepartments' => SubDepartment::where('status_id','sta-1007')->orderBy('sub_department_title','asc')->get(),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'user_reports_to_name' => optional(optional($user->employees->employee_positions)->reports_tos)->last_name.', '.
                                        optional(optional($user->employees->employee_positions)->reports_tos)->first_name,
            'hrstaffs' => $hrstaffs,
        ];

        return view('profiles.hr_staff.employee_management.visit_user_update',[
            'user'=>$user,
            'employees'=>$employees,
            'user_reports_tos' => $user_reports_tos,
            'reports_to' => $reports_to,
            'second_reports_to' => $second_reports_to,
            'profile_photo' => $profile_photo,
        ])->with($data);
    }

    public function visit_profile_leave_view($username){
        $user=User::where('user_name',$username)->get()->first();

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
        ];
        return view('profiles.hr_staff.employee_management.employee_leavems_view')->with($data);
    }


    public function hrstaff_visit_profile(){
        $user=User::where('user_name',auth()->user()->user_name)->get()->first();

        $data = [
            'user' => $user,
            'profile_photo' => ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first(),
        ];
        return view('profiles.hr_staff.employee_management.hrstaff_profile_view')->with($data);
    }

    public function hrstaff_visit_profile_update(){
        $user=User::where('user_name',auth()->user()->user_name)->get()->first();

        $data = [
            'user' => $user,
            'profile_photo' => ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first(),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
        ];
        return view('profiles.hr_staff.employee_management.hrstaff_profile_update_view')->with($data);
    }
}
