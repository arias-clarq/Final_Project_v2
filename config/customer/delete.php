<?php
session_start();
include '../db_conn.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM `tbl_customer_account` WHERE `customer_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to delete account' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Delete User";
    header('location: ../../dashboard/customer_mgt.php');
}