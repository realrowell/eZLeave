<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AreaOfAssignment;
use App\Models\Employee;
use App\Models\EmploymentStatus;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Position;
use App\Models\ProfilePhoto;
use App\Models\Role;
use App\Models\SubDepartment;
use App\Models\Suffix;
use App\Models\User;
use App\Models\LoginLog;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES IN GRID
     */
    public function admin_accounts_grid(){
        $users = User::orderBy('last_name','asc')->paginate(12);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get(),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];

        return view('profiles.admin.account_management.accounts_grid_view',compact('users'))->with($data);
    }

    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES SEARCH IN GRID
     */
    public function admin_accounts_search_grid(Request $request){
        $input_search = explode(' ',$request->search_input,2);
        $last_name_input = implode($input_search);

        $users = User::where('last_name','LIKE','%' .$last_name_input. '%')->orWhere('first_name','LIKE','%' .$last_name_input. '%')->paginate(8);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get(),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];

        return view('profiles.admin.account_management.accounts_grid_view',compact('users'))->with($data);
    }

    /**
     * ALL
     *
     *
     * SHOW EMPLOYEES IN LIST
     */
    public function admin_accounts_list(){
        $users = User::orderBy('last_name','asc')->paginate(30);
        $data=[
            // 'users' => User::all()->where('status_id','sta-2001'),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
            'genders' => Gender::all(),
            'roles' => Role::all(),
            'marital_statuses' => MaritalStatus::all(),
            'positions' => Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get(),
            'employment_statuses' => EmploymentStatus::all(),
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007')
        ];
        return view('profiles.admin.account_management.accounts_list_view',compact('users'))->with($data);
    }

    public function admin_login_logs_view(){
        $login_logs = LoginLog::all()->sortByDesc('created_at');

        return view('profiles.admin.login_logs', compact('login_logs'));
    }

    public function admin_visit_employee_view($username){
        $user=User::where('user_name',$username)->get()->first();
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
                        optional(optional(optional($user->employees->employee_positions->reports_tos)->users)->suffixes)->suffix_title." - ".
                        $user->employees->employee_positions->reports_tos->employee_positions->positions->position_description;
        }

        if(optional($user->employees->employee_positions)->second_reports_tos == null){
            $second_reports_to = "NONE";
        }
        else{
            $second_reports_to = optional(optional($user->employees->employee_positions->second_reports_tos)->users)->first_name." ".
            optional(optional(optional(optional($user->employees)->employee_positions)->second_reports_tos)->users)->middle_name." ".
            optional(optional(optional(optional($user->employees)->employee_positions)->second_reports_tos)->users)->last_name." ".
            optional(optional(optional(optional($user->employees)->employee_positions->second_reports_tos)->users)->suffixes)->suffix_title." - ".
            $user->employees->employee_positions->second_reports_tos->employee_positions->positions->position_description;
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

        return view('profiles.admin.account_management.visit_employee_view',[
            'user'=>$user,
            'employees'=>$employees,
            'length_of_service' => $length_of_service,
            'reports_to' => $reports_to,
            'second_reports_to' => $second_reports_to,
            'profile_photo' => $profile_photo,
            'employee_address' => $employee_address,
        ]);
    }

    public function admin_update_employee_view($username){
        $user=User::where('user_name',$username)->get()->first();
        $employees=Employee::all();
        $user_reports_tos=Employee::with('employee_positions')->get();
        $profile_photo = ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first();

        // dd($user_reports_to_name);

        if(optional($user->employees->employee_positions)->reports_tos == null){
            $reports_to = "NONE";
        }
        else{
            $reports_to = optional(optional($user->employees->employee_positions->reports_tos)->users)->first_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->middle_name." ".
                        optional(optional($user->employees->employee_positions->reports_tos)->users)->last_name." ".
                        optional(optional(optional($user->employees->employee_positions->reports_tos)->users)->suffixes)->suffix_title;
        }

        if(optional($user->employees->employee_positions)->second_reports_tos == null){
            $second_reports_to = "NONE";
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
            'subdepartments' => SubDepartment::all()->where('status_id','sta-1007'),
            'area_of_assignments' => AreaOfAssignment::all()->where('status_id','sta-1007'),
            'user_reports_to_name' => optional(optional($user->employees->employee_positions)->reports_tos)->last_name.', '.
                                        optional(optional($user->employees->employee_positions)->reports_tos)->first_name,
        ];

        return view('profiles.admin.account_management.visit_employee_update_view',[
            'user'=>$user,
            'employees'=>$employees,
            'user_reports_tos' => $user_reports_tos,
            'reports_to' => $reports_to,
            'second_reports_to' => $second_reports_to,
            'profile_photo' => $profile_photo,
        ])->with($data);
    }

    public function admin_visit_account_view($username){
        $user=User::where('user_name',$username)->get()->first();

        $data = [
            'user' => $user,
            'profile_photo' => ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first(),
        ];
        return view('profiles.admin.account_management.visit_admin_account_view')->with($data);
    }

    public function admin_visit_account_update_view($username){
        $user=User::where('user_name',$username)->get()->first();

        $data = [
            'user' => $user,
            'profile_photo' => ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first(),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
        ];
        return view('profiles.admin.account_management.visit_admin_account_update_view')->with($data);
    }


    public function admin_visit_profile(){
        $user=User::where('user_name',auth()->user()->user_name)->get()->first();

        $data = [
            'user' => $user,
            'profile_photo' => ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first(),
        ];
        return view('profiles.admin.account_management.admin_profile_view')->with($data);
    }

    public function admin_visit_profile_update(){
        $user=User::where('user_name',auth()->user()->user_name)->get()->first();

        $data = [
            'user' => $user,
            'profile_photo' => ProfilePhoto::where('user_id',$user->id)->where('status_id','sta-1007')->first(),
            'suffixes' => Suffix::all()->where('status_id','sta-1007'),
        ];
        return view('profiles.admin.account_management.admin_profile_update_view')->with($data);
    }
}
