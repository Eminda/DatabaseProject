
function checkNextSchedule(){

    if($('#nextScheduleID').val()!=$('#ScheduleID').val()){
        return true;
    }
    alert('No more Schedules for this bus');
    return false;
}
function checkBeforeSchedule(){
    if($('#beForeScheduleID').val()!=$('#ScheduleID').val()){
        return true;
    }
    alert('No more Schedules for this bus');
    return false;
}