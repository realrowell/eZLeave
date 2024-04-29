@extends('profiles.admin.account_management.accounts')
@section('list_active','bg-selected-warning')
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
                            <th class="col-2">Full Name</th>
                            <th class="col-1">Username</th>
                            <th class="col-2">Email</th>
                            <th class="col-1">Role</th>
                            <th class="col-2">Position</th>
                            <th class="col-2">Department</th>
                            <th class="col-1">Status</th>
                            <th >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }} {{ optional($user->suffixes)->suffix_title }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->role_title }}</td>
                            <td>{{ $user->employees?->employee_positions?->positions?->position_description ?? 'N/A' }}</td>
                            <td>{{ $user->employees?->employee_positions?->positions?->subdepartments?->departments?->department_title ?? 'N/A' }}</td>
                            <td>
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
                            </td>
                            <td class="d-flex gap-2">
                                <button class="btn btn-primary btn-sm rounded-3 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg dropdown-menu-dark text-light">
                                    @if ($user->role_id != 'rol-0003')
                                        {{-- <a href="{{ route('admin_visit_account_view',['username'=>$user->user_name]) }}" class="btn-sm btn-primary text-center">Profile</a> --}}
                                        <li>
                                            <a href="{{ route('admin_visit_account_view',['username'=>$user->user_name]) }}" class="dropdown-item pb-2">
                                                <i class='bx bxs-user me-2'></i>Profile
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('admin_visit_employee_view',['username'=>$user->user_name]) }}" class="dropdown-item pb-2">
                                                <i class='bx bxs-user me-2'></i>Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('visit_employee_leave_ms_view',['username'=>$user->user_name]) }}" class="dropdown-item pb-2">
                                                <i class='bx bx-calendar me-2' ></i>Leave-MS
                                            </a>
                                        </li>
                                    @endif
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
