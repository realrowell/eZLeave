<?php

namespace App\View\Components\Admin;

use App\Models\ProfilePhoto;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminAccountCard extends Component
{

    public $user_profile_photo;
    public $user_name;
    public $user_role;
    public $user_role_id;
    public $user_account_status;
    public $user_account_status_id;
    public $user;
    /**
     * Create a new component instance.
     */
    public function __construct($userId)
    {
        $user = User::where('id',$userId)->first();
        $profile_photo = ProfilePhoto::where('user_id',$userId)->first();
        if($profile_photo == null){
            $this->user_profile_photo = asset('/img/dummy_profile.jpg');
        }
        elseif($profile_photo != null){
            $this->user_profile_photo = asset('storage/images/profile_photos/'.$profile_photo->profile_photo);
        }
        else{
            $this->user_profile_photo = asset('/img/dummy_profile.jpg');
        }

        $user_middlename = mb_substr($user->employees?->users?->middle_name, 0, 1);
        if($user_middlename != null){
            $user_middlename = $user_middlename.'.';
        }
        $this->user_name = $user->first_name.' '.$user_middlename.' '.$user->last_name.' '.$user->suffixes?->suffix_title;

        $this->user_role = $user->roles?->role_title;
        $this->user_role_id = $user->role_id;
        $this->user_account_status = $user->statuses?->status_title;
        $this->user_account_status_id = $user->status_id;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-account-card');
    }
}
