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
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch bg-selected-warning text-light" style="min-height: 1rem" >
            <a href="{{ route('admin.leave.types') }}" class="bg-selected-warning text-light">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Leave Types</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch  " style="min-height: 1rem" >
            <a href="{{ route('admin.fiscal.years') }}" class=" text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Fiscal Years</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-5 col-5 card-menu shadow-sm align-self-stretch" style="min-height: 1rem" >
            <a href="{{ route('admin.holidays') }}" class=" text-dark">
                <div class="col text-light-hover">
                    <div class="card-body">
                        <h6>Holidays</h6>
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
                    <h4>Leave Management / Leave Types</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-end">
                    <a href="#AddDept" class="ms-1 me-1 custom-primary-button rounded-0 p-2 ps-3 pe-3"  data-bs-toggle="modal" data-bs-target="#AddTypeModal">
                        <i class='bx bx-plus-medical'></i>
                        Create Leave Type
                    </a>
                </div>
            </div>

            <!-- Add Type Modal -->
                <x-admin.admin-leave-type-add-modal>
                </x-admin.admin-leave-type-add-modal>
            {{-- End Add Type Modal --}}

            <div class="row">
                <div class="table-wrapper text-wrap">
                    <table id="data_table" class="table table-bordered table-hover bg-light">
                        <thead class="bg-success text-light">
                            <tr>
                                <th>Leave Title</th>
                                <th>Description</th>
                                <th>Days per year</th>
                                <th>Max days</th>
                                <th>Cut off date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leavetypes as $leavetype)
                            <tr>
                                <td>{{ $leavetype->leave_type_title }}</td>
                                <td>{{ $leavetype->leave_type_description }}</td>
                                <td>{{ $leavetype->leave_days_per_year }}</td>
                                <td>{{ $leavetype->max_leave_days }}</td>
                                <td>
                                    @if ($leavetype->cut_off_date == null)
                                        N/A
                                    @else
                                    {{ \Carbon\Carbon::parse($leavetype->cut_off_date)->format('M d, Y') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($leavetype->status_id == 'sta-1007')
                                        <p class="card-desc badge rounded-pill bg-success">{{ optional($leavetype->statuses)->status_title }}</p>
                                    @elseif ($leavetype->status_id == 'sta-1006')
                                        <p class="card-desc badge bg-warning rounded-pill text-dark">{{ optional($leavetype->statuses)->status_title }}</p>
                                    @endif
                                </td>
                                <td class="m-2">
                                    @if ($leavetype->status_id == 'sta-1007')
                                        <a href="#" type="button" class="btn btn-sm btn-primary ps-3 pe-3 rounded-0" data-bs-toggle="modal" data-bs-target="#UpdatetypeModal{{ $leavetype->id }}">Update</a>
                                        <a href="#" type="button" class="btn btn-sm btn-danger ps-3 pe-3 rounded-0" data-bs-toggle="modal" data-bs-target="#ArchiveLeavetypeModal{{ $leavetype->id }}">
                                            <i class='bx bx-archive-in' ></i>
                                            Archive
                                        </a>
                                    @elseif ($leavetype->status_id == 'sta-1006')
                                        <a href="#" type="button" class="btn btn-sm btn-primary ps-3 pe-3 rounded-0 disabled" >Update</a>
                                        <form action="{{ route('admin.unarchive.leavetype',$leavetype->id) }}" method="POST" class="d-inline" onsubmit="onClickUnarchiveId('{{ $leavetype->id }}')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success ps-3 pe-3 rounded-0" id="btn_unarchive{{ $leavetype->id }}" onclick="onClickUnarchiveId('{{ $leavetype->id }}')">
                                                <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_unarchive{{ $leavetype->id }}">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <i class='bx bx-archive-out' ></i>
                                                Unarchive
                                            </button>
                                        </form>
                                        <a href="#" type="button" class="btn btn-sm btn-danger ps-3 pe-3 rounded-0" data-bs-toggle="modal" data-bs-target="#delete_modal{{ $leavetype->id }}">
                                            <i class='bx bx-trash' ></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <!-- Update Leave Type Modal -->
                                <x-admin.admin-leave-type-update-modal
                                :leavetypeId="$leavetype->id">
                                </x-admin.admin-leave-type-update-modal>
                            {{-- End update leave Type Modal --}}
                            <!-- Archive Leave Type Modal -->
                                <x-admin.admin-leave-type-archive-modal
                                :leavetypeID="$leavetype->id">
                                </x-admin.admin-leave-type-archive-modal>
                            {{-- End Archive leave Type Modal --}}
                            <!-- delete leave type Modal -->
                                <x-admin.admin-leave-type-delete-modal
                                :leavetypeID="$leavetype->id">
                                </x-admin.admin-leave-type-delete-modal>
                            {{-- end delete leave type Modal --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
