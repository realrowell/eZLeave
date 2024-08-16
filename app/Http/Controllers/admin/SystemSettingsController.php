<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    public function system_settings_view(){
        return view('profiles.admin.settings.system_settings');
    }
    public function email_settings_info_view(){
        return view('profiles.admin.settings.email_settings_info');
    }
    public function app_info_view(){
        return view('profiles.admin.settings.app_info');
    }
    public function system_info_view(){
        return view('profiles.admin.settings.system_info');
    }
}
