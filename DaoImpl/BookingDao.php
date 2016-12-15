<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:00 PM
 */
require '../Modal/PhpClasses.php';
class BookingDao
{
    const VALID_STATE="Valid";
    const REFUND_STATE="Refunded";

    public function insert($conn,$booking){
        $sql="INSERT INTO Booking(TicketNo,ScheduleID,CustomerName,Nic,Email,Payment,FromTown,ToTown) VALUES (:ticket,:scheduleID,:customerName,:nic,:email,:payment,:fromTown,:toTown)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ticket', $booking->getTicketNo());
        $stmt->bindParam(':scheduleID', $booking->getScheduleID());
        $stmt->bindParam(':customerName', $booking->getCustomerName());
        $stmt->bindParam(':nic', $booking->getNic());
        $stmt->bindParam(':email', $booking->getEmail());
        $stmt->bindParam(':payment', $booking->getPayment());
        $stmt->bindParam(':fromTown', $booking->getFromLocation());
        $stmt->bindParam(':toTown', $booking->getToLocation());
        $stmt->execute();
    }
    public function refundTicket($conn,$ticketID){
        $sql="UPDATE Booking set State="+BookingDao::REFUND_STATE+" where TicketNo=:ticket";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ticket', $ticketID);
        $stmt->execute();
    }
}