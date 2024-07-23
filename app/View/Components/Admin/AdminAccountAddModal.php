<?php

namespace App\View\Components\Admin;

use App\Models\Role;
use App\Models\Suffix;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminAccountAddModal extends Component
{
    public $suffixes;
    public $roles;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->suffixes = Suffix::all();
        $this->roles = Role::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-account-add-modal');
    }
}
