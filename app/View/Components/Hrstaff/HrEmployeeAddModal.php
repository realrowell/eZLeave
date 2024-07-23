<?php

namespace App\View\Components\Hrstaff;

use App\Models\AreaOfAssignment;
use App\Models\Department;
use App\Models\EmploymentStatus;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Position;
use App\Models\Role;
use App\Models\SubDepartment;
use App\Models\Suffix;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HrEmployeeAddModal extends Component
{
    public $suffixes;
    public $genders;
    public $roles;
    public $marital_statuses;
    public $positions;
    public $employment_statuses;
    public $departments;
    public $subdepartments;
    public $area_of_assignments;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->suffixes = Suffix::all()->where('status_id','sta-1007');
        $this->genders = Gender::all();
        $this->roles = Role::all();
        $this->marital_statuses = MaritalStatus::all();
        $this->positions = Position::where('status_id','sta-1007')->orderBy('position_description','asc')->get();
        $this->employment_statuses = EmploymentStatus::all();
        $this->departments = Department::all()->where('status_id','sta-1007');
        $this->subdepartments = SubDepartment::all()->where('status_id','sta-1007');
        $this->area_of_assignments = AreaOfAssignment::all()->where('status_id','sta-1007');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.hr-employee-add-modal');
    }
}
