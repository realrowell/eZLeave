<div class="modal fade" id="detailsModal{{ $leave_reference_number }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <div class="modal-body">
                <div class="container-fluid text-start">
                    <div class="row pt-3">
                        <div class="col-9">
                            <h3 class="modal-title">Leave Details</h3>
                        </div>
                        <div class="col-3 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row pt-3">
                                <div class="col">
                                    <label for="employee">
                                        <h6 class="">Reference Number</h6>
                                    </label>
                                    <h5>{{ $leave_reference_number }}</h5>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col">
                                    <label class="" for="leavetype">
                                        <h6 class="">Leave Type</h6>
                                    </label>
                                    <input type="text" class="form-control" disabled value="{{ $leave_type_title }}">
                                </div>
                                <div class="col">
                                    <label for="duration">
                                        <h6>Duration</h6>
                                    </label>
                                    <input type="text" class="form-control" disabled value="{{ $leave_duration }}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-6">
                                    <label for="startdate">
                                        <h6>Start date</h6>
                                    </label>
                                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_start)->format('M d, Y') }} ({{ $leave_start_part }})">
                                </div>
                                <div class="col-6">
                                    <label for="enddate">
                                        <h6>End date</h6>
                                    </label>
                                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_end)->format('M d, Y') }} ({{ $leave_end_part }})">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col">
                                    <label for="enddate">
                                        <h6>Date filed</h6>
                                    </label>
                                    <input type="text" class="form-control" disabled value="{{ \Carbon\Carbon::parse($leave_created)->format('M d, Y - h:i:s A') }}">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="employee">
                                        <h6 class="">Approver</h6>
                                    </label>
                                    <h5>
                                        {{ $leave_approver_name }}
                                    </h5>
                                </div>
                                <div class="col">
                                    <label for="employee">
                                        <h6 class="">Second Approver</h6>
                                    </label>
                                    <h5>
                                        @if ($second_approver_id == null)
                                            N/A
                                        @else
                                            {{ $second_approver_name }}
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    @if (!empty($attachment))
                                        <a class="btn btn-sm btn-primary rounded-0" target="_blank" href="{{ asset('storage/images/leave_attachment/'.$attachment) }}">View Attachment</a>
                                    @else
                                        <a class="btn btn-sm btn-primary disabled rounded-0" >No Attachment</a>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label class="" for="reason">
                                        <h6 class="">Reason / Note</h6>
                                    </label>
                                    @foreach ($leave_notes as $leave_note)
                                        @if ($leave_note->leave_application_reference == $leave_reference_number)
                                            <textarea class="form-control" disabled>{{ $leave_note->reason_note }}</textarea>
                                            @if ($leave_note->author_id != null)
                                                <p> - {{ $leave_note->users?->first_name }} {{ $leave_note->users?->last_name }} • {{ timestamp_leadtime($leave_note->created_at)}}</p>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label class="" for="status">
                                        <h6 class="">Status</h6>
                                    </label>
                                    @if ($status == 'sta-1001')
                                        @foreach ($leave_approvals as $leave_approval)
                                            @if ($leave_approval->leave_application_reference == $leave_reference_number)
                                                <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                            @endif
                                        @endforeach
                                    @elseif ($status == 'sta-1003')
                                        @foreach ($leave_approvals as $leave_approval)
                                            @if ($leave_approval->leave_application_reference == $leave_reference_number)
                                                @if ($leave_approval->status_id == 'sta-1001')
                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                @endif
                                            @endif
                                        @endforeach
                                    @elseif ($status == 'sta-1002')
                                        @foreach ($leave_approvals as $leave_approval)
                                            @if ($leave_approval->leave_application_reference == $leave_reference_number)
                                                @if ($leave_approval->status_id == 'sta-1001')
                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                @endif
                                            @endif
                                        @endforeach
                                    @elseif($status == 'sta-1004')
                                        @foreach ($leave_approvals as $leave_approval)
                                            @if ($leave_approval->leave_application_reference == $leave_reference_number)
                                                @if ($leave_approval->status_id == 'sta-1001')
                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                @elseif ($leave_approval->status_id == 'sta-1004')
                                                    <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                @endif
                                            @endif
                                        @endforeach
                                    @elseif($status == 'sta-1005')
                                        @foreach ($leave_approvals as $leave_approval)
                                            @if ($leave_approval->leave_application_reference == $leave_reference_number)
                                                @if ($leave_approval->status_id == 'sta-1001')
                                                    <p class="bg-secondary text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}}</p>
                                                @elseif ($leave_approval->status_id == 'sta-1002')
                                                    <p class="bg-success text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                @elseif ($leave_approval->status_id == 'sta-1004')
                                                    <p class="bg-danger text-light ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                @elseif ($leave_approval->status_id == 'sta-1005')
                                                    <p class="bg-warning text-dark ps-3">{{ $leave_approval->statuses->status_title }} - {{ $leave_approval->approvers->first_name." ". $leave_approval->approvers->last_name}} • {{ timestamp_leadtime($leave_approval->created_at)}}</p>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="" for="update">
                                        @if ($status == 'sta-1001')
                                            @if ($leave_app_employee == auth()->user()->employees->id)
                                                <button type="button" class="btn btn-sm btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#updatedetailsModal{{ $leave_reference_number }}">
                                                    Update Application
                                                </button>
                                            @elseif ($leave_app_employee != auth()->user()->employees->id)

                                            @endif
                                        @elseif ($status == 'sta-1003')
                                            @if ($leave_app_employee == auth()->user()->employees->id)
                                                <button type="button" class="btn btn-sm btn-primary rounded-0 disabled">
                                                    Update Application
                                                </button>
                                            @elseif ($leave_app_employee != auth()->user()->employees->id)

                                            @endif
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-start">
                            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col text-end">
                            @if ($status == 'sta-1001')
                                @if ($leave_app_employee == auth()->user()->employees->id)
                                    <button class="btn btn-danger text-center rounded-0" data-bs-toggle="modal" data-bs-target="#cancelleaveModal{{ $leave_reference_number }}">Cancel Application</button>
                                @elseif ($leave_app_employee != auth()->user()->employees->id)
                                    <a href="#" class="btn btn-danger rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_reference_number }}">Reject</a>
                                    <a href="#" class="btn btn-success rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_reference_number }}">Approve</a>
                                @endif
                            @elseif ($status == 'sta-1003')
                                @if ($leave_app_employee == auth()->user()->employees->id)
                                    <button class="btn btn-danger text-center rounded-0 disabled">Cancel Application</button>
                                    <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_reference_number]) }}" class="btn rounded-0 btn-primary text-center">View details</a>
                                @elseif ($leave_app_employee != auth()->user()->employees->id)
                                    <a href="#" class="btn btn-danger rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#rejectleaveModal{{ $leave_reference_number }}">Reject</a>
                                    <a href="#" class="btn btn-success rounded-0 text-center" data-bs-toggle="modal" data-bs-target="#approveLeaveModal{{ $leave_reference_number }}">Approve</a>
                                @endif
                            @elseif($status == 'sta-1002')
                                <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_reference_number]) }}" class="btn rounded-0 btn-primary text-center">View details</a>
                            @elseif($status == 'sta-1004')
                                <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_reference_number]) }}" class="btn rounded-0 btn-primary text-center">View details</a>
                            @elseif($status == 'sta-1005')
                                <a href="{{ route('leave_details_page',['leave_application_rn'=>$leave_reference_number]) }}" class="btn rounded-0 btn-primary text-center">View details</a>
                            @else
                                {{-- <button class="btn btn-danger text-center rounded-0" disabled>Cancel</button> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
