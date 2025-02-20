<div class="modal fade" id="UpdatetypeModal{{ $leavetype->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <form action="{{ route('admin.update.leavetype',['leavetype_id'=>$leavetype->id]) }}" method="POST" onsubmit="onClickApprove()">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid text-start">
                        <div class="row mt-3 mb-3">
                            <div class="col-8 text-start">
                                <h5 class="modal-title" id="staticBackdropLabel">Update Leave Type</h5>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3" >
                            <div class="col">
                                <label for="leavetype_title">
                                    <h6 class="">Leave Type Title</h6>
                                </label>
                                <input type="text" class="form-control" id="leavetype_title" name="leavetype_title" value="{{ $leavetype->leave_type_title }}" disabled>
                                <label class="mt-3" for="leavetype_description">
                                    <h6 class="">Leave Type Description</h6>
                                </label>
                                <textarea class="form-control" id="leavetype_description" name="leavetype_description" rows="8" cols="50" required>{{ $leavetype->leave_type_description }}</textarea>
                            </div>
                            <div class="col">
                                <label for="days_per_year">
                                    <h6>Leave per year (Days)</h6>
                                </label>
                                <input type="number" class="form-control" id="days_per_year" name="days_per_year" value="{{ $leavetype->leave_days_per_year }}" required>
                                <label class="mt-3" for="max_days">
                                    <h6>Max Accumulation (Days)</h6>
                                </label>
                                <input type="number" class="form-control" id="max_days" name="max_days" value="{{ $leavetype->max_leave_days }}" required>
                                <label class="mt-3" for="cut_off_date">
                                    <h6>Cut off Date</h6>
                                </label>
                                @if ($leavetype->cut_off_date == null)
                                    <input type="date" class="form-control" id="cut_off_date" name="cut_off_date" placeholder="">
                                @else
                                    <input type="date" class="form-control" id="cut_off_date" name="cut_off_date" value="{{ \Carbon\Carbon::parse($leavetype->cut_off_date)->format('Y-m-d') }}">
                                @endif
                                {{-- <label class="mt-3" for="reset_date">
                                    <h6>Reset Date</h6>
                                </label> --}}
                                {{-- <input type="date" class="form-control" id="reset_date" name="reset_date" hidden value="{{ \Carbon\Carbon::parse($leavetype->reset_date)->format('Y-m-d') }}" required> --}}
                                {{-- @if ($leavetype->show_on_employee == false)
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="show_on_employee2{{ $leavetype->leave_type_title }}" name="show_on_employee" value="1">
                                        <label class="form-check-label" for="show_on_employee2{{ $leavetype->leave_type_title }}">Show this to Employee</label>
                                    </div>
                                @else
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="show_on_employee1{{ $leavetype->leave_type_title }}" name="show_on_employee" value="1" checked>
                                        <label class="form-check-label" for="show_on_employee1{{ $leavetype->leave_type_title }}">Show this to Employee</label>
                                    </div>
                                @endif --}}
                                @if ($leavetype->accumulable == false)
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_accumulable2{{ $leavetype->leave_type_title }}" name="is_accumulable" value="1">
                                        <label class="form-check-label" for="is_accumulable2{{ $leavetype->leave_type_title }}">is Accumulable?</label>
                                    </div>
                                @else
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_accumulable1{{ $leavetype->leave_type_title }}" name="is_accumulable" value="1" checked>
                                        <label class="form-check-label" for="is_accumulable1{{ $leavetype->leave_type_title }}">is Accumulable?</label>
                                    </div>
                                @endif
                                @if ($leavetype->status_id == 'sta-1007')
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_active1{{ $leavetype->leave_type_title }}" name="is_active" value="1" checked>
                                        <label class="form-check-label" id="is_active_checkbox" for="is_active1{{ $leavetype->leave_type_title }}">is Active</label>
                                    </div>
                                @elseif($leavetype->status_id == 'sta-1008')
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_active2{{ $leavetype->leave_type_title }}" name="is_active" value="1">
                                        <label class="form-check-label" id="is_active_checkbox" for="is_active2{{ $leavetype->leave_type_title }}">is Active</label>
                                    </div>
                                @endif
                                @if ($leavetype->predate == false)
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="apply_predate2{{ $leavetype->leave_type_title }}" name="apply_predate" value="1">
                                        <label class="form-check-label" for="apply_predate2{{ $leavetype->leave_type_title }}">Apply Predate?</label>
                                    </div>
                                @else
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" id="apply_predate1{{ $leavetype->leave_type_title }}" name="apply_predate" value="1" checked>
                                        <label class="form-check-label" for="apply_predate1{{ $leavetype->leave_type_title }}">Apply Predate?</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row mt-3 mb-3">
                            <div class="col-8 text-start">
                                <button type="button" class="btn btn-transparent ps-3 pe-3 rounded-0" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="col-4 text-end">
                                <button id="submit_button1" type="submit" class="btn btn-success ps-3 pe-3 rounded-0" >Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
