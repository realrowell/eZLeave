<?php

namespace App\View\Components\Admin;

use App\Models\LeaveType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLeaveTypeUpdateModal extends Component
{
    public $leavetype;
    /**
     * Create a new component instance.
     */
    public function __construct($leavetypeId)
    {
        $this->leavetype = LeaveType::where('id',$leavetypeId)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-leave-type-update-modal');
    }
}
