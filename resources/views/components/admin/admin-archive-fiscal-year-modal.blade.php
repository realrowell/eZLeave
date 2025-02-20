<div class="modal fade" id="ArchiveFiscalModal{{ $fiscalyear->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border border-end-0 border-top-0 border-bottom-0 border-warning border-5">
            <form action="{{ route('admin.archive.fiscalyear',$fiscalyear->id) }}" method="POST" onsubmit="submitButtonDisabled()">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid text-start" id="form_container{{ $fiscalyear->id }}">
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_modal_x{{ $fiscalyear->id }}"></button>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5">
                            <div class="col text-center">
                                <h2>Please confirm to archive selected fiscal year</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-start">
                                <button type="button" class="btn btn-transparent" id="btn_close{{ $fiscalyear->id }}" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-danger rounded-0" type="submit" id="btn_submit{{ $fiscalyear->id }}" onclick="onClickApproveId('{{ $fiscalyear->id }}')">
                                    <div class="spinner-border spinner-border-sm d-none" role="status" id="loading_spinner_approve{{ $fiscalyear->id }}">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Confirm Archival
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
