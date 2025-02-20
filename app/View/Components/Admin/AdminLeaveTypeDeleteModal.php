<?php

namespace App\View\Components\Admin;

use App\Models\LeaveType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLeaveTypeDeleteModal extends Component
{
    public $leavetype;
    /**
     * Create a new component instance.
     */
    public function __construct($leavetypeID)
    {
        $this->leavetype = LeaveType::where('id', $leavetypeID)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-leave-type-delete-modal');
    }
}
