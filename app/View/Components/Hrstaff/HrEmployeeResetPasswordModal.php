<?php

namespace App\View\Components\Hrstaff;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HrEmployeeResetPasswordModal extends Component
{
    public $username;
    /**
     * Create a new component instance.
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.hr-employee-reset-password-modal');
    }
}
