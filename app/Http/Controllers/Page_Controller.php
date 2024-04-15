<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Page_Controller extends Controller
{

    public function admin_organization_menu(){
        return view('profiles.admin.organization.organization_menu');
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
