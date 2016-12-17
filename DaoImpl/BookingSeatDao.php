<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:01 PM
 */
require_once '../Modal/PhpClasses.php';
class BookingSeatDao
{
    public  function insert($conn,$ticketNo,$seats){

        $sql="INSERT INTO BookingSeats VALUES (?,?)";
        $stmt = $conn->prepare($sql);

        foreach ($seats as &$seat){
            $stmt->bind_Param('sd', $ticketNo,$seat);
            $stmt->execute();
        }
        if(mysqli_error($conn)!=null){
            throw new Exception('My SQl Error');
        };
    }
}