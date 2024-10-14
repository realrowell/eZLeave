<div class="card w-100 p-2 rounded-0">
    <div class="card-body row">
        <div class="">
            <div class="row">
                <h5><strong>{{ $department_name }}</strong></h5>
            </div>
            <div class="row">
                <p class="card-desc">Active Employees: {{ $employees_count ?? 0 }} </p>
                <p class="card-desc">Sub-departments: {{ $subdepartment_count }} </p>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <a href="#" class="btn btn-sm btn-primary text-center rounded-0 ps-3 pe-3">View</a>
                    <a href="#Update_department" class="btn btn-sm btn-primary border border-primary rounded-0 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#update_department{{ $department->id }}">
                        Update
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
