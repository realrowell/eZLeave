@extends('profiles.admin.account_management.accounts')
@section('grid_active','bg-selected-warning')
@section('sub-content')

<div class="row mt-2">
    <div class="col-lg-6 col-md-6 col-sm-12">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="row">
            <form action="{{ route('hrstaff_employees_grid_search') }}" onkeyup="searchBtnEnable()">
            @csrf
                <div class="input-group">
                    <input type="search" class="form-control rounded" name="search_input" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-primary disabled" id="search_btn">search</button>
                </div>
            </form>
        </div>
        <div class="row">
            <p>*Search employee by first name or by last name here</p>
        </div>
    </div>
</div>
{{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($users as $user)
        <div class="col-lg-4 col-md-6 col-sm-10">
            <div class="card w-100 p-2 shadow">
                <div class="card-body row">
                    <div class="col-lg-4 col-md-4 col-4 ">
                        <img class="profile-photo-sm" src="/img/dummy_profile.jpg" alt="">
                    </div>
                    <div class="col-lg-8 col-md-8 col-8">
                        <div class="row">
                            <h5><strong>{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }} {{ optional($user->suffixes)->suffix_title }}</strong></h5>
                        </div>
                        <div class="row">
                            @if ($user->role_id != 'rol-0003')
                                <p class="card-desc">{{ optional($user->roles)->role_title }}</p>
                                <div class="col">
                                    @if ($user->status_id == 'sta-2001')
                                        <p class="card-desc badge bg-success">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2002')
                                        <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2003')
                                        <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2004')
                                        <p class="card-desc badge bg-danger">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2002')
                                        <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                                    @endif
                                </div>
                                <p class="card-desc">...</p>
                            @else
                                <p class="card-desc">{{ optional($user->employees->employee_positions->positions)->position_description }}</p>
                                <p class="card-desc">{{ optional($user->employees->employee_positions->positions->subdepartments)->sub_department_title }}</p>
                                <div class="col">
                                    @if ($user->status_id == 'sta-2001')
                                        <p class="card-desc badge bg-success">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2002')
                                        <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2003')
                                        <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2004')
                                        <p class="card-desc badge bg-danger">{{ optional($user->statuses)->status_title }}</p>
                                    @elseif ($user->status_id == 'sta-2002')
                                        <p class="card-desc badge bg-warning text-dark">{{ optional($user->statuses)->status_title }}</p>
                                    @endif
                                </div>
                                {{-- <p class="card-desc">{{ optional($user->employees->employee_positions->subdepartments->departments)->department_title }}</p> --}}
                            @endif
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                @if ($user->role_id != 'rol-0003')
                                    <a href="#" class="btn-sm btn-primary text-center">Profile</a>
                                @else
                                    <a href="{{ route('admin_visit_employee_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center">Profile</a>
                                    <a href="#" class="btn-sm btn-primary text-center">Leave-MS</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- END CARDS --}}

</div>
<div class="row">
    <div class="col">
        <div class="mt-5">
            <ul class="pagination justify-content-center align-items-center">
                {!! $users->links('pagination::bootstrap-5') !!}
            </ul>
        </div>
    </div>
</div>


@endsection
