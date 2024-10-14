<div class="card w-100 p-2 rounded-0">
    <div class="card-body row">
        <div class="">
            <div class="row">
                <h5><strong>{{ $area_of_assignment->location_address }}</strong></h5>
            </div>
            <div class="row">
                <p class="card-desc">Employees: {{ $employees_count ?? 0 }}</p>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <a href="{{ route('admin_areaofassignemnts_profile',['id'=>$area_of_assignment->id]) }}" class="btn btn-sm btn-primary text-center ps-3 pe-3 rounded-0">View</a>
                    <a href="#Update_department" class="btn btn-sm btn-primary ps-3 pe-3 rounded-0" data-bs-toggle="modal" data-bs-target="#update_area_of_assignment{{ $area_of_assignment->id }}">
                        Update
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
