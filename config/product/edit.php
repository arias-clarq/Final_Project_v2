<?php
session_start();
include '../db_conn.php';

$id = $conn->real_escape_string($_POST['id']);
$product = $conn->real_escape_string($_POST['product']);
$description = $conn->real_escape_string($_POST['description']);
$expiry_date = $conn->real_escape_string($_POST['expiry_date']);
$category = $conn->real_escape_string($_POST['category']);
$supplier = $conn->real_escape_string($_POST['supplier']);
$price = $conn->real_escape_string($_POST['price']);
$stock = $conn->real_escape_string($_POST['stock']);

$sql = "UPDATE `tbl_product` 
SET 
`supplier_id`='$supplier',
`category_id`='$category',
`product_name`='$product',
`description`='$description',
`price`='$price',
`stock`='$stock',
`expiry_date`='$expiry_date'
WHERE `product_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to edit product' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Updated Product";
    header('location: ../../dashboard/product.php');
}