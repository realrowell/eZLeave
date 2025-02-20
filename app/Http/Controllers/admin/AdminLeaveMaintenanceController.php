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

        $existing_leavetypes = LeaveType::where('status_id','sta-1007')->get();
        foreach($existing_leavetypes as $existing_leavetype){
            if(strtolower($existing_leavetype->leave_type_title) == strtolower($data['leavetype_title'])){
                return redirect()->back()->with('error','Leave type already exists!');
            }
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
        Log::info( "SYSTEM UPDATE NOTICE || Leave Type Creation || ".$leave_types->leave_type_title." has been created by: ".auth()->user()->email );
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
        Log::info( "SYSTEM UPDATE NOTICE || Leave Type Update || ".$leavetype_id." has been updated by: ".auth()->user()->email );
        return redirect()->back()->with('success','Leave type has been updated!');
    }

    /**
     * Delete leave types here.
     *
     *
     * DELETE LEAVE TYPE
     */
    public function archive_leavetypes($leavetype_id){
        $leavecredits = LeaveType::where('id',$leavetype_id)
        ->update([
            'status_id' => 'sta-1006',
        ]);
        Log::info( "SYSTEM UPDATE NOTICE || Leave Type Archived || ".$leavetype_id." has been archived by: ".auth()->user()->email );
        return redirect()->back()->with('warning','Leave type has been archived!');
    }

    public function unarchive_leavetypes($leavetype_id){
        $existing_leavetypes = LeaveType::where('status_id','sta-1007')->get();
        $current_leavetype = LeaveType::where('id',$leavetype_id)->first();
        foreach($existing_leavetypes as $existing_leavetype){
            if(strtolower($existing_leavetype->leave_type_title) == strtolower($current_leavetype->leave_type_title)){
                return redirect()->back()->with('error','Leave type already exists!');
            }
        }

        $leavecredits = LeaveType::where('id',$leavetype_id)
        ->update([
            'status_id' => 'sta-1007',
        ]);
        Log::info( "SYSTEM UPDATE NOTICE || Leave Type Unarchived || ".$leavetype_id." has been unarchived by: ".auth()->user()->email );
        return redirect()->back()->with('success','Leave type has been unarchived!');
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
        Log::info( "SYSTEM UPDATE NOTICE || Leave Type Deleted || ".$leavetype_id." has been deleted by: ".auth()->user()->email );
        return redirect()->back()->with('warning','Leave type has been deleted!');
    }
}
