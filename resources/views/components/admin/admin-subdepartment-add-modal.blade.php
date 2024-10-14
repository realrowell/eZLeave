<div class="modal fade" id="create_subdepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0" id="form_to_submit">
            <form action="{{ route('admin_create_subdepartment') }}" method="POST" onsubmit="onFormSubmit()">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid text-start">
                        <div class="row mt-3 mb-3">
                            <div class="col-6 text-start">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Sub-department</h5>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3" >
                            <div class="col">
                                <label for="subdepartment_title"><h6 class="profile-title">Sub-department name</h6></label>
                                <input type="text" class="form-control" id="subdepartment_title" name="subdepartment_title" placeholder="" required>
                                <label class="mt-3" for="dept_name"><h6 class="profile-title">Department</h6></label>
                                <select id="dept_name" name="dept_name" class="form-control" required>
                                    <option disabled selected required value="">— Please select here —</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_title }}</option>
                                    @endforeach
                                </select>
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
                                <button id="submit_button1" type="submit" class="btn btn-success ps-3 pe-3 rounded-0">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
