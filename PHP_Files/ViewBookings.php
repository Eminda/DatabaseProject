<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 18/12/2016
 * Time: 01:51 PM
 */
session_start();
include_once '../Controller/ScheduleBookingController.php';

include_once '../Modal/PhpClasses.php';
require_once '../Include/header.php';
//include '../Include/beforenav.php';
require_once '../Include/functions.php';
require '../Include/PublicConnect.php';
if (isset($_GET["RegNumber"])) {
    $RegNumber = $_GET['RegNumber'];
    $ScheduleID = null;
    if (isset($_GET['ScheduleID'])) {
        $ScheduleID = $_GET['ScheduleID'];
        if ($ScheduleID == "") {
            redirect_to("ViewBookings.php?");
        }
    }
    $Schedules = true;
    $nextBooking = null;
    $beforeBooking = null;
    $inverse=false;
    list($day, $time) = explode(' ', date('Y-m-d H:i:s'));
    echo $day;
    if ($ScheduleID == null)
        $Schedule = ScheduleBookingController::getFirstScheduleInAGivenDate($conn, $RegNumber, $day);
    else
        $Schedule = ScheduleBookingController::getBookingScheduleFromScheduleID($conn, $ScheduleID);
    if ($Schedule == null) {
        echo "<script>alert('No Schedules for this Bus');</script>";
        $Schedules = false;
    } else {
        if($Schedule->getFromDistance()>$Schedule->getToDistance()){
            $inverse=true;
        }
        $nextBooking = ScheduleBookingController::getNextBookingSchedule($conn, $RegNumber, $Schedule->getFromInt());
        $beforeBooking = ScheduleBookingController::getBeforeSchedule($conn, $RegNumber, $Schedule->getFromInt());

    }

    $day = getDateFromTimeStamp($Schedule->getFromInt());
    $bookings = null;
    if ($Schedules) {
        $bookings = ScheduleBookingController::getBookingsInAGivenSchedule($conn, $Schedule->getRouteID(), $Schedule->getScheduleID());

    }
} else {
    echo "Invalid Data Input";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/BookTicket.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 50%;
            margin: auto;
        }
    </style>
</head>
<body style="background-color:#ffffff ">

<div class="container-fluid" style="background-color: #ffffff">


    <div class="row">


        <div id="myCarousel" class="col-md-12 carousel slide" data-ride="carousel"
             style="height: 500px;overflow:hidden;background-color: white">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>

            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="../Resources/Bus_1.png" alt="Chania" width="800px" height=500px>
                </div>

                <div class="item">
                    <img src="../Resources/Bus_2.png" alt="Chania" width="800px" height=500px>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <div class="row"
         style="text-align: center;background-color: #122b40;border-style: solid;border-color: white;border-left-width: 0px;border-right: 0px;">
        <br>
        <span style="text-align: center;color:white;font-size: 30pt;font-weight: 900;">Ticket Bookings</span>
        <br>
        <br>
    </div>
    <div class="row" style="text-align: center;background-color: #122b40;color:white;font-size:13pt">
        <div class="col-md-2">BE-1922</div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbspSemi Luxiary</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbspWifi</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbspCourtains</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbsp53 Seats</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-earphone"></i>&nbsp&nbsp071-2345423</span></div>

    </div>
    <?php if (!$Schedules) {
        die();
    } ?>
    <div class="row">
        <div style="text-align: left">
            <h2 style="font-weight: 600;float: left;">Jump to Date</h2>
        </div>
        <div style="margin-left: 20px;"><input class="btn btn-default" type="text" id="datepicker"
                                               style="position: relative; z-index: 100000;text-align: left;margin-top: 18px;font-size: larger;float:left;margin-left:20px;width:150px;">
        </div>
        <div style="float:left;padding-left: 10px;"><input type="button" class="btn btn-danger" value="Go"
                                                           style="margin-top:18px;width: 100px;" style="float:left;"/>
        </div>
        <div style="float:left;padding-left: 10px;">
            <input type="button" class="btn btn-danger" value="Edit Shedules" style="margin-top:18px;width: 150px;"/>
        </div>
        <div style="clear: both"></div>
    </div>
    <div class="row"
         style="height:800px;overflow:hidden;border-style: solid;border-top-width: 0px;border-right-width: 0px;">
        <div class="col-md-6" style="border-style: solid;border-color: black;border-bottom-width: 0px;">
            <div class="col-md-2">
                <form role="form" action="ViewBookings.php" method="get" onsubmit="checkBeforeSchedule()">
                    <input type="image" src="../Image/back.png" class="btTxt submit" id="prevBtn"
                           onsubmit="checkBeforeSchedule();"
                           style="width:50px;height: 50px;margin-top: 10px;"/>
                    <input type="hidden" id="ScheduleID"  value="<?php echo $Schedule->getScheduleID(); ?>"/>
                    <input type="hidden" name="RegNumber" value="<?php echo $RegNumber; ?>"/>
                    <input type="hidden" id="beForeScheduleID" name="ScheduleID"
                           value="<?php if ($beforeBooking != null) echo $beforeBooking->getScheduleID(); else echo $Schedule->getScheduleID(); ?>"/>
                </form>
            </div>
            <div class="col-md-8" style="text-align: center">
                <h3 id="journy">Journy :: <?php echo $day ?></h3>

            </div>
            <form role="form" action="ViewBookings.php" method="get" onsubmit="checkNextSchedule()">
                <div class="col-md-2" style="text-align: right">
                    <input type="image" src="../Image/next.png" class="btTxt submit" id="nextBtn"
                           style="width:50px;height: 50px;margin-top: 10px;"
                    />

                    <input type="hidden" name="RegNumber" value="<?php echo $RegNumber ?>"/>
                    <input type="hidden" id="nextScheduleID" name="ScheduleID"
                           value="<?php if ($nextBooking != null) echo $nextBooking->getScheduleID(); else echo $Schedule->getScheduleID(); ?>"/>
                </div>
            </form>
        </div>
        <div class="col-md-12" style="height: 100%;border-style: solid;padding:0px;">
            <div class="col-md-1 col-md-offset-2" style="text-align: right;"><h3>From:</h3></div>
            <div class="col-md-4"><h3><?php echo $Schedule->getFromTownName(); ?>
                    <br><?php echo getTimeFromStringTimeStamp($Schedule->getFromTime()); ?></h3></div>
            <div class="col-md-1 " style="text-align: right;"><h3>To:</h3></div>
            <div class="col-md-3"><h3><?php echo $Schedule->getToTownName(); ?>
                    <br><?php echo getTimeFromStringTimeStamp($Schedule->getToTime()); ?></h3></div>
            <div class="row">
                <div class="col-md-8"
                     style="border-style: solid;border-width: 0px;border-top-width: 3px;padding-bottom: 10px;">
                    <div style="float:left"><h3>Filter From</h3></div>
                    <div style="margin-top:18px;float:left;padding-left: 20px;">
                        <select class="btn btn-default">
                            <option value="Ambalangoda" selected>Ambalangoda</option>
                        </select>
                    </div>
                    <div style="margin-top:18px;padding-left: 20px;padding-right: 10px;float:left">
                        <button type="button" class="btn btn-danger" onsubmit="return false">Filter</button>
                    </div>

                    <div style="margin-top:18px;">
                        <button type="button" class="btn btn-danger" onsubmit="return false"
                                style="padding-left: 10px;">Filter by Location
                        </button>
                        &nbsp
                        <small style="padding-top:5px;">Ps. Predicted location is used</small>
                    </div>
                </div>
                <div class="col-md-4"
                     style="border-style: solid;border-width: 0px;border-top-width: 3px;padding-bottom: 10px;text-align: right;padding-top:18px">
                    <input type="radio" name="sort" value="location" checked>&nbspSort by Location
                    <input type="radio" name="sort" value="seat">&nbspSort by Seat No.
                    &nbsp&nbsp
                </div>
            </div>
            <div
                style="border-style: solid;border-width: 0px;height:100%;width:100%;overflow:scroll;margin:0px;font-size:14pt;">
                <table class="col-md-12 table table-striped table-bordered">
                    <tr>
                        <th class="col-md-1">
                            Ticket No.
                        </th>
                        <th class="col-md-3">
                            Name
                        </th>
                        <th class="col-md-2">
                            Nic
                        </th>
                        <th class="col-md-2">
                            From
                        </th>
                        <th class="col-md-2">
                            To
                        </th>
                        <th class="col-md-1">
                            Seat No
                        </th>
                        <th class="col-md-1">
                            State
                        </th>
                        <th ></th>
                    </tr>
                    <?php

                    foreach ($bookings as &$booking) {
                        echo "<tr>";
                        echo "<td>" . $booking->getTicketNo() . "</td>";
                        echo "<td>" . $booking->getCustomerName() . "</td>";
                        echo "<td>" . $booking->getNic() . "</td>";
                        echo "<td>" . $booking->getFromTownName() . "</td>";
                        echo "<td>" . $booking->getToTownName() . "</td>";
                        echo "<td>" . $booking->getSeat() . "</td>";
                        echo "<td>" . $booking->getState() . "</td>";
                        $FromDistance=$Schedule->getFromDistance();
                        if($inverse){

                            echo "<td>".($FromDistance-$booking->getFromTownDistance()) . "</td>";
                        }else{

                            echo "<td>". ($booking->getFromTownDistance()-$FromDistance) . "</td>";
                        }
                        echo "</tr>";

                    }
                    ?>


                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>
<script>
    var date = new Date();
    date.setDate(date.getDate());
    $("#datepicker").datepicker("setDate", date);
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: date,
        onSelect: function () {
            selectedDate = $.datepicker.formatDate("yyyy-mm-dd", $(this).datepicker('getDate'));
        }
    });
    $("#datepicker").val(<?php echo "'" . $day . "'";?>);


</script>
<script src="../JS/ViewBookings.js"></script>
</body>
</html>

