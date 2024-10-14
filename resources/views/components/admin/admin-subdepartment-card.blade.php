<div class="card w-100 p-2 rounded-0">
    <div class="card-body row">
        <div class="">
            <div class="row">
                <h5><strong>{{ $subdepartment->sub_department_title }}</strong></h5>
            </div>
            <div class="row">
                <p class="card-desc">Active Employees: {{ $employees_count ?? 0 }}</p>
                <p class="card-desc">Parent department: {{ $subdepartment->departments?->department_title }}</p>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <a href="#" class="btn btn-sm btn-primary text-center ps-3 pe-3 rounded-0">View</a>
                    <a href="#update_subdepartment" class="btn btn-sm btn-primary ps-3 pe-3 rounded-0" data-bs-toggle="modal" data-bs-target="#update_subdepartment{{ $subdepartment->id }}">Update</a>
                </div>
            </div>
        </div>
    </div>
</div>
