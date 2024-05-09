<?php
session_start();
include '../db_conn.php';

$category = $conn->real_escape_string($_POST['category']);

$sql = "INSERT INTO `tbl_category`(`category`) VALUES ('$category')";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to add category' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Add New Category";
    header('location: ../../dashboard/category.php');
}