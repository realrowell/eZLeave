<div class="modal fade bg-static" id="ApplyLeaveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('create_employee_leaveapplication') }}" method="POST" enctype="multipart/form-data" id="form_submit" onsubmit="onClickApplyLeave()">
                @csrf
                @method('POST')
                <div class="modal-body" id="form_container_onApply">
                    <div class="row pt-3">
                        <div class="col-9">
                            <h5 class="modal-title" id="staticBackdropLabel">File a Leave Application</h5>
                        </div>
                        <div class="col-3 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x_onApply"></button>
                        </div>
                    </div>
                    <div class="container-fluid text-start">
                        <div class="row">
                            <div class="col">
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="leavetype">
                                            <h6 class="">*Leave Type</h6>
                                        </label>
                                        <select class="form-select" id="leavetype" name="leavetype" required>
                                            <option selected disabled value=""></option>
                                            @foreach ($leave_credits as $leave_credit)
                                                @if ($leave_credit->expiration != null)
                                                    @if ($leave_credit->expiration >= now())
                                                        <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }} - {{ $leave_credit->leave_days_credit }}</option>
                                                    @endif
                                                @endif
                                                @if ($leave_credit->expiration == null)
                                                    @if ($leave_credit->leavetypes->cut_off_date != null)
                                                        @if ($leave_credit->leavetypes->cut_off_date >= now())
                                                            <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }} - {{ $leave_credit->leave_days_credit }}</option>
                                                        @endif
                                                    @endif
                                                    @if ($leave_credit->leavetypes->cut_off_date == null)
                                                        <option value="{{ $leave_credit->leavetypes->id }}">{{ $leave_credit->leavetypes->leave_type_title }} - {{ $leave_credit->leave_days_credit }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="startdate">
                                            <h6>*Start date</h6>
                                        </label>
                                        <input type="date" class="form-control" id="datetime_startdate" name="startdate" placeholder="" required onchange="showLeaveDuration()" novalidate>
                                        <span class="invalid-feedback" id="error_startdate"></span>
                                        <span class="valid-feedback" >looks good!</span>
                                    </div>
                                    <div class="col-6">
                                        <label for="enddate">
                                            <h6>*End date</h6>
                                        </label>
                                        <input type="date" class="form-control" id="datetime_enddate" name="enddate" placeholder="" required onchange="showLeaveDuration()">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col" id="datelabel_start_am" style="display: none;">
                                        <div class="form-check">
                                            <label for="start_am_check" class="form-check-label" >Morning</label>
                                            <input type="checkbox" class="form-check-input" id="start_am_check" name="start_am_check" value="1" onchange="showLeaveDuration()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_start_pm" style="display: none;">
                                        <div class="form-check">
                                            <label for="start_pm_check" class="form-check-label" >Afternoon</label>
                                            <input type="checkbox" class="form-check-input" id="start_pm_check" name="start_pm_check" value="1" onchange="showLeaveDuration()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_end_am" style="display: none;">
                                        <div class="form-check">
                                            <label for="end_am_check" class="form-check-label" >Morning</label>
                                            <input type="checkbox" class="form-check-input" id="end_am_check" name="end_am_check" value="1" onchange="showLeaveDuration()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_end_pm" style="display: none;">
                                        <div class="form-check">
                                            <label for="end_pm_check" class="form-check-label" >Afternoon</label>
                                            <input type="checkbox" class="form-check-input" id="end_pm_check" name="end_pm_check" value="1" onchange="showLeaveDuration()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="duration">Duration (days)</label>
                                        <a class="m-2 fs-6" data-bs-toggle="tooltip" data-bs-placement="right" title="*If the date range includes a weekend, it will not be count after creating the application.">
                                            <i class='bx bx-info-circle text-primary'></i>
                                        </a>
                                        <input type="text" name="duration" placeholder="" id="duration_input" class="form-control" disabled/>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="attachment">
                                            <h6 class="">Attachment (optional)</h6>
                                        </label>
                                        <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="reason">
                                            <h6 class="">Reason / Note (optional)</h6>
                                        </label>
                                        <textarea class="form-control" id="reason" name="reason" rows="5" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="form_submit" style="opacity: 1">
                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal" id="btn_close_onApply">Cancel</button>
                    <button id="btn_apply" type="submit" class="btn btn-success rounded-0" >
                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_apply">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        Create Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
