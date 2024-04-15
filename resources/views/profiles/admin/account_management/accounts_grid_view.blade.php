@extends('profiles.admin.account_management.accounts')
@section('grid_active','bg-selected-warning')
@section('sub-content')

<div class="row mt-2">
    <div class="col-lg-6 col-md-6 col-sm-12">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="row">
            <form action="{{ route('admin_accounts_search_grid') }}" onkeyup="searchBtnEnable()">
            @csrf
                <div class="input-group shadow-sm">
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
<div class="container-fluid">
    <div class="row justify-content-sm-center justify-content-md-center justify-content-lg-center ">
        @foreach ($users as $user)
        <div class="col-lg-4 col-md-6 col-sm-10 align-self-stretch p-1  ">
            <div class="shadow card">
                <div class="card-body row p-3">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                        @if ($user->profile_photos == null)
                            <img class="profile-photo-sm" src="/img/dummy_profile.jpg" alt="profile photo">
                        @else
                            <img class="profile-photo-sm" src="{{ asset('storage/images/profile_photos/'.$user->profile_photos->profile_photo) }}" alt="profile photo">
                        @endif
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-7">
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
                            @else
                                <p class="card-desc">{{ optional(optional(optional($user->employees)->employee_positions)->positions)->position_description }}</p>
                                <p class="card-desc">{{ optional(optional(optional($user->employees)->employee_positions)->subdepartments)->sub_department_title }}</p>
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
                                    <a href="{{ route('admin_visit_account_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center">Profile</a>
                                @else
                                    <a href="{{ route('admin_visit_employee_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center">Profile</a>
                                    <a href="{{ route('visit_employee_leave_ms_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center">Leave-MS</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                        <div class="dropdown">
                            <a class="text-secondary fs-5" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        @endforeach

        {{-- END CARDS --}}

    </div>
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
