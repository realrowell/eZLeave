<?php

namespace App\View\Components\Hrstaff;

use App\Models\Department;
use App\Models\EmploymentStatus;
use App\Models\FiscalYear;
use App\Models\LeaveType;
use App\Models\SubDepartment;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaveAppExportFilterModal extends Component
{
    public $current_fiscal_year;
    public $fiscal_years;
    public $employment_statuses;
    public $leavetypes;
    public $departments;
    public $subdepartments;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $current_date = Carbon::now();
        $fiscal_years = FiscalYear::all()->where('status_id','sta-1007');
        $this->fiscal_years = FiscalYear::all()->where('status_id','sta-1007');
        $this->current_fiscal_year = $fiscal_years->where('fiscal_year_start','<=', $current_date->toDateString())->where('fiscal_year_end','>=',$current_date->toDateString())->first();
        $this->employment_statuses = EmploymentStatus::all();
        $this->leavetypes = LeaveType::where('status_id','sta-1007')->get();
        $this->departments = Department::where('status_id','sta-1007')->get();
        $this->subdepartments = SubDepartment::where('status_id','sta-1007')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.leave-app-export-filter-modal');
    }
}
