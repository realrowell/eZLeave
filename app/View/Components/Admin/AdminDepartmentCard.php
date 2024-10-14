<?php

namespace App\View\Components\Admin;

use App\Models\Department;
use App\Models\Employee;
use App\Models\SubDepartment;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDepartmentCard extends Component
{
    public $department_name;
    public $department;
    public $subdepartment_count;
    public $employees_count;
    /**
     * Create a new component instance.
     */
    public function __construct($departmentId)
    {
        $departments = Department::where('id',$departmentId)->first();
        $this->subdepartment_count = SubDepartment::where('department_id',$departmentId)->count();
        $users = User::where('status_id','sta-2001')->where('role_id','rol-0003')->get();
        foreach($users as $user){
            if($user->employees?->employee_positions?->positions?->subdepartments?->department_id == $departmentId){
                $this->employees_count++;
                }
        }
        $this->department_name = $departments->department_title;
        $this->department = $departments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-department-card');
    }
}
