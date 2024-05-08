<?php
session_start();
include '../db_conn.php';

$id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['login_id'];

$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);
$login_role_id = $conn->real_escape_string($_POST['login_role_id']);

$sss = $conn->real_escape_string($_POST['sss']);
$pagibig = $conn->real_escape_string($_POST['pagibig']);
$phil = $conn->real_escape_string($_POST['phil']);
$salary = $conn->real_escape_string($_POST['salary']);

$job_title = $conn->real_escape_string($_POST['job_title']);
$department = $conn->real_escape_string($_POST['department']);
$employment_status = $conn->real_escape_string($_POST['employment_status']);
$employement_num = $conn->real_escape_string($_POST['employement_num']);
$hire_date = $conn->real_escape_string($_POST['hire_date']);

$person_name = $conn->real_escape_string($_POST['person_name']);
$person_relationship = $conn->real_escape_string($_POST['person_relationship']);
$person_phone_num = $conn->real_escape_string($_POST['person_phone_num']);
$person_email = $conn->real_escape_string($_POST['person_email']);

$fname = $conn->real_escape_string($_POST['fname']);
$mname = $conn->real_escape_string($_POST['mname']);
$lname = $conn->real_escape_string($_POST['lname']);
$age = $conn->real_escape_string($_POST['age']);
$bday = $conn->real_escape_string($_POST['bday']);
$gender = $conn->real_escape_string($_POST['gender']);
$marital_status = $conn->real_escape_string($_POST['marital_status']);

$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);

$province = $conn->real_escape_string($_POST['province']);
$municipality = $conn->real_escape_string($_POST['municipality']);

$elem = $conn->real_escape_string($_POST['elem']);
$jhs = $conn->real_escape_string($_POST['jhs']);
$shs = $conn->real_escape_string($_POST['shs']);
$college = $conn->real_escape_string($_POST['college']);

$sql = "UPDATE `tbl_employee_account` SET `username`='$username',`password`='$password',`login_role_id`='$login_role_id' WHERE `employee_id` = $id";
$result = $conn->query($sql);
if (!$result) {
    echo 'Failed to update account' . $conn->error;
}

$sql = "UPDATE `tbl_bill` SET `sss`='$sss',`phil`='$phil',`pagibig`='$pagibig',`salary`='$salary' WHERE `bill_id` = $id";
$result = $conn->query($sql);
if (!$result) {
    echo 'Failed to update account bill' . $conn->error;
}

$sql = "UPDATE `tbl_job` SET `job_title`='$job_title',`employement_num`='$employement_num',`department`='$department',`hire_date`='$hire_date',`hire_status`='$employment_status' WHERE `job_id` = $id";
$result = $conn->query($sql);
if (!$result) {
    echo 'Failed to update account job' . $conn->error;
}

$sql = "UPDATE `tbl_relation` SET `person_name`='$person_name',`relationship`='$person_relationship',`person_num`='$person_phone_num ',`person_email`='$person_email' WHERE `relation_id` = $id";
$result = $conn->query($sql);
if (!$result) {
    echo 'Failed to update account relation' . $conn->error;
}

$sql = "UPDATE `tbl_employee_info` 
SET `firstname`='$fname',
`middlename`='$mname',
`lastname`='$lname',
`birthdate`='$bday',
`gender`='$gender',
`age`='$age',
`marital_status`='$marital_status',
`email`='$email',
`phone_num`='$phone',
`province`='$province',
`municipality`='$municipality',
`elem`='$elem',
`jhs`='$jhs',
`shs`='$shs',
`college`='$college' WHERE `employee_id` = $id";
$result = $conn->query($sql);
if (!$result) {
    echo 'Failed to update account info' . $conn->error;
} else {
    if ($_SESSION['login_role'] == 1) {
        $_SESSION['confirm_msg'] = "Successfuly Update User";
        header('location: ../../dashboard/employee_mgt.php');
    } else {
        $_SESSION['confirm_msg'] = "Successfuly Update Information";
        header('location: ../../dashboard/dashboard.php');
    }
}