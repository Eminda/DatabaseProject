/**
 * Created by acer on 11/12/2016.
 */

//var nicE = document.getElementById("nic");
//var nameE = document.getElementById("name");
//var emailE = document.getElementById("email");

function checkPassword(){
    if($('#password').val()==$('#ReEnterpassword').val()){
        $('#passwordCorrect').show();
    }else{
        $('#passwordCorrect').hide();
    }
    $('#passwordCheck').html("");
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
    var emailE = document.getElementById("email");
    var email=$('#email').val();
    if(email.length>100){
        emailE.className += " alert-danger";
    }else{
        emailE.className = "form-control";
    }
}
function isNameOk(){
    var name=$('#name').val();
    var nameE = document.getElementById("name");
    if(!isNaN() || name.length==0) {
        nameE.className += " alert-danger";
        return false;
    }else if(name.length>100){
        console.log(isNaN(name));
        $('#nameCheck').html("Maximum Length Exceed!!");
        return false;
    }else{
        nameE.className = "form-control";
        $('#nameCheck').html("")
    }
    return true;
}

function isUserNameOk(){
    var name=$('#userName').val();
    var nameE = document.getElementById("userName");
    if(!isNaN() || name.length==0) {
        nameE.className += " alert-danger";
        return false;
    }else if(name.length>100){
        console.log(isNaN(name));
        $('#userNameCheck').html("Maximum Length Exceed!!");
        return false;
    }else{
        $('#userNameCheck').html("");
        nameE.className = "form-control";
        userNames.forEach(checkWithPreUsers);


    }
    return true;
}
function checkWithPreUsers(user){
    if($('#userName').val()==user){
        $('#userNameCheck').html("This name is currently in use");
        var nameE = document.getElementById("userName");
        nameE.className += " alert-danger";
    }
}

function isNicOk(){
    var nic=$('#nic').val();
    var nicE = document.getElementById("nic");
    var b=true;
    if(nic.length==0) {
        nicE.className += " alert-danger";
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
        nicE.className="form-control";
    }
    return b;
}
function submitData() {
    var b=isNameOk() & isEmailOk() & isNicOk() & isPasswordOk() & isUserNameOk();
    console.log(b);
    return b;
}