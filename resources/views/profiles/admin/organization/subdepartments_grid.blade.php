@extends('profiles.admin.organization.subdepartments')
@section('grid_active','bg-selected-warning')
@section('sub-content')

<div class="row mb-3">
    <div class="col">
        <div class="card text-center rounded-0">
            <div class="card-body">
                <p class="card-desc fs-1">{{ $subdepartment_count }}</p>
                <div class="custom-h-25 custom-bg-primary custom-bg-primary-hover transition-1 p-1 text-light fs-6">
                    Total Sub-departments
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-center rounded-0">
            <div class="card-body">
                <p class="card-desc fs-1">{{ $subdepartment_active_count }}</p>
                <div class="custom-h-25 custom-bg-primary custom-bg-primary-hover transition-1 p-1 text-light fs-6">
                    Total Active Sub-departments
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($subdepartments as $subdepartment)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <x-admin.admin-subdepartment-card
            :subdepartmentId="$subdepartment->id">
            </x-admin.admin-subdepartment-card>
        </div>
        <!-- Update SubDepartment Modal -->
            <x-admin.admin-subdepartment-update-modal
            :subdepartmentId="$subdepartment->id">
            </x-admin.admin-subdepartment-update-modal>
        {{-- End Update SubDepartment Modal --}}
    @endforeach
    {{-- END CARDS --}}
    <div class="row">
        <div class="col">
            <div class="mt-2 mb-5">
                <ul class="pagination justify-content-center align-items-center">
                    {!! $subdepartments->links('pagination::bootstrap-5') !!}
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
