<?php
session_start();
include_once 'db_conn.php';

$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

$sql = "INSERT INTO `tbl_customer_account`(`username`, `password`,`login_role_id`) VALUES ('$username','$password','3')";
$result = $conn->query($sql);
$id = $conn->insert_id;

if ($result !== true) {
    $_SESSION['error_msg'] = "failed to registered account";
    header('location: ../index.php');
}

$sql = "INSERT INTO `tbl_customer_info`(`customer_info_id`,`customer_id`) VALUES ('$id','$id')";
$result = $conn->query($sql);
$id = $conn->insert_id;

if ($result !== true) {
    $_SESSION['error_msg'] = "failed to registered account info";
    header('location: ../index.php');
}else{
    $_SESSION['success_msg'] = "successfuly registered account";
    header('location: ../index.php');
}