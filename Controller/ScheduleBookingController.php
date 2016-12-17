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
include_once '../DaoImpl/BookingDao.php';
include_once '../DaoImpl/BookingSeatDao.php';

class ScheduleBookingController
{
    private static $scheduleBooking;
    private static $routeLocation;
    private static $admin;
    private static $booking;
    private static $bookingSeat;

    private static function init()
    {
        if (ScheduleBookingController::$scheduleBooking == null) {
            ScheduleBookingController::$scheduleBooking = new SchduleBookingDao();
            ScheduleBookingController::$routeLocation = new RouteLocationDao();
            ScheduleBookingController::$admin = new AdminDao();
            ScheduleBookingController::$booking = new BookingDao();
            ScheduleBookingController::$bookingSeat = new BookingSeatDao();
        }

    }

    public static function getBookingScheduleFromScheduleID($conn, $scheduleID)
    {
        self::init();
        echo "ghj" . gettype(ScheduleBookingController::$scheduleBooking);
        return ScheduleBookingController::$scheduleBooking->getScheduleData($conn, $scheduleID);
    }

    public static function getRouteLocation($conn, $routeID, $fromTownID, $toTownID)
    {
        self::init();
        return ScheduleBookingController::$routeLocation->getRouteLocation($conn, $routeID, $fromTownID, $toTownID);
    }

    public static function getCostPerKm($conn)
    {
        self::init();
        return ScheduleBookingController::$admin->getCostPerKM($conn);
    }

    public static function createBooking($conn, $booking)
    {
        self::init();
        ScheduleBookingController::$booking->lockBookingTable($conn);
        try {
            $lastTicket = substr(ScheduleBookingController::$booking->getLatestTicket($conn), 1);
            mysqli_autocommit($conn, FALSE);
            $conn->begin_transaction();
            $newTicket = base_convert(intval(base_convert($lastTicket, 16, 10)) + 1, 10, 16);
            echo "aaaaaqqqqqqqqqqqqqqqqqqqqq".$newTicket."ddddddddddd".$lastTicket;
            $newTicket = "T" . str_pad($newTicket, 9, "0", STR_PAD_LEFT);
            $booking->setTicketNo($newTicket);
            ScheduleBookingController::$booking->insert($conn, $booking);
            ScheduleBookingController::$booking->unlockBookingTable($conn);
            $seats = $booking->getSeats();
            ScheduleBookingController::$bookingSeat->insert($conn, $newTicket, $seats);

                mysqli_commit($conn);


        } catch (Exception $e) {
            echo $e;
            mysqli_rollback($conn);
        } finally {

            mysqli_autocommit($conn, TRUE);

            ScheduleBookingController::$booking->unlockBookingTable($conn);
        }
    }

}

?>