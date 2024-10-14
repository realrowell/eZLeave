<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
    public function email_test_view(){
        return view('profiles.admin.settings.email_test');
    }
    public function app_info_view(){
        return view('profiles.admin.settings.app_info');
    }
    public function system_info_view(){
        return view('profiles.admin.settings.system_info');
    }
    public function db_info_view(){
        return view('profiles.admin.settings.database_info');
    }
    public function other_info_view(){
        return view('profiles.admin.settings.other_info');
    }
    public function queue_info_view(){
        $failed_jobs = DB::table('failed_jobs')->get();
        $data = [
            'failed_jobs_count' => $failed_jobs->count(),
        ];

        return view('profiles.admin.settings.queue_info')->with($data);
    }
}
