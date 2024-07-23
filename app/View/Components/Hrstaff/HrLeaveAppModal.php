<?php

namespace App\View\Components\hrstaff;

use App\Models\LeaveType;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HrLeaveAppModal extends Component
{
    public $users;
    public $leavetypes;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->users = User::where('role_id','rol-0003')
                        ->where('status_id','sta-2001')
                        ->orderBy('last_name', 'asc')
                        ->with(['employees'])
                        ->get();
        $this->leavetypes = LeaveType::all()->where('status_id','sta-1007');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.hr-leave-app-modal');
    }
}
