// new DataTable('#loginlogs_table');
// new DataTable('#data_table',{
//     pagingType: 'first_last_numbers'
// });
// import Swal from 'sweetalert2/dist/sweetalert2.js';

function submitButtonDisabled(){
    document.getElementById('form_submit').disabled = true;
    document.getElementById('loading_spinner').style.display="block";
    document.getElementById('form_submit').style.opacity = "0.2";
    document.getElementById('submit_button1').classList.add('disabled');
    document.getElementById('submit_button2').classList.add('disabled');
    document.getElementById('submit_button').classList.add('disabled');
    document.getElementById('form_submit').classList.add('disabled');
    document.getElementById('form_submit').disabled = true;
}

function onClickSubmit(){
    document.getElementById("loading_spinner").style.display="block";
    document.getElementById('form_submit').style.opacity = "0.2";
}

function onClickLinkSubmit(){
    document.getElementById('form_submit').disabled = true;
    document.getElementById('loading_spinner').style.display="block";
    document.getElementById('form_submit').style.opacity = "0.2";
}

function onClickUpdateSubmit(){
    // document.getElementById('form_submit_1').disabled = true;
    document.getElementById('loading_spinner_1').style.display="block";
    document.getElementById('form_submit_1').style.opacity = "0.2";
}

function onClickAddSubmit(){
    document.getElementById('form_submit_add').classList.add('disabled');
    document.getElementById('form_submit_add').disabled = true;
    document.getElementById('loading_spinner_add').style.display="block";
    document.getElementById('ApplyLeaveModal').style.opacity = "0.8";
}

function changeClass(){
    document.getElementById('login_submit').classList.add('disabled');
    document.getElementById('login_submit').disabled = true;
    document.getElementById('loading_spinner').style.display="block";
    document.getElementById('email').readOnly=true;
    document.getElementById('password').readOnly=true;
    document.getElementById('card_login_form').style.opacity = "0.9";
}

function showLeaveDuration(){
    let startdate = new Date(document.getElementById("datetime_startdate").value);
    let enddate = new Date(document.getElementById("datetime_enddate").value);
    // window.alert( Math.floor((startdate - enddate)/(1000*60*60*24)));
    const currentDate = new Date();

    if(startdate.getTime() == enddate.getTime()){
        // document.getElementById('datelabel').style.display="block";
        document.getElementById('datelabel_start_am').style.display="block";
        document.getElementById('datelabel_start_pm').style.display="none";
        document.getElementById('datelabel_end_am').style.display="none";
        document.getElementById('datelabel_end_pm').style.display="block";
        if(document.getElementById('start_am_check').checked && document.getElementById('end_pm_check').checked){
            document.getElementById('duration_input').value = 1;
        }
        else if(document.getElementById('start_am_check').checked){
            document.getElementById('duration_input').value = 0.5;
        }
        else if(document.getElementById('end_pm_check').checked){
            document.getElementById('duration_input').value = 0.5;
        }
        else{
            document.getElementById('duration_input').value = 1;
        }
    }
    else if(startdate.getTime() > enddate.getTime()) {
        // alert("Start date is later than the End date");
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "The end date must be later than the start date. Please double-check your selection and ensure that the end date falls after the start date."
        });
        document.getElementById('datetime_enddate').value="";
        document.getElementById('duration_input').value = 0;
    }
    else if(startdate.getTime() < enddate.getTime()){
        document.getElementById('datelabel_start_am').style.display="none";
        document.getElementById('datelabel_start_pm').style.display="block";
        document.getElementById('datelabel_end_am').style.display="block";
        document.getElementById('datelabel_end_pm').style.display="none";
        const duration = Math.floor((enddate - startdate)/(1000*60*60*24)+1);
        document.getElementById('duration_input').value = duration;

        if(document.getElementById('start_pm_check').checked && document.getElementById('end_am_check').checked){
                document.getElementById('duration_input').value = duration-1;
            }
        else if(document.getElementById('start_pm_check').checked){
            document.getElementById('duration_input').value = duration-0.5;
        }
        else if(document.getElementById('end_am_check').checked){
            document.getElementById('duration_input').value = duration-0.5;
        }
        else{
            document.getElementById('duration_input').value = duration;
        }
    }
    else{
        document.getElementById('datelabel_start_am').style.display="none";
        document.getElementById('datelabel_start_pm').style.display="none";
        document.getElementById('datelabel_end_am').style.display="none";
        document.getElementById('datelabel_end_pm').style.display="none";
        // document.getElementById('partOfDay_check').checked = false;
        document.getElementById('datelabel').style.display="none";
        const duration = Math.floor((enddate - startdate)/(1000*60*60*24)+1);

        document.getElementById('duration_input').value = duration;
    }

    if(startdate.getDay() == 6 || startdate.getDay() == 0){
        // document.getElementById("error_startdate").innerHTML = "Start date cannot be a weekend";
        // alert('Start date cannot be a weekend!');
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Start date cannot be a weekend!"
        });
        document.getElementById('datetime_startdate').value="";
        // document.getElementById('datelabel_start_am').style.display="none";
        // document.getElementById('datelabel_start_pm').style.display="none";
        // document.getElementById('datelabel_end_am').style.display="none";
        // document.getElementById('datelabel_end_pm').style.display="none";
    }
    if(enddate.getDay() == 6 || enddate.getDay() == 0){
        // document.getElementById("error_startdate").innerHTML = "Start date cannot be a weekend";
        // alert('End date cannot be a weekend!');
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "End date cannot be a weekend!"
        });
        document.getElementById('datetime_enddate').value="";
        document.getElementById('duration_input').value = 0;
        // document.getElementById('datelabel_start_am').style.display="none";
        // document.getElementById('datelabel_start_pm').style.display="none";
        // document.getElementById('datelabel_end_am').style.display="none";
        // document.getElementById('datelabel_end_pm').style.display="none";
    }

}

function showLeaveDuration_onUpdate(id){
    let startdate = new Date(document.getElementById("startdate_onUpdate"+id).value);
    let enddate = new Date(document.getElementById("enddate_onUpdate"+id).value);
    // window.alert( Math.floor((startdate - enddate)/(1000*60*60*24)));
    const currentDate = new Date();
    console.log(id);

    if(startdate.getTime() == enddate.getTime()){
        // document.getElementById('datelabel').style.display="block";
        document.getElementById('datelabel_start_am').style.display="block";
        document.getElementById('datelabel_start_pm').style.display="none";
        document.getElementById('datelabel_end_am').style.display="none";
        document.getElementById('datelabel_end_pm').style.display="block";
        if(document.getElementById('start_am_check').checked && document.getElementById('end_pm_check').checked){
            document.getElementById('duration_onUpdate'+id).value = 1;
        }
        else if(document.getElementById('start_am_check').checked){
            document.getElementById('duration_onUpdate'+id).value = 0.5;
        }
        else if(document.getElementById('end_pm_check').checked){
            document.getElementById('duration_onUpdate'+id).value = 0.5;
        }
        else{
            document.getElementById('duration_onUpdate'+id).value = 1;
        }
    }
    else if(startdate.getTime() > enddate.getTime()) {
        alert("Start date is later than the End date");
        document.getElementById('datetime_enddate').value="";
        document.getElementById('duration_onUpdate'+id).value = 0;
    }
    else if(startdate.getTime() < enddate.getTime()){
        document.getElementById('datelabel_start_am').style.display="none";
        document.getElementById('datelabel_start_pm').style.display="block";
        document.getElementById('datelabel_end_am').style.display="block";
        document.getElementById('datelabel_end_pm').style.display="none";
        const duration = Math.floor((enddate - startdate)/(1000*60*60*24)+1);
        document.getElementById('duration_onUpdate'+id).value = duration;

        if(document.getElementById('start_pm_check').checked && document.getElementById('end_am_check').checked){
                document.getElementById('duration_onUpdate'+id).value = duration-1;
            }
        else if(document.getElementById('start_pm_check').checked){
            document.getElementById('duration_onUpdate'+id).value = duration-0.5;
        }
        else if(document.getElementById('end_am_check').checked){
            document.getElementById('duration_onUpdate'+id).value = duration-0.5;
        }
        else{
            document.getElementById('duration_onUpdate'+id).value = duration;
        }
    }
    else{
        document.getElementById('datelabel_start_am').style.display="none";
        document.getElementById('datelabel_start_pm').style.display="none";
        document.getElementById('datelabel_end_am').style.display="none";
        document.getElementById('datelabel_end_pm').style.display="none";
        document.getElementById('partOfDay_check').checked = false;
        document.getElementById('datelabel').style.display="none";
        const duration = Math.floor((enddate - startdate)/(1000*60*60*24)+1);

        document.getElementById('duration_onUpdate'+id).value = duration;
    }

    if(startdate.getDay() == 6 || startdate.getDay() == 0){
        // document.getElementById("error_startdate").innerHTML = "Start date cannot be a weekend";
        alert('Start date cannot be a weekend!');
        document.getElementById('datetime_startdate').value="";
        // document.getElementById('datelabel_start_am').style.display="none";
        // document.getElementById('datelabel_start_pm').style.display="none";
        // document.getElementById('datelabel_end_am').style.display="none";
        // document.getElementById('datelabel_end_pm').style.display="none";
    }
    if(enddate.getDay() == 6 || enddate.getDay() == 0){
        // document.getElementById("error_startdate").innerHTML = "Start date cannot be a weekend";
        alert('End date cannot be a weekend!');
        document.getElementById('datetime_enddate').value="";
        document.getElementById('duration_onUpdate'+id).value = 0;
        // document.getElementById('datelabel_start_am').style.display="none";
        // document.getElementById('datelabel_start_pm').style.display="none";
        // document.getElementById('datelabel_end_am').style.display="none";
        // document.getElementById('datelabel_end_pm').style.display="none";
    }
}

function showLeaveDurationHR(){
    let startdate = new Date(document.getElementById("datetime_startdate").value);
    let enddate = new Date(document.getElementById("datetime_enddate").value);
    // window.alert( Math.floor((startdate - enddate)/(1000*60*60*24)));
    const currentDate = new Date();
    if(startdate.getTime() == enddate.getTime()){
        // document.getElementById('datelabel').style.display="block";
        document.getElementById('datelabel_start_am').style.display="block";
        document.getElementById('datelabel_start_pm').style.display="none";
        document.getElementById('datelabel_end_am').style.display="none";
        document.getElementById('datelabel_end_pm').style.display="block";
        if(document.getElementById('start_am_check').checked && document.getElementById('end_pm_check').checked){
            document.getElementById('duration_input').value = 1;
        }
        else if(document.getElementById('start_am_check').checked){
            document.getElementById('duration_input').value = 0.5;
        }
        else if(document.getElementById('end_pm_check').checked){
            document.getElementById('duration_input').value = 0.5;
        }
        else{
            document.getElementById('duration_input').value = 1;
        }
    }
    else if(startdate.getTime() > enddate.getTime()) {
        alert("Start date is later than the End date");
        Swal.fire({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
          });
        document.getElementById('datetime_enddate').value="";
        document.getElementById('duration_input').value = 0;
    }
    else if(startdate.getTime() < enddate.getTime()){
        document.getElementById('datelabel_start_am').style.display="none";
        document.getElementById('datelabel_start_pm').style.display="block";
        document.getElementById('datelabel_end_am').style.display="block";
        document.getElementById('datelabel_end_pm').style.display="none";
        const duration = Math.floor((enddate - startdate)/(1000*60*60*24)+1);
        document.getElementById('duration_input').value = duration;

        if(document.getElementById('start_pm_check').checked && document.getElementById('end_am_check').checked){
                document.getElementById('duration_input').value = duration-1;
            }
        else if(document.getElementById('start_pm_check').checked){
            document.getElementById('duration_input').value = duration-0.5;
        }
        else if(document.getElementById('end_am_check').checked){
            document.getElementById('duration_input').value = duration-0.5;
        }
        else{
            document.getElementById('duration_input').value = duration;
        }
    }
    else{
        document.getElementById('datelabel_start_am').style.display="none";
        document.getElementById('datelabel_start_pm').style.display="none";
        document.getElementById('datelabel_end_am').style.display="none";
        document.getElementById('datelabel_end_pm').style.display="none";
        document.getElementById('partOfDay_check').checked = false;
        document.getElementById('datelabel').style.display="none";
        document.getElementById('duration_input').value = Math.floor((enddate - startdate)/(1000*60*60*24)+1);
    }

}


function showPass(){
    document.getElementById('password').type='text';
    document.getElementById('hide_password').hidden=false;
    document.getElementById('show_password').hidden=true;
}
function hidePass(){
    document.getElementById('password').type='password';
    document.getElementById('hide_password').hidden=true;
    document.getElementById('show_password').hidden=false;
}
function showRePass(){
    document.getElementById('password_confirmation').type='text';
    document.getElementById('hide_repassword').hidden=false;
    document.getElementById('show_repassword').hidden=true;
}
function hideRePass(){
    document.getElementById('password_confirmation').type='password';
    document.getElementById('hide_repassword').hidden=true;
    document.getElementById('show_repassword').hidden=false;
}

function searchBtnEnable(){
    document.getElementById('search_btn').classList.remove('disabled');
}

function submitBtnEnable(id){
    document.getElementById('btn_submit'+id).classList.remove('disabled');
}
function submitBtnEnable_onCancel(id){
    document.getElementById('btn_cancel'+id).classList.remove('disabled');
}
function submitBtnEnable_onReject(id){
    document.getElementById('btn_reject'+id).classList.remove('disabled');
}
function submitBtnEnable_onUpdate(id){
    document.getElementById('btn_update'+id).classList.remove('disabled');
}

function onKeyUpAddress(){
    document.getElementById('address_line_1').required=true;
    document.getElementById('address_city').required=true;
    document.getElementById('address_province').required=true;
    document.getElementById('address_region').required=true;
}

