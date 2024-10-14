<div class="modal fade" id="create_aoa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="spinner-border text-primary" id="loading_spinner_1" role="status" style="display: none;">
            <span class="visually-hidden" >Loading...</span>
        </div>
        <div class="modal-content border border-5 border-warning border-top-0 border-bottom-0 border-end-0 rounded-0">
            <form action="{{ route('admin_create_areaofassignemnt') }}" method="POST" onsubmit="onFormSubmit()">
                @csrf
                <div class="modal-body" id="form_to_submit">
                    <div class="container-fluid text-start">
                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Area of Assignment</h5>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3" >
                            <div class="col">
                                <label for="location_address"><h6 class="profile-title">Area of assignment</h6></label>
                                <input type="text" class="form-control" id="location_address" name="location_address" placeholder="">
                                <label for="location_desc" class="mt-3"><h6 class="profile-title">Description</h6></label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="location_desc" placeholder="Type a reason here" id="location_desc" style="height: 100px"></textarea>
                                    <label for="location_desc">Description goes here</label>
                                </div>
                                <label for="embedmap" class="mt-3"><h6 class="profile-title">Embed Map</h6></label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="embedmap" placeholder="Type a reason here" id="embedmap" style="height: 300px"></textarea>
                                    <label for="embedmap">HTML code goes here</label>
                                </div>
                                <a href="{{ $system_settings->embed_map_provider }}" class="text-end" target="_blank">get Embed Map code here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col">
                                <button type="button" class="btn btn-danger ps-3 pe-3 rounded-0" data-bs-dismiss="modal">Discard</button>
                            </div>
                            <div class="col text-end">
                                <button type="submit" id="submit_button1" class="btn btn-success ps-3 pe-3 rounded-0">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
