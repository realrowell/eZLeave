function onClickApprove(){
    // document.getElementById('form_submit').disabled = true;
    document.getElementById('loading_spinner_approve').style.display="block";
    document.getElementById('table_container').style.opacity = "0.2";
    document.getElementById('submit_button1').classList.add('disabled');
}

function onClickApplyLeave(){
    document.getElementById('loading_spinner_apply').classList.remove('d-none');
    document.getElementById('form_container_onApply').style.opacity = "0.2";
    document.getElementById('btn_apply').classList.add('disabled');
    document.getElementById('btn_close_onApply').classList.add('disabled');
    document.getElementById('btn_modal_x_onApply').classList.add('disabled');
}

function onClickUpdateLeaveId(id){
    document.getElementById('loading_spinner_update'+id).classList.remove('d-none');
    document.getElementById('form_container_onUpdate'+id).style.opacity = "0.2";
    document.getElementById('btn_update'+id).classList.add('disabled');
    document.getElementById('btn_close_onUpdate'+id).classList.add('disabled');
    document.getElementById('btn_modal_x_onUpdate'+id).classList.add('disabled');
}

function onClickApproveId(id){
    document.getElementById('loading_spinner_approve'+id).classList.remove('d-none');
    document.getElementById('form_container'+id).style.opacity = "0.2";
    document.getElementById('btn_submit'+id).classList.add('disabled');
    document.getElementById('btn_close'+id).classList.add('disabled');
    document.getElementById('btn_modal_x'+id).classList.add('disabled');
}

function onClickCancelId(id){
    document.getElementById('loading_spinner_cancel'+id).classList.remove('d-none');
    document.getElementById('form_container_onCancel'+id).style.opacity = "0.2";
    document.getElementById('btn_cancel'+id).classList.add('disabled');
    document.getElementById('btn_close_onCancel'+id).classList.add('disabled');
    document.getElementById('btn_modal_x_onCancel'+id).classList.add('disabled');
}

function onClickRejectId(id){
    document.getElementById('loading_spinner_reject'+id).classList.remove('d-none');
    document.getElementById('form_container_onReject'+id).style.opacity = "0.2";
    document.getElementById('btn_reject'+id).classList.add('disabled');
    document.getElementById('btn_close_onReject'+id).classList.add('disabled');
    document.getElementById('btn_modal_x_onReject'+id).classList.add('disabled');
}

function onClickLeaveApplySpinnerShow(){
    document.getElementById('loading_spinner').style.display="block";
}

function onFormSubmit(){
    document.getElementById('loading_spinner_1').style.display="block";
    document.getElementById('submit_button1').classList.add('disabled');
    document.getElementById('submit_button2').classList.add('disabled');
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
