<?php

namespace App\View\Components\employee;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaveAppApproveModal extends Component
{
    public $leave_reference_number;
    /**
     * Create a new component instance.
     */
    public function __construct($leaveReferenceNumber)
    {
        $this->leave_reference_number = $leaveReferenceNumber;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee.leave-app-approve-modal');
    }
}
