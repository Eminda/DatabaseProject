<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 02:16 PM
 */
include '../DaoImpl/SchduleBookingDao.php';
class ScheduleBookingController
{
    private static $scheduleBooking;

    private static function init()
    {
        if(ScheduleBookingController::$scheduleBooking==null){
            ScheduleBookingController::$scheduleBooking=new SchduleBookingDao();
        }
    }

    public static function getBookingScheduleFromScheduleID($conn,$scheduleID)
    {
        self::$scheduleBooking=new SchduleBookingDao();
        return ScheduleBookingController::$scheduleBooking->getScheduleData($conn,$scheduleID);
    }
}
?>