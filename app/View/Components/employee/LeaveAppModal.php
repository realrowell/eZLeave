<?php

namespace App\View\Components\employee;

use App\Models\EmployeeLeaveCredit;
use App\Models\FiscalYear;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaveAppModal extends Component
{
    public $leave_credits;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $current_year = Carbon::now();
        $current_fiscal_year = FiscalYear::where('fiscal_year_start','<=', $current_year->toDateString())->where('fiscal_year_end','>=',$current_year->toDateString())->first();
        $this->leave_credits = EmployeeLeaveCredit::where('employee_id',auth()->user()->employees->id)->where('fiscal_year_id',$current_fiscal_year->id)->where('show_on_employee',true)->where('status_id','sta-1007')->orderBy('id','asc')->get();
        // $this->leave_credits = $leave_credits;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee.leave-app-modal');
    }
}
