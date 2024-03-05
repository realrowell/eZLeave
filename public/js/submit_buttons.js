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
    if(startdate.getTime() == enddate.getTime()){
        document.getElementById('datelabel').style.display="block";
        document.getElementById('duration_input').value = 1;
        if(document.getElementById('partOfDay_check').checked){
            document.getElementById('duration_input').value = 0.5;
        }
    }
    else if(startdate.getTime() > enddate.getTime()) {
        alert("Start date is later than the End date");
        document.getElementById('datetime_enddate').value="";
        document.getElementById('duration_input').value = 0;
    }
    else{
        document.getElementById('partOfDay_check').checked = false;
        document.getElementById('datelabel').style.display="none";
        document.getElementById('duration_input').value = Math.floor((enddate - startdate)/(1000*60*60*24)+1);
    }
}

function showLeaveDuration_onUpdate(){
    let startdate = new Date(document.getElementById("datetime_startdate_update").value); 
    let enddate = new Date(document.getElementById("datetime_enddate_update").value);
    // window.alert( Math.floor((startdate - enddate)/(1000*60*60*24)));
    if(startdate.getTime() == enddate.getTime()){
        document.getElementById('datelabel_update').style.display="block";
        document.getElementById('duration_input_update').value = 1;
        if(document.getElementById('partOfDay_check_update').checked){
            document.getElementById('duration_input_update').value = 0.5;
        }
    }
    else if(startdate.getTime() > enddate.getTime()) {
        alert("Start date is later than the End date");
        document.getElementById('datetime_enddate_update').value="";
        document.getElementById('duration_input_update').value = 0;
    }
    else{
        document.getElementById('partOfDay_check_update').checked = false;
        document.getElementById('datelabel_update').style.display="none";
        document.getElementById('duration_input_update').value = Math.floor((enddate - startdate)/(1000*60*60*24)+1);
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

function onKeyUpAddress(){
    document.getElementById('address_city').classList.add('required');
    document.getElementById('address_province').classList.add('required');
    document.getElementById('address_region').classList.add('required');
}
