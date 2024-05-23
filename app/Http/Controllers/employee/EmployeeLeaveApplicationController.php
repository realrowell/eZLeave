<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveCredit;
use App\Models\FiscalYear;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveCreditLog;
use App\Models\LeaveType;
use App\Models\Notification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class EmployeeLeaveApplicationController extends Controller
{
    /**
     * Store employee leave application here.
     *
     *
     * CREATE LEAVE APPLICATION
     */
    public function create_employee_leaveapplication(Request $request){
        $data = $request->validate([
            'leavetype' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'reason' => 'nullable',
            'attachment' => 'nullable',
            'start_am_check' => 'nullable',
            'start_pm_check' => 'nullable',
            'end_pm_check' => 'nullable',
        ]);

        $current_leave_type = LeaveType::where('id',$data['leavetype'])->first();
        $employee = auth()->user()->employees;
        $leave_application_leave_type = LeaveType::where('id',$request['leavetype'])->where('status_id','sta-1007')->first();
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $employee_leave_credits = EmployeeLeaveCredit::where('employee_id',$employee->id)->where('leave_type_id', $leave_application_leave_type->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1007')->first();

        if(optional(auth()->user()->employees->employee_positions)->reports_to_id == null){
            return redirect()->back()->with('warning','Unsuccessful leave application! Please contact you HR officer (sys_error_code: 1001)');
        }
        if($employee_leave_credits == null){
            return redirect()->back()->with('warning','Unsuccessful leave application! Please contact you HR officer (sys_error_code: 1002)');
        }

        $startDate = new DateTime($data['startdate']);
        $endDate = new DateTime($data['enddate']);
        $durationDays = 0;
        $start_part_of_day = 'dprt-1001';
        $end_part_of_day = 'dprt-1001';

        if($startDate <= $current_year){
            if($current_leave_type->predate == false){
                return redirect()->back()->with('error','Unsuccessful leave application! Please select date from tomorrow onwoards');
            }
        }
        // check if the request date is a half day
        if( $startDate == $endDate){
            if($request->start_am_check==true || $request->end_pm_check==true){
                if($request->start_am_check==true){
                    $durationDays = $durationDays+0.5;
                    $start_part_of_day = 'dprt-1002';
                }
                if($request->end_pm_check==true){
                    $durationDays = $durationDays+0.5;
                    $end_part_of_day = 'dprt-1003';
                }
                // $durationDays = 1;

            }
            else{
                // Check if the start date is greater than or equal to end date
                if ($startDate > $endDate) {
                    return response(['message'=>"Invalid Date Range"],400);
                }

                // Get number of days between two dates
                $durationInterval = $startDate->diff($endDate);
                $durationDays = $durationInterval->format('%a');

                // Add one day to get correct number of days (because diff() method counts the start day too)
                $durationDays++;
            }
        }
        else{
            // Get number of days between two dates
            $durationInterval = $startDate->diff($endDate);
            $durationDays = $durationInterval->format('%a');

            // Add one day to get correct number of days (because diff() method counts the start day too)
            $durationDays++;
            if($request->start_pm_check==true || $request->end_am_check==true){
                if($request->start_pm_check==true){
                    $durationDays = $durationDays-0.5;
                    $start_part_of_day = 'dprt-1003';
                }
                if($request->end_am_check==true){
                    $durationDays = $durationDays-0.5;
                    $end_part_of_day = 'dprt-1002';
                }

                // dd($durationDays);
            }
        }


        if($request->hasFile('attachment')){
            $fileNameExt = $request->file('attachment')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = 'leave.attachment.'.$fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('attachment')->storeAs('public/images',$fileNameToStore);

            $leaveapplication = LeaveApplication::create([
                'leave_type_id' => $data['leavetype'],
                'start_date' => $data['startdate'],
                'start_part_of_day' => $start_part_of_day,
                'end_date' => $data['enddate'],
                'end_part_of_day' => $end_part_of_day,
                'duration' => $durationDays,
                'attachment' => $fileNameToStore,
                'employee_id' => auth()->user()->employees->id,
                'approver_id' => auth()->user()->employees->employee_positions->reports_tos->id,
                'second_approver_id' => auth()->user()->employees->employee_positions->second_superior_id,
                'fiscal_year_id' => $current_fiscal_year->id,
                'status_id' => 'sta-1001'
            ]);
            if(auth()->user()->employees->employee_positions->second_superior_id != null){
                $leave_approval = LeaveApproval::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'approver_id' => auth()->user()->employees->employee_positions->second_reports_tos->users->id,
                    'status_id' => 'sta-1001'
                ]);
            }
            $leave_approval = LeaveApproval::create([
                'leave_application_reference' => $leaveapplication->reference_number,
                'approver_id' => auth()->user()->employees->employee_positions->reports_tos->users->id,
                'status_id' => 'sta-1001'
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'reason_note' => $data['reason'],
                    'author_id' => auth()->user()->id
                ]);
            }
            $notification = Notification::create([
                'title' => 'New Leave Application',
                'subject' => $leaveapplication->reference_number.' is ready for your Approval',
                'body' => $leaveapplication->reference_number,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $leaveapplication->approvers->users->id,
            ]);
        }
        else{
            $leaveapplication = LeaveApplication::create([
                'leave_type_id' => $data['leavetype'],
                'start_date' => $data['startdate'],
                'start_part_of_day' => $start_part_of_day,
                'end_date' => $data['enddate'],
                'end_part_of_day' => $end_part_of_day,
                'duration' => $durationDays,
                'employee_id' => auth()->user()->employees->id,
                'approver_id' => auth()->user()->employees->employee_positions->reports_to_id,
                'second_approver_id' => auth()->user()->employees->employee_positions->second_superior_id,
                'fiscal_year_id' => $current_fiscal_year->id,
                'status_id' => 'sta-1001'
            ]);
            if(auth()->user()->employees->employee_positions->second_superior_id != null){
                $leave_approval = LeaveApproval::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'approver_id' => auth()->user()->employees->employee_positions->second_reports_tos->users->id,
                    'status_id' => 'sta-1001'
                ]);
            }
            $leave_approval = LeaveApproval::create([
                'leave_application_reference' => $leaveapplication->reference_number,
                'approver_id' => auth()->user()->employees->employee_positions->reports_tos->users->id,
                'status_id' => 'sta-1001'
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'reason_note' => $data['reason'],
                    'author_id' => auth()->user()->id
                ]);
            }
            $notification = Notification::create([
                'title' => 'New Leave Application',
                'subject' => $leaveapplication->reference_number.' is ready for your Approval',
                'body' => $leaveapplication->reference_number,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $leaveapplication->approvers->users->id,
            ]);
        }
        return redirect()->back()->with('success','Leave Application has been filed for approval!');
    }

    /**
     * Update employee leave application here.
     *
     *
     * UPDATE LEAVE APPLICATION
     */
    public function update_employee_leaveapplication(Request $request, $leave_application_rn){

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();

        $data = $request->validate([
            'startdate' => 'nullable',
            'enddate' => 'nullable',
            'reason' => 'max:255',
            'attachment' => 'nullable'
        ]);


        if($leave_applications->employees?->gender_id == 'gen-0001'){
            $notification_title = ' updated his Leave Application';
        }
        elseif($leave_applications->employees?->gender_id == 'gen-0002'){
            $notification_title = ' updated her Leave Application';
        }
        else{
            $notification_title = ' updated the Leave Application';
        }

        if($leave_applications->status_id == 'sta-1001'){
            $notification_receiver = $leave_applications->approvers?->users?->id;
        }
        elseif($leave_applications->status_id == 'sta-1003'){
            $notification_receiver = $leave_applications->second_approvers?->users?->id;
        }

        if($request->has('startdate') && $request->has('enddate')){
            //initialize start and end date
            $startDate = new DateTime($data['startdate']);
            $endDate = new DateTime($data['enddate']);
            $durationDays = 0;
            $start_part_of_day = 'dprt-1001';
            $end_part_of_day = 'dprt-1001';

            // check if the request date is same date
            if( $startDate == $endDate){
                if($request->start_am_check==true || $request->end_pm_check==true){
                    if($request->start_am_check==true){
                        $durationDays = $durationDays+0.5;
                        $start_part_of_day = 'dprt-1002';
                    }
                    if($request->end_pm_check==true){
                        $durationDays = $durationDays+0.5;
                        $end_part_of_day = 'dprt-1003';
                    }
                }
                else{
                    // Check if the start date is greater than or equal to end date
                    if ($startDate > $endDate) {
                        return response(['message'=>"Invalid Date Range"],400);
                    }

                    // Get number of days between two dates
                    $durationInterval = $startDate->diff($endDate);
                    $durationDays = $durationInterval->format('%a');

                    // Add one day to get correct number of days (because diff() method counts the start day too)
                    $durationDays++;
                }
            }
            else{
                // Get number of days between two dates
                $durationInterval = $startDate->diff($endDate);
                $durationDays = $durationInterval->format('%a');

                // Add one day to get correct number of days (because diff() method counts the start day too)
                $durationDays++;
                if($request->start_pm_check==true || $request->end_am_check==true){
                    if($request->start_pm_check==true){
                        $durationDays = $durationDays-0.5;
                        $start_part_of_day = 'dprt-1003';
                    }
                    if($request->end_am_check==true){
                        $durationDays = $durationDays-0.5;
                        $end_part_of_day = 'dprt-1002';
                    }
                }
            }
        }
        else{
            $data['startdate'] = $leave_applications->start_date;
            $data['enddate'] = $leave_applications->end_date;
            $start_part_of_day = $leave_applications->start_part_of_day;
            $end_part_of_day = $leave_applications->end_part_of_day;
            $durationDays = $leave_applications->duration;
        }


        if($request->hasFile('attachment')){
            $fileNameExt = $request->file('attachment')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = 'leave.attachment.'.$fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('attachment')->storeAs('public/images',$fileNameToStore);

            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
            ->update([
                'start_date' => $data['startdate'],
                'start_part_of_day'=> $start_part_of_day,
                'end_date' => $data['enddate'],
                'end_part_of_day' => $end_part_of_day,
                'duration' => $durationDays,
                'attachment' => $fileNameToStore,
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leave_application_rn,
                    'reason_note' => $data['reason'],
                    'author_id' => auth()->user()->id
                ]);
            }

            $notification = Notification::create([
                'title' => $leave_applications->employees->users->first_name.$notification_title,
                'subject' => $leave_applications->reference_number.' is ready for your Approval',
                'body' => $leave_applications->reference_number,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $notification_receiver,
            ]);
        }
        else{
            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
            ->update([
                'start_date' => $data['startdate'],
                'start_part_of_day'=> $start_part_of_day,
                'end_date' => $data['enddate'],
                'end_part_of_day' => $end_part_of_day,
                'duration' => $durationDays,
            ]);

            $notification = Notification::create([
                'title' => $leave_applications->employees->users->first_name.$notification_title,
                'subject' => $leave_applications->reference_number.' is ready for your Approval',
                'body' => $leave_applications->reference_number,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $notification_receiver,
            ]);

            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leave_application_rn,
                    'reason_note' => $data['reason'],
                    'author_id' => auth()->user()->id
                ]);
            }
        }

        return redirect()->back()->with('success','Leave Application has been updated!');
    }

    /**
     * approval of employee leave application goes here.
     *
     *
     * LEAVE APPLICATION APPROVAL
     */
    public function employee_leave_application_approval($leave_application_rn){
        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        // $employee_leave_credits = $leave_applications->employee_leave_credits->leave_days_credit; //get the number of leaves left for this employee
        // $current_leave_credits = EmployeeLeaveCredit::where('id',$leave_applications->employee_leave_credit_id)->first();  //get current employee leave credits ID
        $current_leave_credits = EmployeeLeaveCredit::where('employee_id',$leave_applications->employee_id)->where('leave_type_id', $leave_applications->leave_type_id)->where('fiscal_year_id',$leave_applications->fiscal_year_id)->where('status_id','sta-1007')->first();

        // compute the leave credits
        $leave_credited = $current_leave_credits->leave_days_credit - $leave_applications->duration;
        // leave application employee id initialization
        $employee_id = $leave_applications->employee_id;
        // leave  type id initialization
        $leave_type_id = $leave_applications->leave_type_id;
        //
        // $leave_credit_status = $leave_applications->employee_leave_credits->status_id;

        // dd(LeaveApproval::where('leave_application_reference',$leave_application_rn)->where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1002')->first());

        if(auth()->user()->role_id == "rol-0003"){
            if(auth()->user()->employees->id == $leave_applications->employees->id || auth()->user()->employees->id == $leave_applications->approver_id || auth()->user()->employees->id == $leave_applications->second_approver_id){
                if($leave_applications->approver_id == auth()->user()->employees->id){
                    // dd('first approver');
                    $leave_approvals = LeaveApproval::create([
                        'leave_application_reference' => $leave_application_rn,
                        'approver_id' => auth()->user()->employees->users->id,
                        'status_id' => 'sta-1002'
                    ]);
                    $update_leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                        ->update([
                            'status_id' => 'sta-1003'
                    ]);
                    if($leave_applications?->second_approver_id != null){
                        $notification = Notification::create([
                            'title' => 'Leave Application Approval',
                            'subject' => $leave_application_rn.' is ready for your approval',
                            'body' => $leave_application_rn,
                            'notification_type_id' => 'nt-1002',
                            'author_id' => auth()->user()->id,
                            'employee_id' => $leave_applications->second_approvers->users->id,
                        ]);
                    }
                }
                if(optional($leave_applications)->second_approver_id != null && $leave_applications->second_approver_id == auth()->user()->employees->id){

                    $second_leave_approval = LeaveApproval::where('leave_application_reference',$leave_application_rn)->where('approver_id',auth()->user()->employees->id)->where('status_id','sta-1002')->first();
                    if($second_leave_approval == null){
                        // dd('second approver');
                        $leave_approvals = LeaveApproval::create([
                            'leave_application_reference' => $leave_application_rn,
                            'approver_id' => auth()->user()->employees->users->id,
                            'status_id' => 'sta-1002'
                        ]);
                        $new_employee_leave_credits = EmployeeLeaveCredit::create([
                            'leave_type_id' => $current_leave_credits->leave_type_id,
                            'employee_id' => $employee_id,
                            'leave_days_credit' => $leave_credited,
                            'status_id'=> 'sta-1007',
                            'fiscal_year_id' => $current_leave_credits->fiscal_year_id,
                            'expiration' => $current_leave_credits->expiration,
                            'show_on_employee' => $current_leave_credits->show_on_employee,
                        ]);
                        $update_current_leave_credits = EmployeeLeaveCredit::where('id',$current_leave_credits->id)
                            ->update([
                                'status_id' => 'sta-1006',
                        ]);
                        $update_leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                        ->update([
                            'status_id' => 'sta-1002'
                        ]);
                        $reason_note = 'Leave Credited | Leave Application Approved | '.$leave_application_rn;

                        $employee_leave_credit_logs = LeaveCreditLog::create([
                            'employee_leave_credits_id' => $new_employee_leave_credits->id,
                            'leave_application_rn' => $leave_application_rn,
                            'leave_days_credit' => '-'.$leave_applications->duration,
                            'reason_note' => $reason_note,
                            'employee_id' => $employee_id,
                            'fiscal_year_id' => $current_leave_credits->fiscal_year_id,
                        ]);
                    }
                }
                if( $leave_applications?->second_approver_id == null){
                    $new_employee_leave_credits = EmployeeLeaveCredit::create([
                        'leave_type_id' => $current_leave_credits->leave_type_id,
                        'employee_id' => $employee_id,
                        'leave_days_credit' => $leave_credited,
                        'status_id'=> 'sta-1007',
                        'fiscal_year_id' => $current_leave_credits->fiscal_year_id,
                        'expiration' => $current_leave_credits->expiration,
                        'show_on_employee' => $current_leave_credits->show_on_employee,
                    ]);
                    $update_current_leave_credits = EmployeeLeaveCredit::where('id',$current_leave_credits->id)
                        ->update([
                            'status_id' => 'sta-1006',
                    ]);
                    $update_leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                        ->update([
                            'status_id' => 'sta-1002'
                    ]);

                    $reason_note = 'Leave Credited | Leave Application Approved | '.$leave_application_rn;

                    $employee_leave_credit_logs = LeaveCreditLog::create([
                        'employee_leave_credits_id' => $new_employee_leave_credits->id,
                        'leave_application_rn' => $leave_application_rn,
                        'leave_days_credit' => '-'.$leave_applications->duration,
                        'reason_note' => $reason_note,
                        'employee_id' => $employee_id,
                        'fiscal_year_id' => $current_leave_credits->fiscal_year_id,
                    ]);
                }
                $notification = Notification::create([
                    'title' => 'Leave Application Approved!',
                    'subject' => $leave_application_rn.' has been approved!',
                    'body' => $leave_application_rn,
                    'notification_type_id' => 'nt-1002',
                    'author_id' => auth()->user()->id,
                    'employee_id' => $leave_applications->employees->users->id,
                ]);
                return redirect()->back()->with('success','Leave Application has been approved!');
            }
            else{
                return redirect()->back()->with('error','You are not authorize!');
            }
        }
        // elseif(auth()->user()->role_id == "rol-0001" || auth()->user()->role_id == "rol-0002"){
        //     $leave_approvals = LeaveApproval::create([
        //         'leave_application_reference' => $leave_application_rn,
        //         'approver_id' => auth()->user()->employees->users->id,
        //         'status_id' => 'sta-1002'
        //     ]);
        //     $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
        //         ->update([
        //             'status_id' => 'sta-1002'
        //         ]);
        //     return redirect()->back()->with('success','Leave Application has been approved!');
        // }
        else{
            return redirect()->back()->with('error','You are not authorize!');
        }
    }

    /**
     * add notes for employee leave application here.
     *
     *
     * ADD NOTES FOR LEAVE APPLICATION
     */
    public function create_note_employee_leaveapplication(Request $request, $leave_application_rn){
        $data = $request->validate([
            'reason' => 'max:255',
        ]);

        $data['reason'] = strip_tags($data['reason']);

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();

        if($request->input('reason')){
            $leave_application_note = LeaveApplicationNote::create([
                'leave_application_reference' => $leave_application_rn,
                'reason_note' => $data['reason'],
                'author_id' => auth()->user()->id
            ]);
        }
        if($leave_applications->employee_id == auth()->user()->employees->id){
            if($leave_applications->status_id == 'sta-1001'){
                $notification = Notification::create([
                    'title' => auth()->user()->first_name.' leave a note',
                    'subject' => auth()->user()->first_name.' leave a note for '.$leave_application_rn,
                    'body' => $leave_application_rn,
                    'notification_type_id' => 'nt-1002',
                    'author_id' => auth()->user()->id,
                    'employee_id' => $leave_applications->approvers->users->id,
                ]);
            }
            elseif($leave_applications->status_id == 'sta-1003'){
                $notification = Notification::create([
                    'title' => auth()->user()->first_name.' leave a note',
                    'subject' => auth()->user()->first_name.' leave a note for '.$leave_application_rn,
                    'body' => $leave_application_rn,
                    'notification_type_id' => 'nt-1002',
                    'author_id' => auth()->user()->id,
                    'employee_id' => $leave_applications->second_approvers->users->id,
                ]);
            }
        }
        elseif($leave_applications->approver_id == auth()->user()->employees->id || $leave_applications->second_approver_id == auth()->user()->employees->id){
            $notification = Notification::create([
                'title' => auth()->user()->first_name.' leave a note',
                'subject' => auth()->user()->first_name.' leave a note for '.$leave_application_rn,
                'body' => $leave_application_rn,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $leave_applications->employees->users->id,
            ]);
        }
        return redirect()->back()->with('success','You successfully add a note!');
    }

    /**
     * rejection of employee leave application goes here.
     *
     *
     * LEAVE APPLICATION REJECTION
     */
    public function employee_leave_application_rejection(Request $request, $leave_application_rn){
        $data = $request->validate([
            'reason' => 'required',
        ]);

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        if(auth()->user()->role_id == "rol-0003"){
            if(auth()->user()->employees->id == $leave_applications->employees->id || auth()->user()->employees->id == $leave_applications->approver_id || auth()->user()->employees->id == $leave_applications->second_approver_id){
                $leave_approvals = LeaveApproval::create([
                    'leave_application_reference' => $leave_application_rn,
                    'approver_id' => auth()->user()->employees->users->id,
                    'reason_note' => $data['reason'],
                    'status_id' => 'sta-1004'
                ]);
                $update_leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                    ->update([
                        'status_id' => 'sta-1004'
                    ]);
                $notification = Notification::create([
                    'title' => 'Leave Application Rejected!',
                    'subject' => $leave_application_rn.' has been rejected',
                    'body' => $leave_application_rn,
                    'notification_type_id' => 'nt-1002',
                    'author_id' => auth()->user()->id,
                    'employee_id' => $leave_applications->employees->users->id,
                ]);
                return redirect()->back()->with('warning','Leave Application has been rejected!');
            }
            else{
                return redirect()->back()->with('error','You are not authorize!');
            }
        }
        elseif(auth()->user()->role_id == "rol-0001" || auth()->user()->role_id == "rol-0002"){
            $leave_approvals = LeaveApproval::create([
                'leave_application_reference' => $leave_application_rn,
                'approver_id' => auth()->user()->employees->users->id,
                'reason_note' => $data['reason'],
                'status_id' => 'sta-1004'
            ]);
            $update_leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                ->update([
                    'status_id' => 'sta-1004'
                ]);
            $notification = Notification::create([
                'title' => 'Leave Application Rejected!',
                'subject' => $leave_application_rn.' has been rejected',
                'body' => $leave_application_rn,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $leave_applications->employees->users->id,
            ]);
            return redirect()->back()->with('warning','Leave Application has been rejected!');
        }
        else{
            return redirect()->back()->with('error','You are not authorize!');
        }
    }

    /**
     * cancellation of employee leave application goes here.
     *
     *
     * LEAVE APPLICATION CANCELLATION
     */
    public function employee_leave_application_cancellation(Request $request, $leave_application_rn){
        $data = $request->validate([
            'reason' => 'required',
        ]);
        return redirect()->back()->with('warning','Leave Application has been cancelled!');

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();

        if(auth()->user()->role_id == "rol-0003"){
            if(auth()->user()->employees->id == $leave_applications->employees->id || auth()->user()->employees->id == $leave_applications->approver_id){
                $leave_approvals = LeaveApproval::create([
                    'leave_application_reference' => $leave_application_rn,
                    'reason_note' => $data['reason'],
                    'approver_id' => auth()->user()->employees->users->id,
                    'status_id' => 'sta-1005'
                ]);
                $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                    ->update([
                        'status_id' => 'sta-1005'
                    ]);
                    return redirect()->back()->with('warning','Leave Application has been cancelled!');
            }
            else{
                return redirect()->back()->with('error','You are not authorize!');
            }
        }
        elseif(auth()->user()->role_id == "rol-0001" || auth()->user()->role_id == "rol-0002"){
            $leave_approvals = LeaveApproval::create([
                'leave_application_reference' => $leave_application_rn,
                'reason_note' => $data['reason'],
                'approver_id' => auth()->user()->employees->users->id,
                'status_id' => 'sta-1005'
            ]);
            $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                ->update([
                    'status_id' => 'sta-1005'
                ]);
                return redirect()->back()->with('warning','Leave Application has been cancelled!');
        }
        else{
            return redirect()->back()->with('error','You are not authorize!');
        }
    }
}
