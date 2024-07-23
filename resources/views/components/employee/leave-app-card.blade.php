<div class="card w-100 p-2 shadow shadow-sm border border-end-0 border-start-0 border-bottom-0 border-warning border-5 rounded-0">
    <div class="card-body">
        <div class="row ">
            <div class="col">
                <h4 class="card-title text-center">{{ $leave_type_title }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-text" id="approval_p">Reference #:</p>
                <h5> {{ $leave_reference_number }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p class="card-text" id="approval_p">Start date:</p>
                <h5> {{ \Carbon\Carbon::parse($leave_start)->format('M d, Y')}}</h5>
            </div>
            <div class="col-4">
                <p class="card-text" id="approval_p">End date:</p>
                <h5> {{ \Carbon\Carbon::parse($leave_end)->format('M d, Y')}}</h5>
            </div>
            <div class="col-4">
                <p class="card-text" id="approval_p">Duration:</p>
                <h5>{{ $leave_duration }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-text" id="approval_p">Date of application:</p>
                <h5> {{ \Carbon\Carbon::parse($leave_created)->format('M d, Y - h:i:sa')}}</h5>
            </div>
        </div>
        <div class="row mt-4">
            @if ($leave_app_employee != auth()->user()->employees->id)
                <div class="col">
                    <p class="card-text" id="approval_p">Application by:</p>
                    <h6>
                        {{ $leave_employee_name }}
                    </h6>
                </div>
            @elseif ($leave_app_employee == auth()->user()->employees->id)
                <div class="col">
                    <p class="card-text" id="approval_p">Approver:</p>
                    <h6>
                        {{ $leave_approver_name }}
                    </h6>
                </div>
                <div class="col">
                    @if ($second_approver_id != null)
                        <p class="card-text" id="approval_p">Second Approver:</p>
                        <h6 class="">
                            {{ $second_approver_name }}
                        </h6>
                    @endif
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                @if ($status == 'sta-1001')
                    <p class="bg-secondary text-light ps-3">{{ $status_title }}</p>
                @elseif ($status == 'sta-1002')
                    <p class="bg-success text-light ps-3">{{ $status_title }}</p>
                @elseif ($status == 'sta-1003')
                    <p class="bg-secondary text-light ps-3">{{ $status_title }}</p>
                @elseif ($status == 'sta-1004')
                    <p class="bg-danger text-light ps-3">{{ $status_title }}</p>
                @elseif ($status == 'sta-1005')
                    <p class="bg-warning text-dark ps-3">{{ $status_title }}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-grid gap-2">
                    <button class="btn btn-sm btn-primary text-center rounded-0" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave_reference_number }}">View Details</button>
                    @if ($status == 'sta-1001')
                        @if ($leave_app_employee == auth()->user()->employees->id)
                            <button class="btn btn-sm btn-danger text-center rounded-0" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_reference_number }}">Cancel</button>
                        @elseif ($leave_app_employee != auth()->user()->employees->id)
                            <a href="#" class="btn btn-sm btn-success rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_reference_number }}">Approve</a>
                            <a href="#" class="btn btn-sm btn-danger rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_reference_number }}">Reject</a>
                        @endif
                    @elseif ($status == 'sta-1002')

                    @elseif ($status == 'sta-1003')
                        @if ($leave_app_employee == auth()->user()->employees->id)
                            <button class="btn btn-sm btn-danger text-center rounded-0" disabled>Cancel</button>
                        @elseif ($leave_app_employee != auth()->user()->employees->id)
                            <a href="#" class="btn btn-sm btn-success rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_reference_number }}">Approve</a>
                            <a href="#" class="btn btn-sm btn-danger rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_reference_number }}">Reject</a>
                        @endif
                    @else
                        {{-- <button class="btn btn-sm btn-danger text-center rounded-0" disabled>Cancel</button> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
