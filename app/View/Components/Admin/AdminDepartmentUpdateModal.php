<?php

namespace App\View\Components\Admin;

use App\Models\Department;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDepartmentUpdateModal extends Component
{
    public $department;
    /**
     * Create a new component instance.
     */
    public function __construct($departmentId)
    {
        $departments = Department::where('id',$departmentId)->first();
        $this->department = $departments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-department-update-modal');
    }
}
