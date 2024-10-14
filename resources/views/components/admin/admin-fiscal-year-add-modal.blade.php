<div class="modal fade" id="AddTypeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.create.leavetype') }}" method="POST" onsubmit="onClickApprove()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Fiscal Year</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid text-start">
                        <div class="row mt-2 mb-3" >
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="leavetype_title">
                                    <h6 class="">Fiscal Year Title</h6>
                                </label>
                                <input type="text" class="form-control" id="leavetype_title" name="leavetype_title" placeholder="" required>
                                <label class="mt-3" for="leavetype_description">
                                    <h6 class="">Leave Type Description</h6>
                                </label>
                                <textarea class="form-control" id="leavetype_description" name="leavetype_description" rows="5" cols="50" required></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="days_per_year">
                                    <h6>Leave per year (Days)</h6>
                                </label>
                                <input type="number" class="form-control" id="days_per_year" name="days_per_year" placeholder="" required>
                                <label class="mt-3" for="max_days">
                                    <h6>Max Accumulation (Days)</h6>
                                </label>
                                <input type="number" class="form-control" id="max_days" name="max_days" placeholder="" required>
                                <label class="mt-3" for="cut_off_date">
                                    <h6>Cut off Date</h6>
                                </label>
                                <input type="date" class="form-control" id="cut_off_date" name="cut_off_date" placeholder="">
                                {{-- <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="show_on_employee" name="show_on_employee" value="1">
                                    <label class="form-check-label" for="show_on_employee">Show this to Employee</label>
                                </div> --}}
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="is_accumulable" name="is_accumulable" value="1">
                                    <label class="form-check-label" for="is_accumulable">is Accumulable?</label>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="apply_predate" name="apply_predate" value="1">
                                    <label class="form-check-label" for="apply_predate">Apply Predate</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                    <button id="submit_button1" type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
