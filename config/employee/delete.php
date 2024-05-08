<?php
session_start();
include '../db_conn.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM `tbl_employee_account` WHERE `employee_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to delete account' . $conn->error;
}

$sql = "DELETE FROM `tbl_bill` WHERE `bill_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to delete bill' . $conn->error;
}

$sql = "DELETE FROM `tbl_job` WHERE `job_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to delete job' . $conn->error;
}


$sql = "DELETE FROM `tbl_relation` WHERE `relation_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to delete relation' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Delete User";
    header('location: ../../dashboard/employee_mgt.php');
}