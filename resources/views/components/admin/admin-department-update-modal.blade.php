<div class="modal fade" id="update_department{{ $department->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <form action="{{ route('admin_update_department',['id'=>$department->id]) }}" method="PUT" onsubmit="submitButtonDisabled()">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="container-fluid text-start">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <h5 class="modal-title" id="staticBackdropLabel">Update Department</h5>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3" >
                            <div class="col">
                                <label for="department_title"><h6 class="profile-title">Deparment name</h6></label>
                                <input type="text" class="form-control" id="department_title" name="department_title" placeholder="{{ $department->department_title }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                    <button id="submit_button2" type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
