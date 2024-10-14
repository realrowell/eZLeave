<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminLeaveMaintenanceController extends Controller
{
    /**
     * Store leave types here.
     *
     *
     * CREATE LEAVE TYPE
     */
    public function create_leavetypes(Request $request){
        $data = $request->validate([
            'leavetype_title' => 'required|max:50',
            'leavetype_description' => 'required|max:300',
            'days_per_year' => 'nullable',
            'max_days' => 'nullable',
            'cut_off_date' => 'nullable',
            'show_on_employee' => 'nullable',
            'is_accumulable' => 'nullable',
            'apply_predate' => 'nullable',
        ]);

        if($request->has('show_on_employee') == true){
            $data['show_on_employee'] = true;
        }
        else{
            $data['show_on_employee'] = false;
        }


        if($request->has('is_accumulable')){
            $data['is_accumulable'] = true;
        }
        else{
            $data['is_accumulable'] = false;
        }

        if($request->has('apply_predate')){
            $data['apply_predate'] = true;
        }
        else{
            $data['apply_predate'] = false;
        }



        $leave_types = LeaveType::create([
            'leave_type_title' => $data['leavetype_title'],
            'leave_type_description' => $data['leavetype_description'],
            'leave_days_per_year' => $data['days_per_year'],
            'max_leave_days' => $data['max_days'],
            'cut_off_date' => $data['cut_off_date'],
            'show_on_employee' => $data['show_on_employee'],
            'accumulable' => $data['is_accumulable'],
            'predate' => $data['apply_predate'],
        ]);
        Log::notice( "New leave type CREATED by ".auth()->user()->first_name." ".auth()->user()->last_name." with id:".$leave_types->id );
        return redirect()->back()->with('success','Leave type has been created!');
    }

    /**
     * Update leave types here.
     *
     *
     * UPDATE LEAVE TYPE
     */
    public function update_leavetypes(Request $request, $leavetype_id){
        $data = $request->validate([
            // 'leavetype_title' => 'sometimes|max:50',
            'leavetype_description' => 'sometimes|max:300',
            'days_per_year' => 'nullable',
            'max_days' => 'nullable',
            'cut_off_date' => 'nullable',
            'show_on_employee' => 'nullable',
            'is_active' => 'nullable',
            'is_accumulable' => 'nullable',
            'apply_predate' => 'nullable',
        ]);

        if($request->has('is_active')){
            $data['is_active'] = 'sta-1007';
        }
        else{
            $data['is_active'] = 'sta-1008';
        }

        if($request->has('show_on_employee') == true){
            $data['show_on_employee'] = true;
        }
        else{
            $data['show_on_employee'] = false;
        }

        if($request->has('is_accumulable')){
            $data['is_accumulable'] = true;
        }
        else{
            $data['is_accumulable'] = false;
        }

        if($request->has('apply_predate')){
            $data['apply_predate'] = true;
        }
        else{
            $data['apply_predate'] = false;
        }

        $leavecredits = LeaveType::where('id',$leavetype_id)
        ->update([
            // 'leave_type_title' => $data['leavetype_title'],
            'leave_type_description' => $data['leavetype_description'],
            'leave_days_per_year' => $data['days_per_year'],
            'max_leave_days' => $data['max_days'],
            'cut_off_date' => $data['cut_off_date'],
            'show_on_employee' => $data['show_on_employee'],
            'accumulable' => $data['is_accumulable'],
            'predate' => $data['apply_predate'],
            'status_id' => $data['is_active'],
        ]);
        Log::notice( "Leave type UPDATED by ".auth()->user()->first_name." ".auth()->user()->last_name." with id:".$leavetype_id );
        return redirect()->back()->with('success','Leave type has been updated!');
    }

    /**
     * Delete leave types here.
     *
     *
     * DELETE LEAVE TYPE
     */
    public function delete_leavetypes($leavetype_id){
        $leavecredits = LeaveType::where('id',$leavetype_id)
        ->update([
            'status_id' => 'sta-1009',
        ]);
        Log::warning( "Leave type DELETED by ".auth()->user()->first_name." ".auth()->user()->last_name." with id:".$leavetype_id );
        return redirect()->back()->with('warning','Leave type has been deleted!');
    }
}
