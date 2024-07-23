<?php

namespace App\View\Components\hrstaff;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HrLeaveAppRejectModal extends Component
{
    public $reference_number;
    /**
     * Create a new component instance.
     */
    public function __construct($leaveReferenceNumber)
    {
        $this->reference_number = $leaveReferenceNumber;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.hr-leave-app-reject-modal');
    }
}
