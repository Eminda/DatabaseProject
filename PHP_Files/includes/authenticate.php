<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/14/2016
 * Time: 12:16 AM
 */
session_start();
if(isset($_SESSION["userID"])){
    alert("inside1");
    redirect_to("Main.php");
}
if(isset($_GET["logout"]) && $_GET["logout"]==1){
    alert("inside2");
    redirect_to("login.php");
}
if(isset($_GET["failed"]) && $_GET["failed"]==1){
    alert("submited");
    echo ("<script type='text/javascript'>alert('Invalid username password combination!')</script>");

}


if(isset($_POST["submitbtn"])){
    alert("submited");
    $username=$_POST["name"];
    $password = $_POST["pass"];
    alert($_POST["name"]+" "+$_POST["pass"]);
    $user;
    if(!check_Authantication($username,$password)){
       // redirect_to("login.php?failed=1");
    }
    if($_POST["userType"]==1){
        setAdmin();
        $_SESSION["AdminID"]=$_POST["name"];
    }
    if($_POST["userType"]==2){
        alert("owner");
        //setOwner();
        if(!$user=CheckUser($username,$password)) {
          //  redirect_to("login.php?failed=1");
        }
        $_SESSION["userID"]=$user["ID"];
        $_SESSION["Name"]=$user["Name"];
        $_SESSION["buses"]=getOwnerBusses($_SESSION["userID"]);

    }
    if($_POST["userType"]==3){
        setConductor();
        $_SESSION["BusConductor"]=$_POST["name"];
        redirect_to("more.php?Num={$_POST["name"]}");
    }


    $bus=array();


    redirect_to("Main.php");
}
alert("leaving again")

?>
