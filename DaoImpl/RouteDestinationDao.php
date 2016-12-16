<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 09:58 PM
 */
class RouteDestinationDao
{
    public function getJourneyStops($routeID,$fromTown,$toTown)
    {
        $sql="select TownID";
        $stmt = $conn->prepare($sql);

        $stmt->bind_Param('s', $scheduleID);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        while ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($scheduleID,$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration']);
        }

        $stmt->free_result();
        return $booking;
    }
}