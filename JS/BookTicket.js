/**
 * Created by acer on 06/12/2016.
 */
//var date = $('#datepicker').datepicker({ dateFormat: 'yyyy-mm-d' }).val();
var list = [];
var availableSeats = [1, 2, 4, 5, 6, 7, 8, 10, 12, 15, 16, 18, 20, 21, 22, 25, 30, 31, 40, 43, 45, 50, 53];
var selectedSeats=[];
var copyOfAllSeats=availableSeats.slice();
var selectedSeatCount=0;
updateAvailableSeatList();
function updateAvailableSeatList() {
    $('#availableSeats')[0].options.length = 0;
    for (var i = 0; i < availableSeats.length; i++) {
        $("#availableSeats").append(new Option("" + availableSeats[i], "" + availableSeats[i]));
    }
    if (availableSeats.length == 0) {
        $("#availableSeats").append(new Option("No more available seats", "No more available seats"));
    }
}
function selectSeat() {

    var seatCount=parseInt($('#ticketCount').val());
    if (availableSeats.length !=0 && seatCount>selectedSeatCount) {
        var val = $('#availableSeats').val();
        $('#seatHolder').html($('#seatHolder').html() + "<button class='btn btn-info' style='margin: 2px;' type='button' onclick='removeSelectedSeat(this)' onsubmit='return false' value='"+val+"'>" + val + "</button>");
        var index = availableSeats.indexOf(parseInt(val));
        selectedSeats.push(val);
        availableSeats.splice(index, 1);
        updateAvailableSeatList();
        selectedSeatCount++;
        $('#selectedSeats').val(selectedSeats.toString());
    }
}
function removeSelectedSeat(item) {
    var val=item.value;
    console.log(val);
    availableSeats.push(parseInt(val));
    availableSeats.sort(sortNumber);
    updateAvailableSeatList();
    item.parentNode.removeChild(item);
    var index = selectedSeats.indexOf(parseInt(val));
    selectedSeatCount.splice(index, 1);
    selectedSeatCount--;
    $('#selectedSeats').val(selectedSeats.toString());
}
function sortNumber(a,b) {
    return a - b;
}

function ticketNoSelect(){
    $('#seatHolder').html('');
    availableSeats=copyOfAllSeats.slice();
    selectedSeatCount=0;
    updateAvailableSeatList();
    $('#ticketCountChildren')[0].options.length=0;
    var val=parseInt($('#ticketCount').val());
    for(var i=0;i<=val;i++){
        $("#ticketCountChildren").append(new Option("" + i, "" + i));
    }
    callcualatePayment();
}
function callcualatePayment(){
    console.log("sd"+$('#total'));
    var numSeat=parseInt($('#ticketCount').val());
    var children=parseInt($('#ticketCountChildren').val());
    numSeat-=children*0.5;
    var cost=parseFloat($('#cost').val())*parseFloat($('#distance').val());
    console.log(cost+" "+cost*numSeat);
    $('#total').html("Rs. "+(numSeat*cost).toFixed(2));
    $('#payment').val((numSeat*cost).toFixed(2));
    $('#selectedSeats').val(selectedSeats.toString());
}
function validateForm(){

    if(parseInt($('#ticketCount').val())!=selectedSeats.length){
        alert('You must select seat numbers fot the tickets');
        return false;
    }
    return true;
}
