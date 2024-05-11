<?php
session_start();
include '../db_conn.php';
date_default_timezone_set('Asia/Manila');

$message = $conn->real_escape_string($_POST['message']);
$id = $conn->real_escape_string($_POST['id']);
$currentDate = date("Y-m-d");

$sql = "INSERT INTO `tbl_ticket`(`customer_id`, `issue_date`, `message`) VALUES ('$id','$currentDate','$message')";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to issue a ticket' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Your Ticket Is Sent";
    header('location: ../../customer-dashboard/ticket.php');
}