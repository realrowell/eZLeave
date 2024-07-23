<?php

namespace App\View\Components\employee;

use App\Models\LeaveApplication;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaveAppCard extends Component
{
    public $leave_reference_number;
    public $leave_type_title;
    public $leave_duration;
    public $leave_start;
    public $leave_end;
    public $leave_created;
    public $leave_approver_name;
    public $second_approver_id;
    public $second_approver_name;
    public $leave_app_employee;
    public $status;
    public $status_title;
    public $leave_employee_name;
    /**
     * Create a new component instance.
     */
    public function __construct($leaveReferenceNumber, $leaveTypeTitle, $leaveDuration, $leaveStart, $leaveAppEmployee,
                                $leaveEnd, $leaveCreated, $approverName, $secondApproverId, $secondApproverName,
                                $status, $statusTitle)
    {
        $leaveApplication = LeaveApplication::where('reference_number',$leaveReferenceNumber)->first();
        $this->leave_reference_number = $leaveReferenceNumber;
        $this->leave_type_title = $leaveTypeTitle;
        $this->leave_duration = $leaveDuration;
        $this->leave_start = $leaveStart;
        $this->leave_end = $leaveEnd;
        $this->leave_created = $leaveCreated;
        $this->leave_approver_name = $approverName;
        $this->second_approver_id = $secondApproverId;
        $this->second_approver_name = $secondApproverName;
        $this->leave_app_employee = $leaveAppEmployee;
        $this->status = $status;
        $this->status_title = $statusTitle;

        $user_middlename = mb_substr($leaveApplication->employees?->users?->middle_name, 0, 1);
        if($user_middlename != null){
            $user_middlename = $user_middlename.'.';
        }
        $this->leave_employee_name = $leaveApplication->employees?->users?->first_name.' '.$user_middlename.' '.$leaveApplication->employees?->users?->last_name.' '.$leaveApplication->employees?->users?->suffixes?->suffix_title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee.leave-app-card');
    }
}
