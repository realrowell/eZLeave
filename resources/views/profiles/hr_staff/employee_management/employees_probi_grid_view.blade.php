@extends('profiles.hr_staff.employee_management.employees_probi')
@section('grid_active','bg-selected-warning')
@section('submenu_all','text-dark')
@section('submenu_regular','text-dark')
@section('submenu_proba','bg-selected-warning text-light')
@section('sub-content')


<div class="row g-4 justify-content-sm-start justify-content-md-start justify-content-lg-start">
    {{-- CARDS --}}
        @forelse ($users as $user)
            <div class="col-lg-4 col-md-6 col-sm-10">
                <x-hrstaff.hr-employee-card
                    :userId="$user->id"
                >
                </x-hrstaff.hr-employee-card>
            </div>
        @empty
            <div class="row align-items-center justify-content-center mt-5">
                <div class="col text-center">
                    <x-errors.no-employee-search-found>
                    </x-errors.no-employee-search-found>
                </div>
            </div>
        @endforelse
    {{-- END CARDS --}}
</div>
<div class="row">
    <div class="col">
        <div class="mt-5">
            <ul class="pagination justify-content-center align-items-center">
                {!! $users->links('pagination::bootstrap-5') !!}
            </ul>
        </div>
    </div>
</div>


@endsection
