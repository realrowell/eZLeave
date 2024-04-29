<?php

namespace App\Http\Controllers\hr_staff;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypesController extends Controller
{

    public function hrstaff_leave_types(){
        $leavetypes = LeaveType::all()->where('status_id','sta-1007');
        return view('profiles.hr_staff.hr_leave_management.leave_types',
        [
            'leavetypes'=>$leavetypes
        ]);
    }

    // /**
    //  * Store leave types here.
    //  *
    //  *
    //  * CREATE LEAVE TYPE
    //  */
    // public function create_leavetypes(Request $request){
    //     $data = $request->validate([
    //         'leavetype_title' => 'required|max:50',
    //         'leavetype_description' => 'required|max:300',
    //         'days_per_year' => 'nullable',
    //         'max_days' => 'nullable',
    //         'reset_date' => 'nullable',
    //         'cut_off_date' => 'nullable',
    //         'show_on_employee' => 'nullable',
    //         'is_accumulable' => 'nullable',
    //         'apply_predate' => 'nullable',
    //     ]);

    //     if($request->has('show_on_employee') == true){
    //         $data['show_on_employee'] = true;
    //     }
    //     else{
    //         $data['show_on_employee'] = false;
    //     }


    //     if($request->has('is_accumulable')){
    //         $data['is_accumulable'] = true;
    //     }
    //     else{
    //         $data['is_accumulable'] = false;
    //     }

    //     if($request->has('apply_predate')){
    //         $data['apply_predate'] = true;
    //     }
    //     else{
    //         $data['apply_predate'] = false;
    //     }



    //     $leave_types = LeaveType::create([
    //         'leave_type_title' => $data['leavetype_title'],
    //         'leave_type_description' => $data['leavetype_description'],
    //         'leave_days_per_year' => $data['days_per_year'],
    //         'max_leave_days' => $data['max_days'],
    //         'cut_off_date' => $data['cut_off_date'],
    //         'show_on_employee' => $data['show_on_employee'],
    //         'accumulable' => $data['is_accumulable'],
    //         'predate' => $data['apply_predate'],
    //     ]);
    //     return redirect()->back()->with('success','Leave type has been created!');
    // }

    /**
     * Update leave types here.
     *
     *
     * UPDATE LEAVE TYPE
     */
    public function update_leavetypes(Request $request, $leavetype_id){
        $data = $request->validate([
            'leavetype_title' => 'sometimes|max:50',
            'leavetype_description' => 'sometimes|max:300',
            'days_per_year' => 'nullable',
            'max_days' => 'nullable',
            'reset_date' => 'nullable',
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
            'leave_type_title' => $data['leavetype_title'],
            'leave_type_description' => $data['leavetype_description'],
            'leave_days_per_year' => $data['days_per_year'],
            'max_leave_days' => $data['max_days'],
            'reset_date' => $data['reset_date'],
            'cut_off_date' => $data['cut_off_date'],
            'show_on_employee' => $data['show_on_employee'],
            'accumulable' => $data['is_accumulable'],
            'predate' => $data['apply_predate'],
            'status_id' => $data['is_active'],
        ]);
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
        return redirect()->back()->with('warning','Leave type has been deleted!');
    }
}
