<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeaveCredit;
use App\Models\EmployeePosition;
use App\Models\LeaveApplication;
use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use Illuminate\Http\Request;

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
            'attachment' => 'nullable'
        ]);

        $data['employee'] = strip_tags($data['employee']);
        $data['leavetype'] = strip_tags($data['leavetype']);
        $data['startdate'] = strip_tags($data['startdate']);
        $data['enddate'] = strip_tags($data['enddate']);
        $data['reason'] = strip_tags($data['reason']);

        $employee_leave_credits = EmployeeLeaveCredit::all()->where('employee_id',$data['employee'])->value('id');
        $approver_position = Employee::where('id',$data['employee'])->value('employee_position_id');
        $approver = EmployeePosition::all()->where('id',$approver_position)->value('reports_to_id');

        if($request->hasFile('attachment')){
            $fileNameExt = $request->file('attachment')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = 'leave.attachment.'.$fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('attachment')->storeAs('public/images',$fileNameToStore);

            $leaveapplication = LeaveApplication::create([
                'leave_type_id' => $data['leavetype'],
                'start_date' => $data['startdate'],
                'end_date' => $data['enddate'],
                'attachment' => $fileNameToStore,
                'employee_id' => $data['employee'],
                'approver_id' => $approver,
                'employee_leave_credit_id' => $employee_leave_credits,
                'status_id' => 'sta-1001'
            ]);
            $leave_approval = LeaveApproval::create([
                'leave_application_reference' => $leaveapplication->reference_number,
                'approver_id' => auth()->user()->employees->employee_positions->reports_tos->id,
                'status_id' => 'sta-1001'
            ]);

            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'reason_note' => $data['reason'],
                    'employee_id' => auth()->user()->employees->id
                ]);
            }
        }
        else{
            $leaveapplication = LeaveApplication::create([
                'leave_type_id' => $data['leavetype'],
                'start_date' => $data['startdate'],
                'end_date' => $data['enddate'],
                'employee_id' => $data['employee'],
                'approver_id' => $approver,
                'employee_leave_credit_id' => $employee_leave_credits,
                'status_id' => 'sta-1001'
            ]);
            $leave_approval = LeaveApproval::create([
                'leave_application_reference' => $leaveapplication->reference_number,
                'approver_id' => auth()->user()->employees->employee_positions->reports_tos->id,
                'status_id' => 'sta-1001'
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leaveapplication->reference_number,
                    'reason_note' => $data['reason'],
                    'employee_id' => auth()->user()->employees->id
                ]);
            }
        }
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
            'startdate' => 'required',
            'enddate' => 'required',
            'reason' => 'max:255',
            'attachment' => 'nullable'
        ]);
        $data['startdate'] = strip_tags($data['startdate']);
        $data['enddate'] = strip_tags($data['enddate']);
        $data['reason'] = strip_tags($data['reason']);

        if($request->hasFile('attachment')){
            $fileNameExt = $request->file('attachment')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = 'leave.attachment.'.$fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('attachment')->storeAs('public/images',$fileNameToStore);
            
            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
            ->update([
                'start_date' => $data['startdate'],
                'end_date' => $data['enddate'],
                'attachment' => $fileNameToStore,
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leave_application_rn,
                    'reason_note' => $data['reason'],
                    'employee_id' => auth()->user()->employees->id
                ]);
            }
        }
        else{
            $leave_application = LeaveApplication::where('reference_number', $leave_application_rn)
            ->update([
                'start_date' => $data['startdate'],
                'end_date' => $data['enddate'],
            ]);
            if($request->input('reason')){
                $leave_application_note = LeaveApplicationNote::create([
                    'leave_application_reference' => $leave_application_rn,
                    'reason_note' => $data['reason'],
                    'employee_id' => auth()->user()->employees->id
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
    public function leave_application_approval($leave_application_rn){
        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        if(auth()->user()->role_id == "rol-0003"){
            if(auth()->user()->employees->id == $leave_applications->employees->id || auth()->user()->employees->id == $leave_applications->employees->employee_positions->reports_tos->id){
                // dd($leave_applications->employees->id);
                $leave_approvals = LeaveApproval::create([
                    'leave_application_reference' => $leave_application_rn,
                    'approver_id' => auth()->user()->employees->id,
                    'status_id' => 'sta-1002'
                ]);
                $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                    ->update([
                        'status_id' => 'sta-1002'
                    ]);
                return redirect()->back()->with('success','Leave Application has been approved!');
            }
            else{
                return redirect()->back()->with('error','You are not authorize!');
            }
        }
        elseif(auth()->user()->role_id == "rol-0001" || auth()->user()->role_id == "rol-0002"){
            $leave_approvals = LeaveApproval::create([
                'leave_application_reference' => $leave_application_rn,
                'approver_id' => auth()->user()->employees->id,
                'status_id' => 'sta-1002'
            ]);
            $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                ->update([
                    'status_id' => 'sta-1002'
                ]);
            return redirect()->back()->with('success','Leave Application has been approved!');
        }
        else{
            return redirect()->back()->with('error','You are not authorize!');
        }
    }

    /**
     * rejection of employee leave application goes here.
     *
     * 
     * LEAVE APPLICATION REJECTION
     */
    public function leave_application_rejection($leave_application_rn){
        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        if(auth()->user()->role_id == "rol-0003"){
            if(auth()->user()->employees->id == $leave_applications->employees->id || auth()->user()->employees->id == $leave_applications->employees->employee_positions->reports_tos->id){
                $leave_approvals = LeaveApproval::create([
                    'leave_application_reference' => $leave_application_rn,
                    'approver_id' => auth()->user()->employees->id,
                    'status_id' => 'sta-1004'
                ]);
                $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                    ->update([
                        'status_id' => 'sta-1004'
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
                'approver_id' => auth()->user()->employees->id,
                'status_id' => 'sta-1004'
            ]);
            $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)
                ->update([
                    'status_id' => 'sta-1004'
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
    public function leave_application_cancellation($leave_application_rn){
        $leave_applications = LeaveApplication::where('reference_number', $leave_application_rn)->first();
        if(auth()->user()->role_id == "rol-0003"){
            if(auth()->user()->employees->id == $leave_applications->employees->id || auth()->user()->employees->id == $leave_applications->employees->employee_positions->reports_tos->id){
                $leave_approvals = LeaveApproval::create([
                    'leave_application_reference' => $leave_application_rn,
                    'approver_id' => auth()->user()->employees->id,
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
                'approver_id' => auth()->user()->employees->id,
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
