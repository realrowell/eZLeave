<?php

namespace App\View\Components\Admin;

use App\Models\Position;
use App\Models\PositionLevel;
use App\Models\PositionTitles;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminPositionCard extends Component
{
    public $position;
    public $position_level;
    /**
     * Create a new component instance.
     */
    public function __construct($positionId)
    {
        $position = Position::where('id',$positionId)->first();
        $this->position = $position;
        $this->position_level = $position->position_levels->level_title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-position-card');
    }
}
