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

class ExportFilterModal extends Component
{
    public $url_fy;
    public $leavetypes;
    public $departments;
    public $subdepartments;
    public $fiscal_years;
    public $current_fiscal_year;
    public $employment_statuses;
    /**
     * Create a new component instance.
     */
    public function __construct($urlFY)
    {
        $this->url_fy = $urlFY;
        $this->leavetypes = LeaveType::where('status_id','sta-1007')->get();
        $this->departments = Department::where('status_id','sta-1007')->get();
        $this->subdepartments = SubDepartment::where('status_id','sta-1007')->get();
        $current_year = Carbon::now();
        $this->current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $this->fiscal_years = FiscalYear::all()->where('status_id','sta-1007');
        $this->employment_statuses = EmploymentStatus::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.export-filter-modal');
    }
}
