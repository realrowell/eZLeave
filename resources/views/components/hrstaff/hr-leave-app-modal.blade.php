<div class="modal fade" id="ApplyLeaveModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border border-end-0 border-top-0 border-bottom-0 border-warning border-5 rounded-0">
            <form action="{{ route('create_leaveapplication') }}" method="POST" onsubmit="return submitButtonDisabled()" enctype="multipart/form-data" id="form_submit">
                @csrf
                @method('POST')
                <div class="modal-body" id="form_submit">
                    <div class="container-fluid text-start">
                        <div class="row">
                            <div class="col ">
                                <div class="row pt-3 pb-2">
                                    <div class="col-9">
                                        <h5 class="modal-title" id="staticBackdropLabel">File a Leave Application</h5>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="employee">
                                            <h6 class="">Employee</h6>
                                        </label>
                                        <select class="form-select" id="employee" name="employee" required>
                                            <option selected disabled value=""></option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->employees->id }}">{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col placeholder-glow">
                                        <label class="" for="leavetype">
                                            <h6 class="">
                                                Leave Type
                                                <div class="spinner-border text-primary spinner-border-sm d-none" id="spinner_leavetype" role="status" >
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </h6>
                                        </label>
                                        <select class="form-select " id="leavetype" name="leavetype" required>
                                            <option selected disabled value=""></option>
                                            @foreach ($leavetypes as $leavetype)
                                                <option value="{{ $leavetype->id }}">{{ $leavetype->leave_type_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="startdate">
                                            <h6>Start date</h6>
                                        </label>
                                        <input type="date" class="form-control" id="datetime_startdate" name="startdate" placeholder="" required onchange="showLeaveDurationHR()">
                                    </div>
                                    <div class="col-6">
                                        <label for="enddate">
                                            <h6>End date</h6>
                                        </label>
                                        <input type="date" class="form-control" id="datetime_enddate" name="enddate" placeholder="" onchange="showLeaveDurationHR()">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col" id="datelabel_start_am" style="display: none;">
                                        <div class="form-check">
                                            <label for="start_am_check" class="form-check-label" >Morning</label>
                                            <input type="checkbox" class="form-check-input" id="start_am_check" name="start_am_check" value="1" onchange="showLeaveDurationHR()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_start_pm" style="display: none;">
                                        <div class="form-check">
                                            <label for="start_pm_check" class="form-check-label" >Afternoon</label>
                                            <input type="checkbox" class="form-check-input" id="start_pm_check" name="start_pm_check" value="1" onchange="showLeaveDurationHR()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_end_am" style="display: none;">
                                        <div class="form-check">
                                            <label for="end_am_check" class="form-check-label" >Morning</label>
                                            <input type="checkbox" class="form-check-input" id="end_am_check" name="end_am_check" value="1" onchange="showLeaveDurationHR()">
                                        </div>
                                    </div>
                                    <div class="col " id="datelabel_end_pm" style="display: none;">
                                        <div class="form-check">
                                            <label for="end_pm_check" class="form-check-label" >Afternoon</label>
                                            <input type="checkbox" class="form-check-input" id="end_pm_check" name="end_pm_check" value="1" onchange="showLeaveDurationHR()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col placeholder-glow">
                                        <div class="spinner-border text-primary spinner-border-sm d-none" id="spinner_duration" role="status" >
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <label for="">Duration (days)</label>
                                        <input type="text" name="duration" placeholder="" id="leave_duration" class="form-control" disabled/>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="attachment">
                                            <h6 class="">Attachment (optional)</h6>
                                        </label>
                                        <input type="file" accept="image/*,.docx,.doc,.pdf" capture="user" class="form-control" id="attachment" name="attachment">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label class="" for="reason">
                                            <h6 class="">Reason / Note (optional)</h6>
                                        </label>
                                        <textarea class="form-control" id="reason" name="reason" rows="5" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="form_submit" style="opacity: 1">
                    <div class="container-fluid text-end">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-transparent" data-bs-dismiss="modal" >Discard</button>
                                <div class="spinner-border text-primary" id="loading_spinner1" role="status" style="display: none;">
                                    <span class="visually-hidden" >Loading...</span>
                                </div>
                                <button id="submit_button1" type="submit" class="btn btn-success rounded-0" >Apply Leave</button>
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
        $('#employee').on('change',function(){
            let id = $(this).val();
            console.log(id);
            $('#leavetype').empty();
            $('#leavetype').addClass('placeholder');
            $('#spinner_leavetype').removeClass('d-none');
            $('#leavetype').append('<option value="0" disabled selected >Processing...</option>');
            $.ajax({
                type: 'GET',
                url: '/create_leave/getLeaveType/'+id,
                success: function (response){
                    var response = JSON.parse(response);
                    // console.log(response);
                    $('#leavetype').empty();
                    $('#leavetype').removeClass('placeholder');
                    $('#spinner_leavetype').addClass('d-none');
                    $('#leavetype').append('<option value="0" disabled selected>*Select Leave type</option>');
                    if($.trim(response) == ''){
                        $('#leavetype').append(`<option value="" disabled>No Leave Credits Available</option>`);
                    }
                    response.forEach(element => {
                        $('#leavetype').append(`<option value="${element.leave_type_id}">${element.leavetypes.leave_type_title}: ${element['leave_days_credit']}</option>`);
                    });
                }
            });
        });
    });
    $(document).ready(function(){
        $('#datetime_startdate, #datetime_enddate, #start_am_check, #start_pm_check, #end_am_check, #end_pm_check').on('change',function(){
            var start_date = $('#datetime_startdate').val();
            var end_date = $('#datetime_enddate').val();
            var start_am = $('#start_am_check').is(':checked');
            var start_pm = $('#start_pm_check').is(':checked');
            var end_am = $('#end_am_check').is(':checked');
            var end_pm = $('#end_pm_check').is(':checked');

            if(end_date == null || end_date == ""){
                end_date = start_date;
            }
            if(start_date == end_date){
                start_pm = false;
                end_am = false;
                $('#start_pm_check').prop( "checked", false );
                $('#end_am_check').prop( "checked", false );
            }
            else if(start_date != end_date){
                start_am = false;
                end_pm = false;
                $('#start_am_check').prop( "checked", false );
                $('#end_pm_check').prop( "checked", false );
            }
            console.log(start_am+" / "+start_pm+" / "+end_am+" / "+end_pm);

            $('#leave_duration').addClass('placeholder');
            $('#spinner_duration').removeClass('d-none');
            console.log(start_date+" / "+end_date);
            $.ajax({
                type: 'GET',
                url: '/employee/leave-app/get-duration/'+start_date+'/'+end_date+'/'+start_am+'/'+start_pm+'/'+end_am+'/'+end_pm,
                success: function (response){
                    var response = JSON.parse(response);
                    console.log(response);
                    $('#leave_duration').empty();
                    $('#leave_duration').removeClass('placeholder');
                    $('#spinner_duration').addClass('d-none');
                    $('#leave_duration').val(response);
                }
            });
        });
    });
</script>
