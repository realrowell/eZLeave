<?php

namespace App\View\Components\Hrstaff;

use App\Models\ProfilePhoto;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HrEmployeeCard extends Component
{
    public $employee_profile_photo;
    public $employee_fullname;
    public $employee_position;
    public $employee_subdepartment;
    public $employee_department;
    public $employee_username;
    public $employee_date_hired;
    public $employee_employment_status_id;

    /**
     * Create a new component instance.
     */
    public function __construct($userId)
    {
        $profile_photo = ProfilePhoto::where('user_id',$userId)->first();
        if($profile_photo == null){
            $this->employee_profile_photo = asset('/img/dummy_profile.jpg');
        }
        elseif($profile_photo != null){
            $this->employee_profile_photo = asset('storage/images/profile_photos/'.$profile_photo->profile_photo);
        }
        else{
            $this->employee_profile_photo = asset('/img/dummy_profile.jpg');
        }

        $user = User::where('id',$userId)->first();
        $user_middlename = mb_substr($user->middle_name, 0, 1);
        $this->employee_fullname = $user->last_name.', '.$user->first_name.' '.$user_middlename.'. '.$user->suffixes?->suffix_title;
        $this->employee_position = $user->employees?->employee_positions?->positions?->position_description;
        $this->employee_subdepartment = $user->employees?->employee_positions?->positions?->subdepartments?->sub_department_title;
        $this->employee_department = $user->employees?->employee_positions?->positions?->subdepartments?->departments?->department_title;
        $this->employee_username = $user->user_name;
        $this->employee_date_hired = $user->employees?->date_hired;
        $this->employee_employment_status_id = $user->employees?->employment_status_id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hrstaff.hr-employee-card');
    }
}
