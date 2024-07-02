<div class="modal fade" id="cancelleaveModal{{ $leave_reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('employee_leave_cancellation',$leave_reference_number) }}" method="POST" >
                @csrf
                <div class="modal-body" id="form_container_onCancel{{ $leave_reference_number }}">
                    <div class="container-fluid text-start">
                        <div class="row pt-3">
                            <div class="col-9">
                                <label for="employee">
                                    <h4 class="">CONFIRM LEAVE CANCELLATION</h4>
                                </label>
                            </div>
                            <div class="col-3 text-end">
                                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $leave_reference_number }}"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="employee">
                                    <h6 class="">Reference Number</h6>
                                </label>
                                <h4>{{ $leave_reference_number }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6>Reason / Note:</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="reason" id="reason" cols="10" rows="5" required oninput="submitBtnEnable_onCancel('{{ $leave_reference_number }}')"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent " id="btn_close_onCancel{{ $leave_reference_number }}" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger rounded-0 disabled" type="submit" id="btn_cancel{{ $leave_reference_number }}" onclick="onClickCancelId('{{ $leave_reference_number }}')">
                        <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_cancel{{ $leave_reference_number }}">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        Confirm Cancellation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
