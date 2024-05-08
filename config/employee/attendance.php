<?php
session_start();
include '../db_conn.php';

date_default_timezone_set('Asia/Manila');

$id = $_SESSION['login_id'];
$currentDate = date("Y-m-d");
$currentDateTime = date("Y-m-d H:i:s");

$currentTime = date("H:i:s");

// Define the job start time (9:30 AM in this example)
$jobStartTime = strtotime("09:30:00");
// Define the job end time (5:00 PM in this example)
$jobEndTime = strtotime("16:30:00");

// Define the cutoff time for marking an employee as absent (e.g., midnight)
$cutoffTime = strtotime("23:59:59");

if (isset($_POST['btn_timein'])) {

    $sql = "INSERT INTO `tbl_attendance`(`employee_id`, `date`, `time_in`, `worktime_status_id`, `attendance_status_id`) 
    VALUES ('$id','$currentDate','$currentDateTime',0,";


    if (strtotime($currentTime) > $jobStartTime) {
        // Late
        $sql .= "2)"; // StatusID = 2 for "late"
    } else {
        // On time
        $sql .= "1)"; // StatusID = 1 for "present"
    }

    $result = $conn->query($sql);
    $_SESSION['attendanceID'] = $conn->insert_id;

    if ($result === true) {
        $_SESSION['confirm_msg'] = "Time in successfully";
        $_SESSION['isTimein'] = true;
        header('location: ../../dashboard/dashboard.php');
    }
}