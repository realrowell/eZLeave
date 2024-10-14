<div class="modal fade" id="create_position_title" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="spinner-border text-primary" id="loading_spinner_2" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <form action="{{ route('admin_create_position_title') }}" method="POST" onsubmit="onFormSubmit_1()">
                @csrf
                <div class="modal-body" id="form_to_submit_2">
                    <div class="container-fluid text-start">
                        <div class="row mt-3 mb-3">
                            <div class="col-8 text-start">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Employee Positions</h5>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3" >
                            <div class="col">
                                <label for="position_title"><h6 class="profile-title">Position Title</h6></label>
                                <input type="text" class="form-control" id="position_title" name="position_title" placeholder="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 text-start">
                                <button type="button" class="btn btn-danger ps-3 pe-3 rounded-0" data-bs-dismiss="modal">Discard</button>
                            </div>
                            <div class="col-6 text-end">
                                <button id="submit_button_2" type="submit" class="btn btn-success ps-3 pe-3 rounded-0">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
