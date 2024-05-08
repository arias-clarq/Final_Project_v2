<?php
session_start();
include_once 'db_conn.php';

$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

$sql = "SELECT * FROM `tbl_employee_account` INNER JOIN tbl_login_role ON tbl_employee_account.login_role_id = tbl_login_role.login_role_id WHERE `username` = '{$username}' AND `password` = '{$password}' ";
$result = $conn->query($sql);

$clientsql = "SELECT * FROM `tbl_customer_account` INNER JOIN tbl_login_role ON tbl_customer_account.login_role_id = tbl_login_role.login_role_id WHERE `username` = '{$username}' AND `password` = '{$password}' ";
$clientresult = $conn->query($clientsql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $login_role = $row['login_role_id'];

    // enable login session
    $_SESSION['login_session'] = true;

    // set account id
    $_SESSION['login_id'] = $row['employee_id'];
    // set account role
    $_SESSION['login_role'] = $login_role;

    if ($login_role == 1 || $login_role == 2) {
        header('location: ../dashboard/dashboard.php');
    }

} else if ($clientresult->num_rows > 0) {
    $row = $clientresult->fetch_assoc();
    $login_role = $row['login_role_id'];

    $_SESSION['login_session'] = true;

    $_SESSION['login_id'] = $row['customer_id'];
    $_SESSION['login_role'] = $login_role;

    header('location: ../customer-dashboard/dashboard.php');
} else {
    $_SESSION['error_msg'] = "Invalid Username or Password";
    header('location: ../index.php');
}