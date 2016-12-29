<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/7/2016
 * Time: 8:53 PM
 */

define("SERVER","localhost");
define("USER","Admin");
define("PASS","123");
define("DATABASE","bus");
$user="root";
$pass=null;
function setConductor(){
    $user="Condector";
    $pass="123";
}
function setAdmin(){
    $user="Admin";
    $pass="123";
}
function setOwner(){
    $user="Owner";
    $pass="123";
}

?>