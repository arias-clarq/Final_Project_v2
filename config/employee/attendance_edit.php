<?php
session_start();
include '../db_conn.php';
date_default_timezone_set('Asia/Manila');

$id =  $_POST['id'];
$date = $_POST['date'];
$time_in = $_POST['time_in'];
$time_out = $_POST['time_out'];

$d_time_out = strtotime($_POST['time_out']);
$formattedTimeOut = date("H:i:s", $d_time_out);

$d_time_in = strtotime($_POST['time_in']);
$formattedTimeIn = date("H:i:s", $d_time_in);
// Define the job start time (9:30 AM in this example)
$jobStartTime = strtotime("09:30:00");
// Define the job end time (5:00 PM in this example)
$jobEndTime = strtotime("16:30:00");

if ($d_time_in > $jobStartTime) {
    // Late
    $status = 2;
} else {
    // On time
    $status = 1;
}

// Calculate the work duration
$workDuration = $d_time_in - $d_time_out;


if ($workDuration > 0) {
    if ($workDuration >= ($jobEndTime - $jobStartTime)) {
        $worktime_statusID = 3; // Overtime
    } else {
        $worktime_statusID = 1; // Normal work time
    }
} else {
    $worktime_statusID = 2; // Undertime
}

$sql = "UPDATE `tbl_attendance` 
SET `date`='$date',`time_in`='$time_in',`time_out`='$time_out',`attendance_status_id`='$status',`worktime_status_id`='$worktime_statusID' WHERE `attendance_id` = $id";

$result = $conn->query($sql);

if(!$result){
    echo 'Failed to create account info' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Updated Information";
    header('location: ../../dashboard/attendance_monitoring.php');
}