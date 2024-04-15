<?php

namespace App\Http\Controllers\hr_staff;

use App\Http\Controllers\Controller;
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
            'fiscal_year' => 'required',
            'expiration' => 'nullable',
            'show_on_employee' => 'nullable'
        ]);


        if($request->has('show_on_employee') == true){
            $data['show_on_employee'] = true;
        }
        else{
            $data['show_on_employee'] = false;
        }

        // $leavecredit = EmployeeLeaveCredit::where('employee_id','=',$data['employee'])->where('leave_type_id',$data['leavetype'])->where('fiscal_year_id',$data['fiscal_year'])->first();

        if(EmployeeLeaveCredit::where('employee_id','=',$data['employee'])->where('leave_type_id',$data['leavetype'])->where('fiscal_year_id',$data['fiscal_year'])->where('status_id','sta-1007')->exists()){
            $current_leave_credits = EmployeeLeaveCredit::where('employee_id',$data['employee'])->where('leave_type_id', $data['leavetype'])->where('fiscal_year_id',$data['fiscal_year'])->where('status_id','sta-1007')->first();


            // add the old and the new leave days credit value
            $new_leave_credits = $current_leave_credits->leave_days_credit + $data['credits'];
            // dd($data['employee']);

            if($current_leave_credits->employee_id == $data['employee']){
                $new_employee_leave_credits = EmployeeLeaveCredit::create([
                    'leave_type_id' => $data['leavetype'],
                    'employee_id' => $data['employee'],
                    'leave_days_credit' => $new_leave_credits,
                    'status_id'=> 'sta-1007',
                    'fiscal_year_id' => $data['fiscal_year'],
                    'expiration' => $data['expiration'],
                    'show_on_employee' => $data['show_on_employee'],
                ]);
                $update_current_leave_credits = EmployeeLeaveCredit::where('id',$current_leave_credits->id)
                    ->update([
                        'status_id' => 'sta-1006',
                ]);
            }

            return redirect()->back()->with('success','Leave credit has been updated!');
        }
        else{
            $employee_leave_credit = EmployeeLeaveCredit::create([
                'leave_type_id' => $data['leavetype'],
                'employee_id' => $data['employee'],
                'leave_days_credit' => $data['credits'],
                'fiscal_year_id' => $data['fiscal_year'],
                'show_on_employee' => $data['show_on_employee'],
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
            'credits' => 'sometimes',
            'show_on_employee' => 'nullable'
        ]);

        if($request->has('show_on_employee') == true){
            $data['show_on_employee'] = true;
        }
        else{
            $data['show_on_employee'] = false;
        }

        $leavecredits = EmployeeLeaveCredit::where('id',$leavecredit_id)
        ->update([
            'leave_days_credit' => $data['credits'],
            'show_on_employee'=> $data['show_on_employee'],
        ]);
        return redirect()->back()->with('success','Leave credit has been updated!');
    }


}
