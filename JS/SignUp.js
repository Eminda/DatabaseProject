/**
 * Created by acer on 11/12/2016.
 */

function checkPassword(){
    if($('#password').val()==$('#ReEnterpassword').val()){
        $('#passwordCorrect').show();
    }else{
        $('#passwordCorrect').hide();
    }
}
function checkSignOption(){
    console.log($('#yesOpt').is(':checked'));
    if($('#yesOpt').is(':checked')){
        $('#btnSubmit').prop("disabled",false);
    }else{
        $('#btnSubmit').prop("disabled",true);
    }
}
function isPasswordOk(){
    if(!$('#password').val()==$('#ReEnterpassword').val()){
        $('#passwordCheck').html("Passwords doesn't match");
        return false;
    }
    if($('#password').val().length==0){
        $('#passwordCheck').html("You must enter Password");
        return false;
    }
    $('#passwordCheck').html("");
    return true;
}
function isEmailOk() {
    var email=$('#email').val();
    if(email.length==0){
        $('#emailCheck').html("You must Enter Email");
    }else{
        $('#emailCheck').html("");
    }
}
function isNameOk(){
    var name=$('#name').val();
    if(!isNaN() || name.length==0) {
        $('#nameCheck').html("You must Enter a Name");
        return false;
    }else if(name.length>100){
        console.log(isNaN(name));
        $('#nameCheck').html("Maximum Length Exceed!!");
        return false;
    }else{
        $('#nameCheck').html("")
    }
    return true;
}
function isNicOk(){
    var nic=$('#nic').val();
    var b=true;
    if(nic.length==0) {
        $('#nicCheck').html("You must enter NIC");
        b=false;
    }else if(nic != parseInt(nic,10)){
        $('#nicCheck').html("Invalid NIC");
        b= false;
    }
    if(nic.length!=9){
        b=false;
        $('#nicCheck').html("Nic must contain 9 digits");
    }
    if(b){
        $('#nicCheck').html("");
    }
    return b;
}
function submitData() {
    var b=isNameOk() & isEmailOk() & isNicOk() & isPasswordOk();
    console.log(b);
    return b!=0;
}