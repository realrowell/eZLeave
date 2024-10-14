@extends('profiles.admin.organization.departments')
@section('grid_active','bg-selected-warning')
@section('sub-content')

<div class="row mb-3">
    <div class="col">
        <div class="card text-center rounded-0">
            <div class="card-body">
                <p class="card-desc fs-1">{{ $department_count }}</p>
                <div class="custom-h-25 custom-bg-primary custom-bg-primary-hover transition-1 p-1 text-light fs-6">
                    Total Departments
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-center rounded-0">
            <div class="card-body">
                <p class="card-desc fs-1">{{ $department_active_count }}</p>
                <div class="custom-h-25 custom-bg-primary custom-bg-primary-hover transition-1 p-1 text-light fs-6">
                    Total Active Departments
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($departments as $department)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <x-admin.admin-department-card
                :departmentId="$department->id">
            </x-admin.admin-department-card>
        </div>
        <!-- Update Department Modal -->
            <x-admin.admin-department-update-modal
                :departmentId="$department->id">
            </x-admin.admin-department-update-modal>
        {{-- End Update Department Modal --}}
    @endforeach
    {{-- END CARDS --}}

</div>
@endsection
