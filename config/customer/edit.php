<?php
session_start();
include '../db_conn.php';

$id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['login_id'];

$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

$fname = $conn->real_escape_string($_POST['fname']);
$lname = $conn->real_escape_string($_POST['lname']);
$age = $conn->real_escape_string($_POST['age']);
$bday = $conn->real_escape_string($_POST['bday']);
$gender = $conn->real_escape_string($_POST['gender']);

$phone = $conn->real_escape_string($_POST['phone']);

$municipality = $conn->real_escape_string($_POST['municipality']);
$province = $conn->real_escape_string($_POST['province']);

if ($_SESSION['login_role'] == 3) {
    $sql = "UPDATE `tbl_customer_info` 
    SET 
    `firstname`='$fname',
    `lastname`='$lname',
    `birthdate`='$bday',
    `gender`='$gender',
    `age`='$age',
    `phone_num`='$phone',
    `municipality`='$municipality',
    `province`='$province' 
    WHERE `customer_id` = $id";
    $result = $conn->query($sql);
    if (!$result) {
        echo 'Failed to update account info' . $conn->error;
    }
}

$sql = "UPDATE `tbl_customer_account` SET `username`='$username',`password`='$password' WHERE `customer_id` = $id";
$result = $conn->query($sql);

if (!$result) {
    echo 'Failed to update account' . $conn->error;
} else {
    if ($_SESSION['login_role'] == 3) {
        $_SESSION['confirm_msg'] = "Successfuly Update User";
        header('location: ../../customer-dashboard/dashboard.php');
    }else{
        $_SESSION['confirm_msg'] = "Successfuly Update User";
        header('location: ../../dashboard/customer_mgt.php');
    }
}