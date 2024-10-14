<?php

namespace App\View\Components\Admin;

use App\Models\AreaOfAssignment;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminAoaCard extends Component
{
    public $area_of_assignment;
    public $employees_count;
    /**
     * Create a new component instance.
     */
    public function __construct($areaofassignmentId)
    {
        $this->area_of_assignment = AreaOfAssignment::where('id',$areaofassignmentId)->first();
        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->get();
        foreach($users as $user){
            if($user->employees?->employee_positions?->area_of_assignment_id == $areaofassignmentId){
                $this->employees_count++;
                }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-aoa-card');
    }
}
