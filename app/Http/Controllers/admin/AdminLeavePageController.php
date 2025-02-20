<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class AdminLeavePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('authCheckAdminRole');
    }

    public function admin_leave_menu(){
        return view('profiles.admin.leave_management.leave_management_menu');
    }

    /**
     *
     *
     *
     * RETURN Admin Leave types View
     */
    public function admin_leave_types(){
        $leavetypes = LeaveType::where('status_id','sta-1007')->orwhere('status_id','sta-1006')->get();

        return view('profiles.admin.leave_management.leave_types',
        [
            'leavetypes'=>$leavetypes
        ]);
    }

    /**
     *
     *
     *
     * RETURN Admin Fiscal Years View
     */
    public function admin_fiscal_years(){
        $fiscalyears = FiscalYear::where('status_id','sta-1007')->orWhere('status_id','sta-1006')->get();

        return view('profiles.admin.leave_management.fiscal_years',
        [
            'fiscalyears'=>$fiscalyears
        ]);
    }

    /**
     *
     *
     *
     * RETURN Admin Holiday View
     */
    public function admin_holidays(){
        $fiscalyears = FiscalYear::where('status_id','sta-1007')->orWhere('status_id','sta-1006')->get();

        return view('profiles.admin.leave_management.holidays',
        [
            'fiscalyears'=>$fiscalyears
        ]);
    }
}
