<?php
session_start();
include '../db_conn.php';

$id = $conn->real_escape_string($_POST['id']);
$supplier = $conn->real_escape_string($_POST['supplier']);
$contact = $conn->real_escape_string($_POST['contact']);
$address = $conn->real_escape_string($_POST['address']);

$sql = "UPDATE `tbl_supplier` SET `supplier_name`='$supplier',`supplier_contact`='$contact',`supplier_address`='$address' WHERE `supplier_id` = $id";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to edit supplier' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Updated Supplier";
    header('location: ../../dashboard/supplier.php');
}