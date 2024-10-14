<div class="modal fade" id="create_position" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <form action="{{ route('admin_create_position') }}" method="POST" onsubmit="onFormSubmit()">
                @csrf
                <div class="modal-body" id="form_to_submit">
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
                                <select id="position_title" name="position_title" class="form-control" required>
                                    <option disabled selected required value="">— Please select here —</option>
                                    @foreach ($position_titles as $position_title)
                                        <option value="{{ $position_title->id }}">{{ $position_title->position_title }}</option>
                                    @endforeach
                                </select>
                                <label class=" mt-3" for="position_description"><h6 class="profile-title">Position Description</h6></label>
                                <textarea class="form-control" id="position_description" name="position_description" rows="3" cols="10" required></textarea>
                                <label class="mt-3" for="subdepartment_title"><h6 class="profile-title">Sub-department</h6></label>
                                <select id="subdepartment_title" name="subdepartment_title" class="form-control" required>
                                    <option disabled selected required value="">— Please select here —</option>
                                    @foreach ($subdepartments as $subdepartment)
                                        <option value="{{ $subdepartment->id }}">{{ $subdepartment->sub_department_title }}</option>
                                    @endforeach
                                </select>
                                <label class="mt-3" for="position_level"><h6 class="profile-title">Position Level</h6></label>
                                <select id="position_level" name="position_level" class="form-control" required>
                                    <option disabled selected required value="">— Please select here —</option>
                                    @foreach ($position_levels as $position_level)
                                        <option value="{{ $position_level->id }}">{{ $position_level->level_title }}</option>
                                    @endforeach
                                </select>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="is_hod" name="is_hod">
                                    <label class="form-check-label" for="is_hod">Head of Department</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="is_hr_manager" name="is_hr_manager">
                                    <label class="form-check-label" for="is_hr_manager">HR Manager</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8 text-start">
                                <button type="button" class="btn btn-danger ps-3 pe-3 rounded-0" data-bs-dismiss="modal">Discard</button>
                            </div>
                            <div class="col-4 text-end">
                                <button id="submit_button1" type="submit" class="btn btn-success ps-3 pe-3 rounded-0">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
