<div class="modal fade" id="ArchiveLeavetypeModal{{ $leavetype->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <div class="modal-body">
                <div class="container-fluid text-start">
                    <div class="row">
                        <div class="col text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5">
                        <div class="col text-center">
                            <h2>Please confirm to archive selected leave type</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent ps-3 pe-3 rounded-0" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.archive.leavetype',['leavetype_id'=>$leavetype->id]) }}" method="POST" onsubmit="onClickApprove()">
                    @csrf
                    <button class="btn btn-danger ps-3 pe-3 rounded-0" type="submit" data-bs-dismiss="modal">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
