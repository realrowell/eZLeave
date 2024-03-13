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
        return view('profiles.admin.system_settings');
    }
}
