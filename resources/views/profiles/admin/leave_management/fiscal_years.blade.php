@extends('includes.admin_layout')
@section('title','Leave Types')
@section('profile_bar_display','none')
@section('sidebar_leave_management_active','active')
@section('sidebar_leave_management_active_custom','active_custom')
@section('custom_active_leave_icon','var(--accent-color)')
@section('content')

<div class="container-fluid " id="profile_body">
    <div class="spinner-border text-primary" id="loading_spinner_approve" role="status" style="display: none;">
        <span class="visually-hidden" >Loading...</span>
    </div>
    <div class="row d-flex gap-1 justify-content-center justify-content-sm-center justify-content-lg-start">
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin.leave.types') }}" class=" text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Types</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning text-light" style="min-height: 1rem" >
            <a href="{{ route('admin.fiscal.years') }}" class=" bg-selected-warning text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Fiscal Years</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>

<div class="container-fluid" id="profile_body">
    <div class="row bg-light shadow p-3">
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <h4>Leave Management / Fiscal years</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end">
                    <a href="#AddDept" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#AddTypeModal">
                        <i class='bx bxs-user-plus' ></i>
                        Create Fiscal year
                    </a>
                </div>
            </div>

            <!-- Add Type Modal -->
                <x-admin.admin-fiscal-year-add-modal>
                </x-admin.admin-fiscal-year-add-modal>
            {{-- End Add Type Modal --}}

            <div class="row">
                <div class="table-wrapper text-wrap">
                    <table class="table table-bordered table-hover bg-light">
                        <thead class="bg-success text-light">
                            <tr>
                                <th>Fiscal Year</th>
                                <th>Description</th>
                                <th>FY Start</th>
                                <th>FY End</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fiscalyears as $fiscalyear)
                            <tr>
                                <td>{{ $fiscalyear->fiscal_year_title }}</td>
                                <td>{{ $fiscalyear->fiscal_year_description }}</td>
                                <td>{{ $fiscalyear->fiscal_year_start }}</td>
                                <td>{{ $fiscalyear->fiscal_year_end }}</td>
                                <td>
                                    @if ($fiscalyear->status_id == 'sta-1007')
                                        <p class="card-desc badge rounded-pill bg-success">{{ optional($fiscalyear->statuses)->status_title }}</p>
                                    @elseif ($fiscalyear->status_id == 'sta-1008')
                                        <p class="card-desc badge bg-warning rounded-pill text-dark">{{ optional($fiscalyear->statuses)->status_title }}</p>
                                    @endif
                                </td>
                                <td class="m-2">
                                    <a href="#" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#UpdatetypeModal{{ $fiscalyear->id }}">Update</a>
                                    {{-- <a href="#" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal{{ $fiscalyear->id }}"><b>Delete</b></a> --}}
                                </td>
                            </tr>
                            <!-- Update Leave Type Modal -->
                                <x-admin.admin-fiscal-year-update-modal
                                :fiscalyearId="$fiscalyear->id">
                                </x-admin.admin-fiscal-year-update-modal>
                            {{-- End update leave Type Modal --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
