<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/13/2016
 * Time: 11:55 PM
 */

function redirect_to($url){
    header("Location: {$url}");
    exit;
}
function message($message){
    echo "<script type='text/javascript'>alert(\"{$message}\")</script>";
}
function getJourneyDuration($duration){
    $hour=floor($duration/3600);
    $min=floor(($duration%3600)/60);
    if($min==0){
        $min="";
    }else{
        $min=$min." Mins";
    }
    return "".$hour." Hours ".$min;
}
function getTimeFromStringTimeStamp($timeStamp){
    list($day,$time)=explode (' ',$timeStamp);
    list($hour,$min,$sec)=explode(':',$time);
    $postFix='';
    if(intval($hour)>12 || (intval($hour)==12 && intval($min)!=0)){
        $postFix=" P.M";
        $hour=intval($hour)-12;
    }else{
        $postFix=" A.M";
    }
    return "".$hour.".".$min.$postFix;
}

?>