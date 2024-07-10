<?php

namespace App\View\Components\employee;

use App\Models\LeaveApplicationNote;
use App\Models\LeaveApproval;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaveAppDetailsModal extends Component
{
    public $leave_reference_number;
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
    public $leave_app_employee;
    public $attachment;
    public $status;
    public $leave_notes;
    public $leave_approvals;
    /**
     * Create a new component instance.
     */
    public function __construct($leaveReferenceNumber, $leaveTypeTitle, $leaveDuration, $leaveStart, $leaveStartPart, $leaveAppEmployee,
                                $leaveEnd, $leaveEndPart, $leaveCreated, $approverName, $secondApproverId, $secondApproverName,
                                $attachment, $status)
    {
        $this->leave_notes = LeaveApplicationNote::all();
        $this->leave_approvals = LeaveApproval::orderBy('created_at', 'desc')->get();
        $this->leave_reference_number = $leaveReferenceNumber;
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
        $this->leave_app_employee = $leaveAppEmployee;
        $this->attachment = $attachment;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee.leave-app-details-modal');
    }
}
