<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Page_Controller extends Controller
{
    public function index(){
        return view('home_login');
    }

    public function welcome(){
        return view('welcome');
    }


    public function profile_leave_management_for_approval_list_view(){
        
        $datetime = Carbon::now();
        $datetime->setTimezone('Asia/Manila');
        $date = Carbon::createFromFormat('Y-m-d H', '2000-2-22 22')->toDateTimeString();
        return view('profiles.leave_management.for_approval_list_view', ['date'=>$datetime->toRfc850String()]);
    }

    public function profile_select_user_menu(){
        return view('profiles.select_user_menu');
    }


    // hr staff profile
    public function hrstaff_dashboard(){
        $users=User::with('employees')->get();
        $employees=employee::with('users')->get();
        return view('profiles.hr_staff.hrstaff_dashboard')
        ->with('users',$users)
        ->with('employees',$employees);
        // User::with('employee')->get();
    }
    public function hrstaff_leave_menu(){
        return view('profiles.hr_staff.hr_leave_management.hr_leave_management_menu');
    }
    
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin_organization_menu(){
        return view('profiles.admin.organization.organization_menu');
    }

    // public function admin_organization_departments_grid(){
    //         return view('profiles.admin.organization.departments_grid');
    // }
    // public function admin_organization_departments_list(){
    //     return view('profiles.admin.organization.departments_list');
    // }

    public function admin_organization_department_profile(){
        return view('profiles.admin.organization.department_profile');
    }
    
    public function admin_organization_subdepartments_grid(){
        return view('profiles.admin.organization.subdepartments_grid');
    }
    public function admin_organization_subdepartments_list(){
        return view('profiles.admin.organization.subdepartments_list');
    }
    

    public function admin_login_view(){
        return view('profiles.admin.admin_login');
    }
    public function admin_policy_view(){
        return view('profiles.admin.policy.policy_view');
    }
    public function admin_policy_update(){
        return view('profiles.admin.policy.policy_update');
    }
    public function admin_policy_create(){
        return view('profiles.admin.policy.policy_create');
    }
    public function admin_policy_menu(){
        return view('profiles.admin.policy.policy_menu');
    }
}
