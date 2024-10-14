<div class="card w-100 p-2 rounded-0">
    <div class="card-body row">
        <div class="row">
            <h5><strong>{{ $position->position_description }}</strong></h5>
        </div>
        <div class="row">
            <p class="card-desc">Position level: {{ $position_level }}</p>
            <p class="card-desc">Sub-department: {{ $position->subdepartments->sub_department_title }}</p>
            <p class="card-desc">Department: {{ $position->subdepartments->departments->department_title }}</p>
        </div>
        <div class="row mt-2">
            <div class="col">
                <a href="#View_position" class="btn-sm btn-primary text-center ps-3 pe-3 rounded-0">View</a>
                <a href="#Update_position" class="btn-sm btn-primary ps-3 pe-3 rounded-0" data-bs-toggle="modal" data-bs-target="#update_position{{ $position->id }}" title="Update">Update</a>
            </div>
        </div>
    </div>
</div>
