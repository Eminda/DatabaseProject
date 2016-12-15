<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:01 PM
 */
class BookingSeat
{
    public  function insert($conn,$ticketNo,$seats){
        $sql="INSERT INTO BookingSeat VALUES (:ticket,:seatNo)";
        $stmt = $conn->prepare($sql);

        foreach ($seats as &$seat){
            $stmt->bindParam(':ticket', $ticketNo);
            $stmt->bindParam('seatNo',$seat);
            $stmt->execute();
        }
    }
}