<?php

namespace App\View\Components\Admin;

use App\Models\AreaOfAssignment;
use App\Models\SystemSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminAoaUpdateModal extends Component
{
    public $area_of_assignment;
    public $system_settings;
    /**
     * Create a new component instance.
     */
    public function __construct($areaofassignmentId)
    {
        $this->area_of_assignment = AreaOfAssignment::where('id',$areaofassignmentId)->first();
        $this->system_settings = SystemSetting::latest('id')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-aoa-update-modal');
    }
}
