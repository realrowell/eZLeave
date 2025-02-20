<?php

namespace App\View\Components\Admin;

use App\Models\FiscalYear;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDeleteFiscalYearModal extends Component
{
    public $fiscalyear;
    /**
     * Create a new component instance.
     */
    public function __construct($fiscalyearId)
    {
        $this->fiscalyear = FiscalYear::where('id',$fiscalyearId)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-delete-fiscal-year-modal');
    }
}
