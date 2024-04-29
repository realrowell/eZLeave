@extends('profiles.admin.organization.positions')
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
            <p>*Search position title here</p>
        </div>
    </div>
</div> --}}
{{-- LIST PROFILE --}}
<div class="row">
    <div class="table-responsive">
        <div class="table-wrapper">
            <table id="data_table" class="table table-bordered table-hover bg-light shadow">
                <thead class="bg-success text-light border-light">
                    <tr>
                        <th>Position Title</th>
                        <th>Sub-dpartment</th>
                        <th>Department</th>
                        <th>Level</th>
                        <th class="text-end pe-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->position_description }}</td>
                            <td>{{ $position->subdepartments->sub_department_title }}</td>
                            <td>{{ $position->subdepartments->departments->department_title }}</td>
                            <td>{{ $position->position_levels->level_title }}</td>
                            <td class="text-end pe-5">
                                <a type="button" href="#" class="btn btn-sm btn-primary">
                                    View
                                </a>
                                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#update_position{{ $position->id }}" title="Update">
                                    Update
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_position_{{ $position->id }}" title="Delete">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Update Department Modal -->
                            <div class="modal fade" id="update_position{{ $position->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin_update_position',['id'=>$position->id]) }}" method="PUT" onsubmit="submitButtonDisabled()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update Position</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label for="position_title"><h6 class="profile-title">Position title</h6></label>
                                                            <select id="position_title" name="position_title" class="form-control" required>
                                                                <option selected required value="{{ $position->position_titles->id }}">{{ $position->position_titles->position_title }}</option>
                                                                @foreach ($position_titles as $position_title)
                                                                    <option value="{{ $position_title->id }}">{{ $position_title->position_title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="mt-3" for="position_title"><h6 class="profile-title">Position description</h6></label>
                                                            <textarea class="form-control" id="position_description" name="position_description" rows="3    " cols="50" required>{{ $position->position_description }}</textarea>
                                                            <label class="mt-3" for="subdepartment_title"><h6 class="profile-title">Sub-department</h6></label>
                                                            <select id="subdepartment_title" name="subdepartment_title" class="form-control" required>
                                                                <option selected required value="{{ $position->subdepartment_id }}">{{ $position->subdepartments->sub_department_title }}</option>
                                                                @foreach ($subdepartments as $subdepartment)
                                                                    <option value="{{ $subdepartment->id }}">{{ $subdepartment->sub_department_title }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="mt-3" for="position_level"><h6 class="profile-title">Position Level</h6></label>
                                                            <select id="position_level" name="position_level" class="form-control" required>
                                                                <option selected required value="{{ $position->position_level_id }}">{{ optional($position->position_levels)->level_title }}</option>
                                                                @foreach ($position_levels as $position_level)
                                                                    <option value="{{ $position_level->id }}">{{ $position_level->level_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                                                <button id="submit_button2" type="submit" class="btn btn-success" >Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Update Department Modal --}}
                            <!-- Delete Department Modal -->
                            <div class="modal fade " id="delete_position_{{ $position->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin_delete_position',['id'=>$position->id]) }}" method="PUT" onsubmit="submitButtonDisabled()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete position</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid text-start">
                                                    <div class="row mt-2 mb-3" >
                                                        <div class="col">
                                                            <label class="mb-3"><h6 class="profile-title">Are you sure you want to delete this?</h6></label>
                                                            <p class="card-desc"><b>{{ $position->position_title }}</b> </p>
                                                            {{-- <p class="card-desc">Sub-department: {{ $position->subdepartments->sub_department_title }}</p>
                                                            <p class="card-desc">Department: {{ $position->subdepartments->departments->department_title }}</p> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outlined" data-bs-dismiss="modal">Discard</button>
                                                <button id="submit_button2" type="submit" class="btn btn-danger" >Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {{-- End Delete Department Modal --}}
                    @endforeach

                </tbody>
            </table>
            <div class="row">
                <div class="col">
                    <div class="mt-2 mb-5">
                        <ul class="pagination justify-content-center align-items-center">
                            {{-- {!! $positions->links('pagination::bootstrap-5') !!} --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END LIST --}}

@endsection
