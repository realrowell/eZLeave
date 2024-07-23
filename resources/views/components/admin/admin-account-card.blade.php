<div class="card shadow shadow-sm rounded-0 border border-end-0 border-top-0 border-bottom-0 border-warning border-5">
    <div class="card-body row p-3">
        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <img class="profile-photo-sm" src="{{ $user_profile_photo }}" alt="profile photo">
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-7">
            <div class="row">
                <h5><strong>{{ $user_name }}</strong></h5>
            </div>
            <div class="row">
                <p class="card-desc">{{ $user->email }}</p>
                <p class="card-desc">{{ $user_role }}</p>
                <div class="col">
                    @if ($user_account_status_id == 'sta-2001')
                        <p class="card-desc badge bg-success rounded-pill">{{ $user_account_status }}</p>
                    @elseif ($user_account_status_id == 'sta-2002')
                        <p class="card-desc badge bg-warning rounded-pill text-dark">{{ $user_account_status }}</p>
                    @elseif ($user_account_status_id == 'sta-2003')
                        <p class="card-desc badge bg-warning rounded-pill text-dark">{{ $user_account_status }}</p>
                    @elseif ($user_account_status_id == 'sta-2004')
                        <p class="card-desc badge bg-danger">{{ $user_account_status }}</p>
                    @elseif ($user_account_status_id == 'sta-2002')
                        <p class="card-desc badge bg-warning rounded-pill text-dark">{{ $user_account_status }}</p>
                    @endif
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    @if ($user_role_id != 'rol-0003')
                        <a href="{{ route('admin_visit_account_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center rounded-0">Profile</a>
                    @else
                        <a href="{{ route('admin_visit_employee_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center rounded-0">Profile</a>
                        <a href="{{ route('admin_update_employee_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center rounded-0">Update</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
