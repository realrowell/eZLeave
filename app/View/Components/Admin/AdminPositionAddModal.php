<?php

namespace App\View\Components\Admin;

use App\Models\PositionLevel;
use App\Models\PositionTitles;
use App\Models\SubDepartment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminPositionAddModal extends Component
{
    public $position_titles;
    public $subdepartments;
    public $position_levels;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->position_titles = PositionTitles::where('status_id','sta-1007')->orderBy('position_title','asc')->get();
        $this->subdepartments = SubDepartment::where('status_id','sta-1007')->orderBy('sub_department_title','asc')->get();
        $this->position_levels = PositionLevel::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-position-add-modal');
    }
}
