function onClickApprove(){
    // document.getElementById('form_submit').disabled = true;
    document.getElementById('loading_spinner_approve').style.display="block";
    document.getElementById('table_container').style.opacity = "0.2";
}

function onClickLeaveApplySpinnerShow(){
    document.getElementById('loading_spinner').style.display="block";
}

function onFormSubmit(){
    document.getElementById('loading_spinner_1').style.display="block";
    document.getElementById('submit_button1').classList.add('disabled');
    document.getElementById('form_to_submit').style.opacity = "0.3";
}