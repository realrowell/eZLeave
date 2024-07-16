<?php

namespace App\Http\Controllers\hr_staff;

use App\Http\Controllers\Controller;
use App\Mail\hrstaff\LeaveAppForApproverMail;
use App\Mail\hrstaff\LeaveAppForEmployeeMail;
use App\Mail\hrstaff\LeaveApprovedForApproverMail;
use App\Mail\hrstaff\LeaveApprovedForEmployeeMail;
use App\Mail\hrstaff\LeaveApprovedForSecondApproverMail;
use App\Mail\LeaveApprovalNotificationMail;
use App\Models\Employee;
use App\Models\EmployeeLeaveCredit;
use App\Models\EmployeePosition;
use App\Models\FiscalYear;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use App\Models\LeaveCreditLog;
use App\Models\LeaveType;
use App\Models\Notification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LeaveApplicationController extends Controller
{

    /**
     * Store employee leave application here.
     *
     *
     * CREATE LEAVE APPLICATION
     */
    public function create_leaveapplication(Request $request){
        $data = $request->validate([
            'employee' => 'required',
            'leavetype' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'reason' => 'nullable',
            'attachment' => 'nullable',
            'start_am_check' => 'nullable',
            'start_pm_check' => 'nullable',
            'end_am_check' => 'nullable',
            'end_pm_check' => 'nullable',
        ]);

        $current_leave_type = LeaveType::where('id',$data['leavetype'])->first();
        $employee = Employee::where('id',$data['employee'])->first();
        $leave_application_leave_type = LeaveType::where('id',$request['leavetype'])->where('status_id','sta-1007')->first();
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $employee_leave_credits = EmployeeLeaveCredit::where('employee_id',$employee->id)->where('leave_type_id', $leave_application_leave_type->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('status_id','sta-1007')->first();

        // dd($employee->id);
        if(optional($employee->employee_positions)->reports_to_id == null){
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
            $fileName = Str::random(20);
            $fileExt = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = 'leave.attachment.'.time().'.'.$fileExt;
            $pathToStore = $request->file('attachment')->storeAs('public/images/leave_attachment',$fileNameToStore);

            $leaveapplication = LeaveApplication::create([
                'leave_type_id' => $data['leavetype'],
                'start_date' => $data['startdate'],
                'start_part_of_day' => $start_part_of_day,
                'end_date' => $data['enddate'],
                'end_part_of_day' => $end_part_of_day,
                'duration' => $durationDays,
                'attachment' => $fileNameToStore,
                'employee_id' => $employee->id,
                'approver_id' => $employee->employee_positions->reports_tos->id,
                'second_approver_id' => $employee->employee_positions->second_superior_id,
                'fiscal_year_id' => $current_fiscal_year->id,
                'status_id' => 'sta-1001'
            ]);
            if($employee->employee_positions->second_superior_id != null){
                $leave_approval = LeaveApproval::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'approver_id' => $employee->employee_positions->second_reports_tos->users->id,
                    'status_id' => 'sta-1001'
                ]);
            }
            $leave_approval = LeaveApproval::create([
                'leave_application_reference' => $leaveapplication->reference_number,
                'approver_id' => $employee->employee_positions->reports_tos->users->id,
                'status_id' => 'sta-1001'
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'reason_note' => $data['reason'],
                    'author_id' => $employee->users->id,
                ]);
            }
        }
        else{
            $leaveapplication = LeaveApplication::create([
                'leave_type_id' => $data['leavetype'],
                'start_date' => $data['startdate'],
                'start_part_of_day' => $start_part_of_day,
                'end_date' => $data['enddate'],
                'end_part_of_day' => $end_part_of_day,
                'duration' => $durationDays,
                'employee_id' => $employee->id,
                'approver_id' => $employee->employee_positions->reports_tos->id,
                'second_approver_id' => $employee->employee_positions->second_superior_id,
                'fiscal_year_id' => $current_fiscal_year->id,
                'status_id' => 'sta-1001'
            ]);
            if($employee->employee_positions->second_superior_id != null){
                $leave_approval = LeaveApproval::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'approver_id' => $employee->employee_positions->second_reports_tos->users->id,
                    'status_id' => 'sta-1001'
                ]);
            }
            $leave_approval = LeaveApproval::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'approver_id' => $employee->employee_positions->reports_tos->users->id,
                    'status_id' => 'sta-1001'
                ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'reason_note' => $data['reason'],
                    'author_id' => $employee->users->id,
                ]);
            }
        }

        $notification = Notification::create([
            'title' => 'New Leave Application',
            'subject' => $leaveapplication->reference_number.' is ready for your Approval',
            'body' => $leaveapplication->reference_number,
            'notification_type_id' => 'nt-1002',
            'author_id' => auth()->user()->id,
            'employee_id' => $leaveapplication->approvers->users->id,
        ]);
        $notification = Notification::create([
            'title' => 'Leave Application has been filed',
            'subject' => $leaveapplication->reference_number.' has been filed by '.auth()->user()->first_name." ".auth()->user()->last_name,
            'body' => $leaveapplication->reference_number,
            'notification_type_id' => 'nt-1002',
            'author_id' => auth()->user()->id,
            'employee_id' => $leaveapplication->employees->users->id,
        ]);

        Mail::to($employee->employee_positions->reports_tos->users->email)->send(new LeaveAppForApproverMail($leaveapplication));
        Mail::to($employee->users->email)->send(new LeaveAppForEmployeeMail($leaveapplication));
        Log::notice('Leave Application '.$leaveapplication->reference_number.' is successfully created by '.auth()->user()->email);
        return redirect()->back()->with('success','Leave Application has been filed for approval!');
    }

    /**
     * Update employee leave application here.
     *
     *
     * UPDATE LEAVE APPLICATION
     */
    public function update_leaveapplication(Request $request, $leave_application_rn){

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn);

        $data = $request->validate([
            'reason' => 'max:255',
            'attachment' => 'nullable',
        ]);

        if($request->hasFile('attachment')){
            $fileNameExt = $request->file('attachment')->getClientOriginalName();
            $fileName = Str::random(20);
            $fileExt = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = 'leave.attachment.'.$fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('attachment')->storeAs('public/images/leave_attachment',$fileNameToStore);

            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
            ->update([
                'attachment' => $fileNameToStore,
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leave_application_rn,
                    'reason_note' => $data['reason'],
                    'author_id' => auth()->user()->id
                ]);
            }
        }
        else{
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leave_application_rn,
                    'reason_note' => $data['reason'],
                    'author_id' => auth()->user()->id
                ]);
            }
        }
        Log::notice('Leave Application '.$leave_application_rn.' is successfully updated by '.auth()->user()->email);
        return redirect()->back()->with('success','Leave Application has been updated!');
    }

    /**
     * approval of employee leave application goes here.
     *
     *
     * LEAVE APPLICATION APPROVAL
     */
    public function leave_application_approval(Request $request, $leave_application_rn){
        $data = $request->validate([
            'reason' => 'required',
        ]);
        // abort(419);

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        $current_leave_credits = EmployeeLeaveCredit::where('employee_id',$leave_applications->employee_id)->where('leave_type_id', $leave_applications->leave_type_id)->where('fiscal_year_id',$leave_applications->fiscal_year_id)->where('status_id','sta-1007')->first();

        // compute the leave credits
        $leave_credited = $current_leave_credits->leave_days_credit - $leave_applications->duration;
        // leave application employee id initialization
        $employee_id = $leave_applications->employee_id;
        // leave  type id initialization
        $leave_type_id = $leave_applications->leave_type_id;
        //
        $leave_application_duration = $leave_applications->duration;

        if(auth()->user()->role_id == "rol-0001" || auth()->user()->role_id == "rol-0002"){
            $leave_approvals = LeaveApproval::create([
                'leave_application_reference' => $leave_application_rn,
                'reason_note' => $data['reason'],
                'approver_id' => auth()->user()->id,
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
            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
                ->update([
                    'status_id' => 'sta-1002'
                ]);

            $data['reason_note'] = 'Leave Credited | Leave Application Approved | '.$leave_application_rn;

            $employee_leave_credit_logs = LeaveCreditLog::create([
                'employee_leave_credits_id' => $new_employee_leave_credits->id,
                'leave_application_rn' => $leave_application_rn,
                'leave_days_credit' => '-'.$leave_application_duration,
                'reason_note' => $data['reason_note'],
                'employee_id' => $employee_id,
                'fiscal_year_id' => $current_leave_credits->fiscal_year_id,
            ]);

            $notification = Notification::create([
                'title' => 'Leave Application Approved!',
                'subject' => $leave_applications->reference_number.' has been approved by '.auth()->user()->first_name." ".auth()->user()->last_name,
                'body' => $leave_applications->reference_number,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $leave_applications->employees->users->id,
            ]);
            Mail::to($leave_applications->employees->users->email)->send(new LeaveApprovedForEmployeeMail($leave_applications, $leave_approvals));

            if($leave_applications->status_id == 'sta-1001'){
                $notification = Notification::create([
                    'title' => 'Leave Application has been Approved!',
                    'subject' => 'Your approval is no longer needed for '.$leave_applications->reference_number,
                    'body' => $leave_applications->reference_number,
                    'notification_type_id' => 'nt-1002',
                    'author_id' => auth()->user()->id,
                    'employee_id' => $leave_applications->approvers->users->id,
                ]);
                Mail::to($leave_applications->approvers->users->email)->send(new LeaveApprovedForApproverMail($leave_applications, $leave_approvals));
                if( $leave_applications->second_approver_id != null ){
                    $notification = Notification::create([
                        'title' => 'Leave Application has been Approved!',
                        'subject' => 'Your approval is no longer needed for '.$leave_applications->reference_number,
                        'body' => $leave_applications->reference_number,
                        'notification_type_id' => 'nt-1002',
                        'author_id' => auth()->user()->id,
                        'employee_id' => $leave_applications->second_approvers->users->id,
                    ]);
                    Mail::to($leave_applications->second_approvers->users->email)->send(new LeaveApprovedForSecondApproverMail($leave_applications, $leave_approvals));
                }
            }
            elseif($leave_applications->status_id == 'sta-1003'){
                if( $leave_applications->second_approver_id != null ){
                    $notification = Notification::create([
                        'title' => 'Leave Application has been Approved!',
                        'subject' => 'Your approval is no longer needed for '.$leave_applications->reference_number,
                        'body' => $leave_applications->reference_number,
                        'notification_type_id' => 'nt-1002',
                        'author_id' => auth()->user()->id,
                        'employee_id' => $leave_applications->second_approvers->users->id,
                    ]);
                    Mail::to($leave_applications->second_approvers->users->email)->send(new LeaveApprovedForSecondApproverMail($leave_applications, $leave_approvals));
                }
            }
            // abort(419);
            Log::notice('Leave Application '.$leave_applications->reference_number.' is successfully approved by '.auth()->user()->email);
            return redirect()->back()->with('success','Leave Application has been approved!');
        }
        else{
            Log::warning('Leave Application '.$leave_applications->reference_number.' is attempted to approve by '.auth()->user()->email);
            return redirect()->back()->with('error','You are not authorize!');
        }
    }

    /**
     * rejection of employee leave application goes here.
     *
     *
     * LEAVE APPLICATION REJECTION
     */
    public function leave_application_rejection(Request $request, $leave_application_rn){
        $data = $request->validate([
            'reason' => 'required',
        ]);

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        if(auth()->user()->role_id == "rol-0001" || auth()->user()->role_id == "rol-0002"){
            $leave_approvals = LeaveApproval::create([
                'leave_application_reference' => $leave_application_rn,
                'reason_note' => $data['reason'],
                'approver_id' => auth()->user()->id,
                'status_id' => 'sta-1004'
            ]);
            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
                ->update([
                    'status_id' => 'sta-1004'
                ]);
            $notification = Notification::create([
                'title' => 'Leave Application Rejected!',
                'subject' => $leave_applications->reference_number.' has been rejected by '.auth()->user()->first_name." ".auth()->user()->last_name,
                'body' => $leave_applications->reference_number,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $leave_applications->employees->users->id,
            ]);
            if($leave_applications->status_id == 'sta-1001'){
                $notification = Notification::create([
                    'title' => 'Leave Application has been Rejected!',
                    'subject' => 'Your approval is no longer needed for '.$leave_applications->reference_number,
                    'body' => $leave_applications->reference_number,
                    'notification_type_id' => 'nt-1002',
                    'author_id' => auth()->user()->id,
                    'employee_id' => $leave_applications->approvers->users->id,
                ]);
            }
            elseif($leave_applications->status_id == 'sta-1003'){
                if( $leave_applications->second_approver_id != null ){
                    $notification = Notification::create([
                        'title' => 'Leave Application has been Rejected!',
                        'subject' => 'Your approval is no longer needed for '.$leave_applications->reference_number,
                        'body' => $leave_applications->reference_number,
                        'notification_type_id' => 'nt-1002',
                        'author_id' => auth()->user()->id,
                        'employee_id' => $leave_applications->second_approvers->users->id,
                    ]);
                }
            }
            Log::notice('Leave Application '.$leave_applications->reference_number.' is successfully rejected by '.auth()->user()->email);
            return redirect()->back()->with('warning','Leave Application has been rejected!');
        }
        else{
            Log::warning('Leave Application '.$leave_applications->reference_number.' is attempted to reject by '.auth()->user()->email);
            return redirect()->back()->with('error','You are not authorize!');
        }
    }

    /**
     * cancellation of employee leave application goes here.
     *
     *
     * LEAVE APPLICATION CANCELLATION
     */
    public function leave_application_cancellation(Request $request, $leave_application_rn){
        $data = $request->validate([
            'reason' => 'required',
        ]);

        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        $current_leave_credits = EmployeeLeaveCredit::where('employee_id',$leave_applications->employee_id)->where('leave_type_id', $leave_applications->leave_type_id)->where('fiscal_year_id',$leave_applications->fiscal_year_id)->where('status_id','sta-1007')->first();

        // compute the leave credits
        $leave_credited = $current_leave_credits->leave_days_credit + $leave_applications->duration;
        // leave application employee id initialization
        $employee_id = $leave_applications->employee_id;
        //
        $leave_application_duration = $leave_applications->duration;

        // dd($employee_leave_credit);
        if ($leave_applications->status_id == "sta-1002") {
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
        }

        if(auth()->user()->role_id == "rol-0001" || auth()->user()->role_id == "rol-0002"){
            $leave_approvals = LeaveApproval::create([
                'leave_application_reference' => $leave_application_rn,
                'reason_note' => $data['reason'],
                'approver_id' => auth()->user()->id,
                'status_id' => 'sta-1005'
            ]);
            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
                ->update([
                    'status_id' => 'sta-1005'
                ]);

            $data['reason_note'] = 'Leave Credit Return | Leave Application Cancelled | '.$leave_application_rn;

            $employee_leave_credit_logs = LeaveCreditLog::create([
                'employee_leave_credits_id' => $new_employee_leave_credits->id,
                'leave_application_rn' => $leave_application_rn,
                'leave_days_credit' => $leave_application_duration,
                'reason_note' => $data['reason_note'],
                'employee_id' => $employee_id,
                'fiscal_year_id' => $current_leave_credits->fiscal_year_id,
            ]);
            $notification = Notification::create([
                'title' => 'Leave Application Cancelled!',
                'subject' => $leave_applications->reference_number.' has been cancelled by '.auth()->user()->first_name." ".auth()->user()->last_name,
                'body' => $leave_applications->reference_number,
                'notification_type_id' => 'nt-1002',
                'author_id' => auth()->user()->id,
                'employee_id' => $leave_applications->employees->users->id,
            ]);
            Log::notice('Leave Application '.$leave_applications->reference_number.' is successfully cancelled by '.auth()->user()->email);
            return redirect()->back()->with('warning','Leave Application has been cancelled!');
        }
        else{
            Log::warning('Leave Application '.$leave_applications->reference_number.' is attempted to cancel by '.auth()->user()->email);
            return redirect()->back()->with('error','You are not authorize!');
        }
    }

    public function GetLeaveTypeFromEmployee($id){
        $employeeLeaveCredits = EmployeeLeaveCredit::where('employee_id',$id)
                                                    ->where('fiscal_year_id',currentFiscalYear()->id)
                                                    ->where('show_on_employee',true)
                                                    ->where('status_id','sta-1007')
                                                    ->orderBy('id','asc')
                                                    ->with(['leavetypes'])
                                                    ->get();

        echo json_encode($employeeLeaveCredits);
    }
}
