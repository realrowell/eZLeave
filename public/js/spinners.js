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

function onFormSubmit_1(){
    document.getElementById('loading_spinner_2').style.display="block";
    document.getElementById('submit_button_2').classList.add('disabled');
    document.getElementById('form_to_submit_2').style.opacity = "0.3";
}
var toastElList = [].slice.call(document.querySelectorAll('.toast'))
var toastList = toastElList.map(function (toastEl) {
  return new bootstrap.Toast(toastEl, option)
})
