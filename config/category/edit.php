<?php
session_start();
include '../db_conn.php';

$category = $conn->real_escape_string($_POST['category']);
$id = $conn->real_escape_string($_POST['id']);

$sql = "UPDATE `tbl_category` SET `category`='$category' WHERE `category_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to edit category' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Updated Category";
    header('location: ../../dashboard/category.php');
}