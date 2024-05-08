<?php
session_start();
include '../db_conn.php';

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


$sql = "INSERT 
INTO `tbl_employee_account`(`username`, `password`, `login_role_id`) 
VALUES ('$username','$password','$login_role_id')";

$result = $conn->query($sql);
$id = $conn->insert_id;

if(!$result){
    echo 'Failed to create account' . $conn->error;
}

$sql = "INSERT INTO `tbl_bill`(`bill_id`, `sss`, `phil`, `pagibig`, `salary`) 
VALUES ('$id','$sss','$phil','$pagibig','$salary')";

$result = $conn->query($sql);

if(!$result){
    echo 'Failed to create account bill' . $conn->error;
}

$sql = "INSERT INTO `tbl_job`(`job_id`, `job_title`, `employement_num`, `department`, `hire_date`, `hire_status`) 
VALUES ('$id','$job_title','$employement_num','$department','$hire_date','$employment_status')";

$result = $conn->query($sql);

if(!$result){
    echo 'Failed to create account job' . $conn->error;
}

$sql = "INSERT INTO `tbl_relation`(`relation_id`, `person_name`, `relationship`, `person_num`, `person_email`) 
VALUES ('$id','$person_name','$person_relationship','$person_phone_num','$person_email')";

$result = $conn->query($sql);

if(!$result){
    echo 'Failed to create account relation' . $conn->error;
}

$sql = "INSERT 
INTO `tbl_employee_info`(`employee_info_id`, `employee_id`, `relation_id`, `job_id`, `bill_id`, `firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `age`, `marital_status`, `email`, `phone_num`, `province`, `municipality`, `elem`, `jhs`, `shs`, `college`) 
VALUES ('$id','$id','$id','$id','$id','$fname','$mname','$lname','$bday','$gender','$age','$marital_status','$email','$phone','$province','$municipality','$elem','$jhs','$shs','$college')";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to create account info' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Add New User";
    header('location: ../../dashboard/employee_mgt.php');
}