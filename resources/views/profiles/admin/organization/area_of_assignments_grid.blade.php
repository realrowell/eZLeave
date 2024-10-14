@extends('profiles.admin.organization.area_of_assignments')
@section('grid_active','bg-selected-warning')
@section('sub-content')
    {{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($area_of_assignments as $area_of_assignment)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <x-admin.admin-aoa-card
            :areaofassignmentId="$area_of_assignment->id">
            </x-admin.admin-aoa-card>
        </div>
        <!-- Update Department Modal -->
            <x-admin.admin-aoa-update-modal
            :areaofassignmentId="$area_of_assignment->id">
            </x-admin.admin-aoa-update-modal>
        {{-- End Update Department Modal --}}
    @endforeach

    {{-- END CARDS --}}

</div>
@endsection
