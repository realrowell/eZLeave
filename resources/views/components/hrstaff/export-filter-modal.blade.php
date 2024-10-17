<div class="modal fade" id="ExportFilterModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('leave.credit.export.wizard') }}" method="GET" >
                @csrf
                <div class="modal-body " id="form_container_onApply">
                    <div class="container-fluid text-start">
                        <div class="row pt-3 pb-3">
                            <div class="col">
                                <div class="row pb-2">
                                    <div class="col-9">
                                        <h5 class="modal-title" id="staticBackdropLabel">Export Filter Wizard</h5>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button type="button" id="btn_modal_x_onApply" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="leavetype1">Leave type</label>
                                        <select name="leavetype" id="leavetype1" class="form-select">
                                            <option value="0">All</option>
                                            @foreach ($leavetypes as $leavetype)
                                                <option value="{{ $leavetype->id }}">{{ $leavetype->leave_type_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="empstatus">Employment Status</label>
                                        <select name="employment_status" id="empstatus" class="form-select">
                                            <option value="0">All</option>
                                            @foreach ($employment_statuses as $employment_status)
                                                <option value="{{ $employment_status->id }}">{{ $employment_status->employment_status_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col placeholder-glow">
                                        <label for="department">Department</label>
                                        <div class="spinner-border text-primary spinner-border-sm d-none" id="spinner_department" role="status" >
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <select name="department" id="department" class="form-select">
                                            <option value="0">All</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->department_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col placeholder-glow">
                                        <label for="subdepartment">Sub-department</label>
                                        <div class="spinner-border text-primary spinner-border-sm d-none" id="spinner_subdepartment" role="status" >
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <select name="subdepartment" id="subdepartment" class="form-select">
                                            <option value="">All</option>
                                            @foreach ($subdepartments as $subdepartment)
                                                <option value="{{ $subdepartment->id }}">{{ $subdepartment->sub_department_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="" for="fiscalyear">
                                                Fiscal Year
                                            </label>
                                            <select class="form-select " id="fiscalyear" name="fiscalyear" required>
                                                <option selected value="{{ $current_fiscal_year->id }}">{{ $current_fiscal_year->fiscal_year_title }}</option>
                                                @foreach ($fiscal_years as $fiscal_year)
                                                    @if ($fiscal_year->id != $current_fiscal_year->id)
                                                        <option value="{{ $fiscal_year->id }}">{{ $fiscal_year->fiscal_year_title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="btn btn-transparent ps-3 pe-3" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary rounded-0 ps-3 pe-3">
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#department').on('change',function(){
            let id = $(this).val();
            $('#subdepartment').empty();
            $('#subdepartment').addClass('placeholder');
            $('#spinner_subdepartment').removeClass('d-none');
            $('#subdepartment').append('<option value="0" disabled selected >Processing...</option>');
            $.ajax({
                type: 'GET',
                url: '/addAccount/getSubdepartment/'+id,
                success: function (response){
                    var response = JSON.parse(response);
                    console.log(response);
                    $('#subdepartment').empty();
                    $('#subdepartment').removeClass('placeholder');
                    $('#spinner_subdepartment').addClass('d-none');
                    $('#subdepartment').append('<option value="0" selected> All </option>');
                    response.forEach(element => {
                        $('#subdepartment').append(`<option value="${element['id']}">${element['sub_department_title']}</option>`);
                    });
                }
            });
        });
    });
</script>
