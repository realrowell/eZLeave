@extends('profiles.hr_staff.employee_management.employees_regular')
@section('list_active','bg-selected-warning')
@section('sub-content')

<div class="row mt-2">
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
</div>
{{-- LIST PROFILE --}}
<div class="row">
    <div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <table class="table table-striped table-hover bg-light">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Sub-department</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->users->last_name }}, {{ $user->users->first_name }} {{ $user->users->middle_name }} {{ optional($user->users->suffixes)->suffix_title }}</td>
                            <td>{{ optional($user->employee_positions->positions)->position_title }}</td>
                            <td>{{ optional($user->employee_positions->subdepartments)->sub_department_title }}</td>
                            <td>{{ optional(optional($user->employee_positions->subdepartments)->departments)->department_title }}</td>
                            <td class="d-flex gap-2">
                                <a href="/hr/user/profile/{{ $user->users->user_name }}" class="btn-sm btn-primary">Profile</a>
                                <a href="#" class="btn-sm btn-primary">Leave-MS</a>
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
                    {!! $users->links('pagination::bootstrap-5') !!}
                </ul>
            </div>
        </div>
    </div>
</div>
{{-- END LIST --}}
</div>

@endsection