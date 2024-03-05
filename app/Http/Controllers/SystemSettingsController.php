<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public function system_settings_view(){
        return view('profiles.admin.system_settings');
    }
}
