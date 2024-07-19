<div class="modal fade" id="reset_password_modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-5 border-warning border-top-0 border-end-0 border-bottom-0 rounded-0">
            <div class="modal-body">
                <div class="container-fluid text-start">
                    <div class="row mt-2 mb-3">
                        <div class="col text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="row mb-4 mt-4">
                        <div class="col text-center">
                            <h2>Please confirm to reset the password</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 text-start">
                            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col-6 text-end">
                            <form action="{{ route('account_reset_password',['username'=>$username]) }}" method="PUT" onsubmit="onClickApprove()">
                                @csrf
                                <button class="btn btn-danger rounded-0 ps-3 pe-3" type="submit">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
