<div class="card p-2 w-100 shadow shadow-sm rounded-0 border border-end-0 border-top-0 border-bottom-0 border-warning border-5 ">
    <div class="card-body row">
        <div class="col-lg-4 col-md-4 col-4 ">
            <div class="row">
                <div class="col">
                    <img class="profile-photo-sm" src="{{ $employee_profile_photo }}" alt="profile photo">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    @if (lengthOfService($employee_date_hired) <= 0.6)
                        <h6 class="mb-0 mt-3 text-primary">LOS: {{ lengthOfService($employee_date_hired) }} y</h6>
                    @else
                        @if ($employee_employment_status_id == 'ems-0002')
                            <h6 class="mb-0 mt-3 text-danger">LOS: {{ lengthOfService($employee_date_hired) }} y/s</h6>
                        @else
                            <h6 class="mb-0 mt-3 text-">LOS: {{ lengthOfService($employee_date_hired) }} y/s</h6>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-8">
            <div class="row">
                <div class="col">
                    <h5><strong>{{ $employee_fullname }}</strong></h5>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="card-desc">{{ $employee_position }}</p>
                    <p class="card-desc">{{ $employee_subdepartment }}</p>
                    <p class="card-desc">{{ $employee_department }}</p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <a href="/hr/user/profile/{{ $employee_username }}" class="btn-sm btn-primary text-center rounded-0">Profile</a>
                    <a href="{{ route('user_profile_leave',$username = $employee_username) }}" class="btn-sm btn-primary text-center rounded-0">Leave-MS</a>
                </div>
            </div>
        </div>
    </div>
</div>
