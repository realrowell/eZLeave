@extends('profiles.admin.organization.positions')
@section('grid_active','bg-selected-warning')
@section('sub-content')

<div class="row mb-3">
    <div class="col">
        <div class="card text-center rounded-0">
            <div class="card-body">
                <p class="card-desc fs-1">{{ $position_count }}</p>
                <div class="custom-h-25 custom-bg-primary custom-bg-primary-hover transition-1 p-1 text-light fs-6">
                    Total Positions
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-center rounded-0">
            <div class="card-body">
                <p class="card-desc fs-1">{{ $position_active_count }}</p>
                <div class="custom-h-25 custom-bg-primary custom-bg-primary-hover transition-1 p-1 text-light fs-6">
                    Total Active Positions
                </div>
            </div>
        </div>
    </div>
</div>

{{-- GRID PROFILE --}}
<div class="row g-4 justify-content-sm-center justify-content-md-start justify-content-lg-start">
    @foreach ($positions as $position)
        <div class="col-lg-4 col-md-6 col-sm-10 d-flex align-items-stretch">
            <x-admin.admin-position-card
            :positionId="$position->id">
            </x-admin.admin-position-card>
        </div>
        <!-- Update Department Modal -->
            <x-admin.admin-position-update-modal
            :positionId="$position->id">
            </x-admin.admin-position-update-modal>
        {{-- End Update Department Modal --}}

    @endforeach
    <div class="row">
        <div class="col">
            <div class="mt-2 mb-5">
                <ul class="pagination justify-content-center align-items-center">
                    {!! $positions->links('pagination::bootstrap-5') !!}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
