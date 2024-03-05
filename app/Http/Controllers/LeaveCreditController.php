<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaveCredit;
use Illuminate\Http\Request;

class LeaveCreditController extends Controller
{
    /**
     * Create employee leave credits here.
     *
     * 
     * CREATE LEAVE CREDITS
     */
    public function create_leavecredits(Request $request){
        $data = $request->validate([
            'employee' => 'required',
            'leavetype' => 'required',
            'credits' => 'required',
        ]);

        $data['employee'] = strip_tags($data['employee']);
        $data['leavetype'] = strip_tags($data['leavetype']);
        $data['credits'] = strip_tags($data['credits']);

        $leavecredit_id = EmployeeLeaveCredit::where('employee_id','=',$data['employee'])->where('leave_type_id',$data['leavetype'])->first();
        
        if(EmployeeLeaveCredit::where('employee_id','=',$data['employee'])->where('leave_type_id',$data['leavetype'])->exists()){
            // add the old and the new leave days credit value
            $new_leave_credits = $leavecredit_id->leave_days_credit + $data['credits'];

            $leavecredits = EmployeeLeaveCredit::where('id',$leavecredit_id->id)
            ->update([
                'leave_days_credit' => $new_leave_credits
            ]);
            return redirect()->back()->with('success','Leave credit has been updated!');
        }
        else{
            $employee_leave_credit = EmployeeLeaveCredit::create([
                'leave_type_id' => $data['leavetype'],
                'employee_id' => $data['employee'],
                'leave_days_credit' => $data['credits']
            ]);
            return redirect()->back()->with('success','Leave credit has been given!');
        }
    }

    /**
     * Update employee leave credits here.
     *
     * 
     * UPDATE LEAVE CREDITS
     */
    public function update_leavecredits(Request $request, $leavecredit_id){
        $data = $request->validate([
            'credits' => 'sometimes'
        ]);

        $data['credits'] = strip_tags($data['credits']);

        $leavecredits = EmployeeLeaveCredit::where('id',$leavecredit_id)
        ->update([
            'leave_days_credit' => $data['credits']
        ]);
        return redirect()->back()->with('success','Leave credit has been updated!');
    }


}
