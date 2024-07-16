<div class="modal fade" id="cancelLeaveModal{{ $reference_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('leave_application_cancellation', $reference_number) }}" method="POST" onsubmit="onClickCancelId('{{ $reference_number }}')">
            @csrf
            <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0" >
                <div class="modal-body">
                    <div class="container-fluid text-start" id="form_container_onCancel{{ $reference_number }}" >
                        <div class="row pt-3">
                            <div class="col-9">
                                <label for="employee">
                                    <h4 class="">CONFIRM LEAVE CANCELLATION</h4>
                                </label>
                            </div>
                            <div class="col-3 text-end">
                                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $reference_number }}"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="employee">
                                    <h6 class="">Reference Number</h6>
                                </label>
                                <h4>{{ $reference_number }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6>Reason / Note:</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="reason" id="reason" cols="10" rows="5" required oninput="submitBtnEnable_onCancel('{{ $reference_number }}')"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-transparent " id="btn_close_onCancel{{ $reference_number }}" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger disabled" id="btn_cancel{{ $reference_number }}" >
                                <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_cancel{{ $reference_number }}">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                Confirm Cancellation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
