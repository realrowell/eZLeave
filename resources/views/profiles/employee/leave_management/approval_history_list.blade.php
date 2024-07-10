@extends('profiles.employee.leave_management.approval_history')
@section('list_view_active','bg-selected-warning')
@section('sub-content')

<div class="row">
    <div id="table_container">
        <div class="table-wrapper">
            <table class="table table-sm table-bordered table-hover bg-light" id="datatable_approval_history">
                <thead class="bg-success text-light border-light">
                    <tr>
                        <th>Reference Number</th>
                        <th>Employee</th>
                        <th>Leave Type</th>
                        {{-- <th>Start date</th> --}}
                        {{-- <th>End date</th> --}}
                        {{-- <th>Duration (days)</th> --}}
                        <th class="prefer">Approved at</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($leave_approvals as $leave_approval)
                        <tr>
                            <td>
                                <a class="custom-bg-primary-hover " href="{{ route('leave_details_page',$leave_approval->leave_applications->reference_number) }}">
                                    {{ $leave_approval->leave_applications->reference_number }}
                                </a>
                            </td>
                            <td id="table_reports_to">
                                @if (!empty($leave_approval->leave_applications->employees))
                                    {{ optional($leave_approval->leave_applications->employees->users)->first_name }}
                                    {{ optional($leave_approval->leave_applications->employees->users)->middle_name }}
                                    {{ optional($leave_approval->leave_applications->employees->users)->last_name }}
                                @else
                                    Not Available
                                @endif
                            </td>
                            <td>{{ optional($leave_approval->leave_applications->leavetypes)->leave_type_title }}</td>
                            {{-- <td>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->start_date)->format('M d, Y') }} - {{ $leave_approval->leave_applications->start_of_date_parts->day_part_title }}</td> --}}
                            {{-- <td>{{ \Carbon\Carbon::parse($leave_approval->leave_applications->end_date)->format('M d, Y') }} - {{ $leave_approval->leave_applications->end_of_date_parts->day_part_title }}</td> --}}
                            {{-- <td>{{ $leave_approval->leave_applications->duration }}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($leave_approval->created_at)->format('m/d/Y \\a\\t\ H:ia') }}</td>
                        </tr>
                    @empty
                        {{-- <tr>
                            <td>
                                <div class="row align-items-center justify-content-center mt-3">
                                    <div class="col text-center">
                                        <h2>No leave application available!</h2>
                                    </div>
                                </div>
                            </td>
                        </tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col">
                <div class="mt-2 mb-5">
                    <ul class="pagination justify-content-center align-items-center">
                        {{-- {!! $leave_approval->leave_applicationss->links('pagination::bootstrap-5') !!} --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
