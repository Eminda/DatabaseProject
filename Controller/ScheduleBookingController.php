<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 02:16 PM
 */
include_once '../DaoImpl/SchduleBookingDao.php';
include_once '../DaoImpl/RouteLocationDao.php';
include_once '../DaoImpl/AdminDao.php';
class ScheduleBookingController
{
    private static $scheduleBooking;
    private static $routeLocation;
    private static $admin;

    private static function init()
    {
        if(ScheduleBookingController::$scheduleBooking==null){
            ScheduleBookingController::$scheduleBooking=new SchduleBookingDao();
            ScheduleBookingController::$routeLocation=new RouteLocationDao();
            ScheduleBookingController::$admin=new AdminDao();
        }

    }

    public static function getBookingScheduleFromScheduleID($conn,$scheduleID)
    {
        self::init();
        return ScheduleBookingController::$scheduleBooking->getScheduleData($conn,$scheduleID);
    }
    public static function getRouteLocation($conn,$routeID,$fromTownID,$toTownID){
        self::init();
        return ScheduleBookingController::$routeLocation->getRouteLocation($conn,$routeID,$fromTownID,$toTownID);
    }
    public static function getCostPerKm($conn){
        self::init();
        return ScheduleBookingController::$admin->getCostPerKM($conn);
    }
}
?>