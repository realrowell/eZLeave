<div class="modal fade" id="AddTypeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <form action="{{ route('admin.create.fiscalyear') }}" method="POST" onsubmit="onClickApprove()">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <h5 class="modal-title" id="staticBackdropLabel">Create Fiscal Year</h5>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="fiscalyear_title">
                                    <h6 class="">Fiscal Year Title</h6>
                                </label>
                                <input type="text" class="form-control" id="fiscalyear_title" name="fiscalyear_title" placeholder="" required>
                                <label class="mt-3" for="fiscalyear_description">
                                    <h6 class="">Fiscal Year Description</h6>
                                </label>
                                <textarea class="form-control" id="fiscalyear_description" name="fiscalyear_description" rows="5" cols="50" required></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="start_date">
                                    <h6>Start date</h6>
                                </label>
                                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="" required>
                                <label class="mt-3" for="end_date">
                                    <h6>End date</h6>
                                </label>
                                <input type="date" class="form-control" id="end_date" name="end_date" placeholder="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-danger rounded-0 ps-3 pe-3" data-bs-dismiss="modal">Discard</button>
                            </div>
                            <div class="col text-end">
                                <button id="submit_button1" type="submit" class="btn btn-success rounded-0 ps-3 pe-3">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
