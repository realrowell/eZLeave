@extends('profiles.admin.organization.area_of_assignments')
@section('grid_active','bg-selected-warning')
@section('sub-content')

<div class="row mt-2">
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
</div>
    {{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($area_of_assignments as $area_of_assignment)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <div class="card w-100 p-2 shadow">
                <div class="card-body row">
                    <div class="">
                        <div class="row">
                            <h5><strong>{{ $area_of_assignment->location_address }}</strong></h5>
                        </div>
                        <div class="row">
                            <p class="card-desc">Employees: 45</p>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <a href="/admin/organization/area_of_assignments/profile/{{ $area_of_assignment->id }}" class="btn-sm btn-primary text-center">View</a>
                                <a href="#Update_department" class="btn-sm btn-outline-primary border border-primary" data-bs-toggle="modal" data-bs-target="#update_area_of_assignment{{ $area_of_assignment->id }}">
                                    Update
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    @endforeach
    
    {{-- END CARDS --}}
    
</div>
@endsection