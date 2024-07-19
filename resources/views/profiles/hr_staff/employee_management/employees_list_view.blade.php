@extends('profiles.hr_staff.employee_management.employees')
@section('list_active','bg-selected-warning')
@section('submenu_all','bg-selected-warning text-light')
@section('submenu_regular','text-dark')
@section('submenu_proba','text-dark')
@section('sub-content')

{{-- <div class="row mt-2">
    <div class="col-lg-6 col-md-6 col-sm-12">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="row">
            <form action="{{ route('hrstaff_employees_list_search') }}" onkeyup="searchBtnEnable()">
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
</div> --}}
{{-- LIST PROFILE --}}
<div class="row">
    <div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <table id="data_table" class="table table-bordered table-hover bg-light ">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Sub-department</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        {{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }} {{ optional($user->suffixes)->suffix_title }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ optional(optional($user->employees->employee_positions)->positions)->position_description }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->employees->genders->gender_title }}</td>
                            <td>{{ optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->sub_department_title }}</td>
                            <td>{{ optional(optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}</td>
                            <td class="d-flex gap-2">
                                {{-- <a href="/hr/user/profile/{{ $user->user_name }}" class="btn-sm btn-primary">Profile</a>
                                <a href="#" class="btn-sm btn-primary">Leave-MS</a> --}}
                                <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg dropdown-menu-dark text-light">
                                    <li>
                                        <a href="{{ route('user_profile',['username' => $user->user_name]) }}" class="dropdown-item pb-2">
                                            <i class='bx bxs-user me-2'></i>Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user_profile_leave',['username' => $user->user_name]) }}" class="dropdown-item pb-2">
                                            <i class='bx bx-calendar me-2' ></i>Leave-MS
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mt-5">
                <ul class="pagination justify-content-center align-items-center">
                    {{-- {!! $users->links('pagination::bootstrap-5') !!} --}}
                </ul>
            </div>
        </div>
    </div>
</div>
{{-- END LIST --}}
</div>

@endsection
