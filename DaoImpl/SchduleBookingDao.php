<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 02:18 PM
 */
include_once '../Modal/PhpClasses.php';
class SchduleBookingDao
{
    public function getScheduleData($conn,$scheduleID){
        $sql="select RegNumber,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance from BookingSchedule where ScheduleID=?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_Param('s', $scheduleID);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        while ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($scheduleID,$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance']);
        }

        $stmt->free_result();
        return $booking;

    }
}