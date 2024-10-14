<?php

namespace App\View\Components\Admin;

use App\Models\SystemSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminAoaAddModal extends Component
{
    public $system_settings;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->system_settings = SystemSetting::latest('id')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-aoa-add-modal');
    }
}
