<div class="modal fade" id="create_department" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0" id="form_to_submit">
            <form action="{{ route('admin_create_department') }}" method="POST" onsubmit="onFormSubmit()">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid text-start">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Department</h5>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mt-3 mb-3" >
                            <div class="col">
                                <label for="department_title"><h6 class="profile-title">Deparment name</h6></label>
                                <input type="text" class="form-control" id="department_title" name="department_title" value="{{ old('department_title') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Discard</button>
                            </div>
                            <div class="col text-end">
                                <button id="submit_button1" type="submit" class="btn btn-success rounded-0" >Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
