<?php

namespace App\View\Components\Admin;

use App\Models\SubDepartment;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSubdepartmentCard extends Component
{
    public $subdepartment;
    public $employees_count;
    /**
     * Create a new component instance.
     */
    public function __construct($subdepartmentId)
    {
        $subdepartment = SubDepartment::where('id',$subdepartmentId)->first();
        $this->subdepartment = $subdepartment;
        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->get();
        foreach($users as $user){
            if($user->employees?->employee_positions?->positions?->subdepartment_id == $subdepartmentId){
                $this->employees_count++;
                }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-subdepartment-card');
    }
}
