@extends('profiles.admin.organization.area_of_assignments')
@section('list_active','bg-selected-warning')
@section('sub-content')

{{-- <div class="row mt-2">
    <div class="col-lg-6 col-md-6 col-sm-12">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="row">
            <div class="input-group">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-primary">search</button>
            </div>
        </div>
        <div class="row">
            <p>*Search area of assignment here</p>
        </div>
    </div>
</div> --}}
{{-- LIST PROFILE --}}
<div class="row">
    <div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <table id="data_table" class="table table-bordered table-hover bg-light shadow">
                    <thead class="bg-success text-light border-light">
                        <tr>
                            <th>Area of Assignments</th>
                            <th class="">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($area_of_assignments as $area_of_assignment)
                            <tr>
                                <td>{{ $area_of_assignment->location_address }}</td>
                                <td class="">
                                    <a href="#" class="" title="View">
                                        <svg class="m-1" width="23px" height="23px" viewBox="0 0 20 20">
                                            {{ svg('carbon-view-filled') }}
                                        </svg>
                                    </a>
                                    <a href="#Update_area_of_assignment" class="" data-bs-toggle="modal" data-bs-target="#update_area_of_assignment{{ $area_of_assignment->id }}" title="Update">
                                        <svg class="m-1" width="20px" height="20px" viewBox="0 0 25 25">
                                            {{ svg('feathericon-edit') }}
                                        </svg>Update
                                    </a>
                                    <a href="#Delete_area_of_assignment" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_area_of_assignment_{{ $area_of_assignment->id }}" title="Delete">
                                        <svg class="m-1" width="23px" height="23px" viewBox="0 0 23 23">
                                            {{ svg('css-trash') }}
                                        </svg>Delete
                                    </a>
                                </td>
                            </tr>

                            <!-- Update Department Modal -->
                            <div class="modal fade" id="update_area_of_assignment{{ $area_of_assignment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/organization/update_area_of_assignments/{{ $area_of_assignment->id }}" method="PUT">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update Area of Assignment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label for="location_address"><h6 class="profile-title">Area of assignment</h6></label>
                                                            <input type="text" class="form-control" id="location_address" name="location_address" value="{{ $area_of_assignment->location_address }}" placeholder="">
                                                            <label for="location_desc" class="mt-3"><h6 class="profile-title">Description</h6></label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" name="location_desc" placeholder="Type a reason here" id="location_desc" style="height: 100px">{{ $area_of_assignment->location_desc }}</textarea>
                                                                <label for="location_desc">Description goes here</label>
                                                            </div>
                                                            <label for="embedmap" class="mt-3"><h6 class="profile-title">Embed Map</h6></label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" name="embedmap" placeholder="Type a reason here" id="embedmap" style="height: 300px">{{ $area_of_assignment->embedded_google_map }}</textarea>
                                                                <label for="embedmap">HTML code goes here</label>
                                                            </div>
                                                            <a href="{{ $system_settings->embed_map_provider }}" class="text-end" target="_blank">get Embed Map code here</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Update Department Modal --}}
                            <!-- Delete Department Modal -->
                            <div class="modal fade" id="delete_area_of_assignment_{{ $area_of_assignment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/organization/delete_area_of_assignments/{{ $area_of_assignment->id }}" method="PUT">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete Area of Assignment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label for="department_title"><h6 class="profile-title">Are you sure you want to delete this?</h6></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outlined" data-bs-dismiss="modal">Discard</button>
                                                <button id="submit_button2" type="submit" class="btn btn-danger" >Confirm</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Delete Department Modal --}}
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
{{-- END LIST --}}

</div>

@endsection
