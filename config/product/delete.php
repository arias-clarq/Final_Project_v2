<?php
session_start();
include '../db_conn.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM `tbl_product` WHERE `product_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to delete product' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Deleted Product";
    header('location: ../../dashboard/product.php');
}