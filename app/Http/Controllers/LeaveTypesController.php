<?php

namespace App\Http\Controllers;

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
            'reset_date' => 'nullable'
        ]);

        $data['leavetype_title'] = strip_tags($data['leavetype_title']);
        $data['leavetype_description'] = strip_tags($data['leavetype_description']);
        $data['days_per_year'] = strip_tags($data['days_per_year']);
        $data['max_days'] = strip_tags($data['max_days']);
        $data['reset_date'] = strip_tags($data['reset_date']);

        $leave_types = LeaveType::create([
            'leave_type_title' => $data['leavetype_title'],
            'leave_type_description' => $data['leavetype_description'],
            'leave_days_per_year' => $data['days_per_year'],
            'max_leave_days' => $data['max_days'],
            'reset_date' => $data['reset_date'],
        ]);
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
            'leavetype_title' => 'sometimes|max:50',
            'leavetype_description' => 'sometimes|max:300',
            'days_per_year' => 'nullable',
            'max_days' => 'nullable',
            'reset_date' => 'nullable'
        ]);

        $data['leavetype_title'] = strip_tags($data['leavetype_title']);
        $data['leavetype_description'] = strip_tags($data['leavetype_description']);
        $data['days_per_year'] = strip_tags($data['days_per_year']);
        $data['max_days'] = strip_tags($data['max_days']);
        $data['reset_date'] = strip_tags($data['reset_date']);

        $leavecredits = LeaveType::where('id',$leavetype_id)
        ->update([
            'leave_type_title' => $data['leavetype_title'],
            'leave_type_description' => $data['leavetype_description'],
            'leave_days_per_year' => $data['days_per_year'],
            'max_leave_days' => $data['max_days'],
            'reset_date' => $data['reset_date'],
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
