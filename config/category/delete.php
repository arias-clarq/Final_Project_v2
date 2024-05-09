<?php
session_start();
include '../db_conn.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM `tbl_category` WHERE `category_id` = $id";
$result = $conn->query($sql);

if(!$result){
    $_SESSION['deleteMsg'] = "Sorry, you can't delete this category right now. It's still connected to other records. Please disconnect it from any related items before trying again.";
    header('location: ../../dashboard/category.php');
}else{
    $_SESSION['confirm_msg'] = "Successfuly Deleted Category";
    header('location: ../../dashboard/category.php');
}