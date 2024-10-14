<div class="modal fade" id="activate_account_modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border border-end-0 border-top-0 border-bottom-0 border-warning border-5">
            <div class="modal-body">
                <div class="container-fluid text-start">
                    <div class="row">
                        <div class="col text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5">
                        <div class="col text-center">
                            <h2>Please confirm to Activate account</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-start">
                            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col text-end">
                            <form action="{{ route('account_activate',['username'=>$username]) }}" method="PUT" onsubmit="onClickApprove()">
                                @csrf
                                <button class="btn btn-success rounded-0" type="submit">Confirm Activation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
