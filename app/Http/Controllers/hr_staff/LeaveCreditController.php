<?php

namespace App\Http\Controllers\hr_staff;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveCredit;
use App\Models\FiscalYear;
use App\Models\LeaveCreditLog;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

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
            'show_on_employee' => 'nullable',
            'reason_note' => 'nullable',
        ]);

        if($request->has('show_on_employee') == true){
            $data['show_on_employee'] = true;
        }
        else{
            $data['show_on_employee'] = false;
        }

        //get past fiscal year
        $current_date = Carbon::now();
        $past_date = $current_date->subYear();
        $current_fiscal_year = FiscalYear::where('id',$data['fiscal_year'])->first();

        //convert fiscal year start and end date from string to date
        $fiscal_start_of = strtotime($current_fiscal_year->fiscal_year_start);
        $fiscal_start_nf = date('Y-m-d',$fiscal_start_of);
        $fiscal_end_of = strtotime($current_fiscal_year->fiscal_year_end);
        $fiscal_end_nf = date('Y-m-d',$fiscal_end_of);
        $past_fiscal_start = Carbon::parse($fiscal_start_nf)->subYear();
        $past_fiscal_end = Carbon::parse($fiscal_end_nf)->subYear();

        //get past fiscal year
        $past_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $past_fiscal_start->toDateString())->where('fiscal_year_end','>=',$past_fiscal_end->toDateString())->first();

        //get past fiscal year leave credits
        $past_fy_leave_credits = EmployeeLeaveCredit::where('employee_id','=',$data['employee'])->where('leave_type_id',$data['leavetype'])->where('fiscal_year_id',$past_fiscal_year->id)->where('status_id','sta-1007')->first();


        $leave_types = LeaveType::where('id',$data['leavetype'])->first();

        //check if employee has leave credit in the past fiscal year
        if(EmployeeLeaveCredit::where('employee_id','=',$data['employee'])->where('leave_type_id',$data['leavetype'])->where('fiscal_year_id',$data['fiscal_year'])->where('status_id','sta-1007')->exists()){
            $current_leave_credits = EmployeeLeaveCredit::where('employee_id',$data['employee'])->where('leave_type_id', $data['leavetype'])->where('fiscal_year_id',$data['fiscal_year'])->where('status_id','sta-1007')->first();

            // add the old and the new leave days credit value
            $new_leave_credits = $current_leave_credits->leave_days_credit + $data['credits'];

            if($current_leave_credits->employee_id == $data['employee']){
                $leave_credits = $new_leave_credits;
                $leave_log_note = $data['reason_note'];
                if($leave_types->max_leave_days > $leave_credits){
                    $leave_credits = $current_leave_credits->leave_days_credit + $data['credits'];
                    if($leave_types->max_leave_days <= $leave_credits){
                        $leave_credits = $leave_types->max_leave_days;
                    }
                    else{

                    }
                }
                elseif($leave_types->max_leave_days < $leave_credits){
                    $leave_credits = $leave_types->max_leave_days;
                    $leave_log_note = $leave_log_note." | Exceeds Max Limit";
                }
                else{
                    $leave_log_note = $leave_log_note." | Reach the Max Limit";
                    $leave_credits = $leave_types->max_leave_days;
                }

                $new_employee_leave_credits = EmployeeLeaveCredit::create([
                    'leave_type_id' => $data['leavetype'],
                    'employee_id' => $data['employee'],
                    'leave_days_credit' => $leave_credits,
                    'status_id'=> 'sta-1007',
                    'fiscal_year_id' => $data['fiscal_year'],
                    'expiration' => $data['expiration'],
                    'show_on_employee' => $data['show_on_employee'],
                ]);
                $update_current_leave_credits = EmployeeLeaveCredit::where('id',$current_leave_credits->id)
                    ->update([
                        'status_id' => 'sta-1006',
                ]);
                $employee_leave_credit_logs = LeaveCreditLog::create([
                    'employee_leave_credits_id' => $new_employee_leave_credits->id,
                    'leave_days_credit' => $data['credits'],
                    'reason_note' => $leave_log_note,
                    'employee_id' => $data['employee'],
                    'fiscal_year_id' => $data['fiscal_year'],
                ]);
            }

            return redirect()->back()->with('success','Leave credit has been updated!');
        }
        else{
            if($data['reason_note'] == null){
                $data['reason_note'] = 'Employee Leave Credit creation';
            }

            $leave_credits = $data['credits'];
            $leave_log_note = $data['reason_note'];

            if($leave_types->accumulable == true){
                if($past_fy_leave_credits != null){
                    $leave_log_note = $leave_log_note." | last fy credit: ".$past_fy_leave_credits->leave_days_credit;
                    if($past_fy_leave_credits->leave_days_credit <= 0){
                        $data['credits'];
                    }
                    else{
                        $leave_credits = $past_fy_leave_credits->leave_days_credit + $data['credits'];
                    }
                }
                else{
                    $new_leave_credits = $leave_credits;
                }
            }

            // dd($leave_log_note);
            if($leave_types->max_leave_days >= $leave_credits){
                $new_leave_log_note = $leave_log_note;
                $new_leave_credits = $leave_credits;
            }
            elseif($leave_types->max_leave_days < $leave_credits){
                $new_leave_log_note = $leave_log_note." | Exceeds Max Limit";
                $new_leave_credits = $leave_types->max_leave_days;
            }
            else{
                $new_leave_log_note = $leave_log_note." | Exceeds Max Limit 1";
                $new_leave_credits = $leave_types->max_leave_days;
            }

            $employee_leave_credit = EmployeeLeaveCredit::create([
                'leave_type_id' => $data['leavetype'],
                'employee_id' => $data['employee'],
                'leave_days_credit' => $new_leave_credits,
                'fiscal_year_id' => $data['fiscal_year'],
                'expiration' => $data['expiration'],
                'show_on_employee' => $data['show_on_employee'],
            ]);
            $employee_leave_credit_logs = LeaveCreditLog::create([
                'employee_leave_credits_id' => $employee_leave_credit->id,
                'leave_days_credit' => $data['credits'],
                'reason_note' => $new_leave_log_note,
                'employee_id' => $data['employee'],
                'fiscal_year_id' => $data['fiscal_year'],
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
            // 'credits' => 'sometimes',
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
            // 'leave_days_credit' => $data['credits'],
            'show_on_employee'=> $data['show_on_employee'],
        ]);
        return redirect()->back()->with('success','Leave credit has been updated!');
    }


    public function export()
    {
        $fileprefix = Carbon::now();

        $filename = 'employee-leave-credits'.$fileprefix->format('Ymd').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'LeaveType',
                'Name',
                'Leave Credit',
                'Fiscal Year',
            ]);
            $current_year = Carbon::now();
            $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
             // Fetch and process data in chunks
             EmployeeLeaveCredit::where('status_id','sta-1007')->where('fiscal_year_id',$current_fiscal_year->id)->chunk(25, function ($leavecredits) use ($handle) {
                foreach ($leavecredits as $leavecredit) {
             // Extract data from each employee.
                    $data = [
                        isset($leavecredit->leavetypes->leave_type_title)? $leavecredit->leavetypes->leave_type_title : '',
                        isset($leavecredit->employees->users->first_name)? $leavecredit->employees->users->first_name.' '.$leavecredit->employees->users->last_name : '',
                        isset($leavecredit->leave_days_credit)? $leavecredit->leave_days_credit : '',
                        isset($leavecredit->fiscal_years->fiscal_year_title)? $leavecredit->fiscal_years->fiscal_year_title : '',
                    ];

             // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }
}
