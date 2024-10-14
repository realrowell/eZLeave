<?php

namespace App\View\Components\Admin;

use App\Models\Department;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSubdepartmentAddModal extends Component
{
    public $departments;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->departments = Department::all()->where('status_id','sta-1007');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-subdepartment-add-modal');
    }
}
