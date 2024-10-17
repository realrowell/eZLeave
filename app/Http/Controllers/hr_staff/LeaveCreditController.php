<?php

namespace App\Http\Controllers\hr_staff;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeLeaveCredit;
use App\Models\EmploymentStatus;
use App\Models\FiscalYear;
use App\Models\LeaveCreditLog;
use App\Models\LeaveType;
use App\Models\SubDepartment;
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


    public function leave_credit_export($fiscal_year){
        $current_fiscal_year = FiscalYear::where('id',$fiscal_year)->first();

        $filename = $current_fiscal_year->fiscal_year_title.'-employee-leave-credits-'.Carbon::now()->format('Ymd').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $employee_leave_credit = EmployeeLeaveCredit::where('status_id','sta-1007')->where('fiscal_year_id',$current_fiscal_year->id);

        return response()->stream(function () use ($employee_leave_credit) {

            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'ID',
                'Name',
                'Position',
                'Department',
                'Sub-department',
                'Employment Status',
                'LeaveType',
                'Leave Credit',
                'Fiscal Year',
            ]);
            $current_year = Carbon::now();
            // $current_fiscal_year = FiscalYear::where('id',$fiscal_year)->first();
             // Fetch and process data in chunks
            $employee_leave_credit->chunk(25, function ($leavecredits) use ($handle) {
                foreach ($leavecredits as $leavecredit) {
                    // Extract data from each employee.
                    $employee_mi = '';
                    if($leavecredit->employees?->users?->middle_name != null){
                        $employee_mi = mb_substr($leavecredit->employees->users->middle_name, 0, 1).'.';
                    }
                    $data = [
                        isset($leavecredit->employees->sap_id_number)? $leavecredit->employees->sap_id_number : '',
                        isset($leavecredit->employees->user_id)? $leavecredit->employees->users->last_name.', '.$leavecredit->employees->users->first_name.' '.$employee_mi.' '.$leavecredit->employees->users?->suffixes?->suffix_title : '',
                        isset($leavecredit->employees->employee_positions->position_id)? $leavecredit->employees->employee_positions->positions->position_description : '',
                        isset($leavecredit->employees->employee_positions->positions->subdepartment_id)? $leavecredit->employees->employee_positions->positions->subdepartments->sub_department_title : '',
                        isset($leavecredit->employees->employee_positions->positions->subdepartments->department_id)? $leavecredit->employees->employee_positions->positions->subdepartments->departments->department_title : '',
                        isset($leavecredit->employees->employment_status_id)? $leavecredit->employees->employment_statuses->employment_status_title : '',
                        isset($leavecredit->leavetypes->leave_type_title)? $leavecredit->leavetypes->leave_type_title : '',
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


    public function leave_credit_export_wizard(Request $request){

        $fiscal_year = $request->fiscalyear;
        $leavetype = LeaveType::where('id', $request->leavetype)->first();
        $department = Department::where('id',$request->department)->first();
        $subdepartment = SubDepartment::where('id',$request->subdepartment)->first();
        $employment_status = EmploymentStatus::where('id',$request->employment_status)->first();

        $current_fiscal_year = FiscalYear::where('id',$fiscal_year)->first();

        $filename = $current_fiscal_year->fiscal_year_title.'-employee-leave-credits-'.Carbon::now()->format('Ymd').'.csv';

        $employee_leave_credits = EmployeeLeaveCredit::where('status_id','sta-1007')
                                ->where('fiscal_year_id',$current_fiscal_year->id);

        if($leavetype != null){
            $employee_leave_credits = $employee_leave_credits->where('leave_type_id',$leavetype->id);
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        if($employment_status != null){
            $employee_leave_credits = $employee_leave_credits->whereHas('employees', function ($query) use ($employment_status) {
                                                                return $query->where('employment_status_id', '=', $employment_status->id);
                                                                });
        }
        if($department != null){
            $employee_leave_credits = $employee_leave_credits->whereHas('employees.employee_positions.positions.subdepartments', function ($query) use ($department) {
                                                                return $query->where('department_id', '=', $department->id);
                                                                });
        }
        if($subdepartment != null){
            $employee_leave_credits = $employee_leave_credits->whereHas('employees.employee_positions.positions', function ($query) use ($subdepartment) {
                                                                return $query->where('subdepartment_id', '=', $subdepartment->id);
                                                                });
        }

        return response()->stream(function () use ($employee_leave_credits,$department) {

            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'ID',
                'Name',
                'Position',
                'Department',
                'Sub-department',
                'Employment Status',
                'LeaveType',
                'Leave Credit',
                'Fiscal Year',
            ]);
            $current_year = Carbon::now();

            // Fetch and process data in chunks
            $employee_leave_credits->chunk(25, function ($leavecredits) use ($handle) {
                foreach ($leavecredits as $leavecredit => $value) {
                    // Extract data from each employee.
                    $employee_mi = '';
                    if($value->employees?->users?->middle_name != null){
                        $employee_mi = mb_substr($value->employees->users->middle_name, 0, 1).'.';
                    }
                    $data = [
                        isset($value->employees->sap_id_number)? $value->employees->sap_id_number : '',
                        isset($value->employees->user_id)? mb_convert_encoding($value->employees->users->last_name, "UCS-4").', '.$value->employees->users->first_name.' '.$employee_mi.' '.$value->employees->users?->suffixes?->suffix_title : '',
                        isset($value->employees->employee_positions->position_id)? $value->employees->employee_positions->positions->position_description : '',
                        isset($value->employees->employee_positions->positions->subdepartments->department_id)? $value->employees->employee_positions->positions->subdepartments->departments->department_title : '',
                        isset($value->employees->employee_positions->positions->subdepartment_id)? $value->employees->employee_positions->positions->subdepartments->sub_department_title : '',
                        isset($value->employees->employment_status_id)? $value->employees->employment_statuses->employment_status_title : '',
                        isset($value->leavetypes->leave_type_title)? $value->leavetypes->leave_type_title : '',
                        isset($value->leave_days_credit)? $value->leave_days_credit : '',
                        isset($value->fiscal_years->fiscal_year_title)? $value->fiscal_years->fiscal_year_title : '',
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
