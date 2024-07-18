<?php

namespace App\View\Components\hrstaff;

use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HrLeaveAppUpdateModal extends Component
{
    public $reference_number;
    public $employee_name;
    public $leave_type_title;
    public $leave_duration;
    public $leave_start;
    public $leave_start_part;
    public $leave_end;
    public $leave_end_part;
    public $leave_created;
    public $leave_approver_name;
    public $second_approver_id;
    public $second_approver_name;
    public $attachment;
    public $leave_status;
    public $leave_notes;
    public $leave_approvals;
    public $employee_username;
    /**
     * Create a new component instance.
     */
    public function __construct($leaveReferenceNumber, $employeeFullName, $leaveTypeTitle, $leaveDuration, $leaveStart, $leaveStartPart,
                                $leaveEnd, $leaveEndPart,$leaveCreated, $approverName, $secondApproverId, $secondApproverName,
                                $attachment, $status, $employeeUsername)
    {
        $this->leave_notes = LeaveApplicationNote::where("leave_application_reference",$leaveReferenceNumber)->with(['users'])->get();
        $this->leave_approvals = LeaveApproval::where("leave_application_reference",$leaveReferenceNumber)->orderBy('created_at', 'desc')->with(['statuses','approvers'])->get();
        $this->reference_number = $leaveReferenceNumber;
        $this->employee_name = $employeeFullName;
        $this->leave_type_title = $leaveTypeTitle;
        $this->leave_duration = $leaveDuration;
        $this->leave_start = $leaveStart;
        $this->leave_start_part = $leaveStartPart;
        $this->leave_end = $leaveEnd;
        $this->leave_end_part = $leaveEndPart;
        $this->leave_created = $leaveCreated;
        $this->leave_approver_name = $approverName;
        $this->second_approver_id = $secondApproverId;
        $this->second_approver_name = $secondApproverName;
        $this->attachment = $attachment;
        $this->leave_status = $status;
        $this->employee_username = $employeeUsername;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.hr-leave-app-update-modal');
    }
}
