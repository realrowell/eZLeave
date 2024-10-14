<div class="modal fade" id="update_subdepartment{{ $subdepartment->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <form action="{{ route('admin_update_subdepartment',['id'=>$subdepartment->id]) }}" method="PUT" onsubmit="submitButtonDisabled()">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid text-start">
                        <div class="row mt-3 mb-3">
                            <div class="col-6 text-start">
                                <h5 class="modal-title" id="staticBackdropLabel">Update Department</h5>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3" >
                            <div class="col">
                                <label for="subdepartment_title"><h6 class="profile-title">Sub-deparment name</h6></label>
                                <input type="text" class="form-control" id="subdepartment_title" name="subdepartment_title" placeholder="{{ $subdepartment->sub_department_title }}" value="{{ $subdepartment->sub_department_title }}">
                                <label class="mt-3" for="dept_name"><h6 class="profile-title">Department</h6></label>
                                <select id="dept_name" name="dept_name" class="form-control" required>
                                    <option selected hidden value="{{ $subdepartment->departments->id }}">{{ $subdepartment->departments->department_title }}</option>
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
                                <button type="button" class="btn btn-danger rounded-0 ps-3 pe-3" data-bs-dismiss="modal">Discard</button>
                            </div>
                            <div class="col-6 text-end">
                                <button id="submit_button" type="submit" class="btn btn-success rounded-0 ps-3 pe-3" >Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
