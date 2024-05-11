<?php
session_start();
include '../db_conn.php';

$id = $conn->real_escape_string($_POST['id']);
$e_id = $conn->real_escape_string($_POST['e_id']);
$currentDate = date("Y-m-d");

$sql = "UPDATE `tbl_ticket` SET `employee_id`='$e_id',`resolve_date`='$currentDate',`is_resolved`='1' WHERE `ticket_id` = $id";
$result = $conn->query($sql);

if(!$result){
    $_SESSION['deleteMsg'] = "Error";
    header('location: ../../dashboard/ticket.php');
}else{
    $_SESSION['confirm_msg'] = "Successfuly Mark as Resolved";
    header('location: ../../dashboard/ticket.php');
}