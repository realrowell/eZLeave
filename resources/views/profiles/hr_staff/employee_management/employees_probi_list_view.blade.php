@extends('profiles.hr_staff.employee_management.employees_probi')
@section('list_active','bg-selected-warning')
@section('submenu_all','text-dark')
@section('submenu_regular','text-dark')
@section('submenu_proba','bg-selected-warning text-light')
@section('sub-content')

{{-- LIST PROFILE --}}
<div class="row">
    <div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <table id="data_table" class="table table_sm table-bordered table-hover bg-light ">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>LOS</th>
                            <th>Position</th>
                            <th>Sub-department</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Birthdate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            {{ $user->last_name }}, {{ $user->first_name }}
                                            @if ($user->middle_name != null)
                                            {{ mb_substr($user->middle_name, 0, 1).'.' }}
                                            @endif
                                            {{ optional($user->suffixes)->suffix_title }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->employees->genders->gender_title }}</td>
                                <td>
                                    @if (lengthOfService($user->employees->date_hired) <= 0.6)
                                        <h6 class="mb-0 mt-3 text-primary">LOS: {{ lengthOfService($user->employees->date_hired) }} y</h6>
                                    @else
                                        @if ($user->employees->employment_status == 'ems-0002')
                                            <h6 class="mb-0 mt-3 text-danger">LOS: {{ lengthOfService($user->employees->date_hired) }} y/s</h6>
                                        @else
                                            <h6 class="mb-0 mt-3 text-">LOS: {{ lengthOfService($user->employees->date_hired) }} y/s</h6>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ optional(optional($user->employees->employee_positions)->positions)->position_description }}</td>
                                <td>{{ optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->sub_department_title }}</td>
                                <td>{{ optional(optional(optional(optional($user->employees->employee_positions)->positions)->subdepartments)->departments)->department_title }}</td>
                                <td>{{ $user->employees?->employment_statuses?->employment_status_title }}</td>
                                <td>{{ $user->employees->birthdate }}</td>
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
{{-- END LIST --}}

@endsection
