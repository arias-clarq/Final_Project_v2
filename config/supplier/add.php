<?php
session_start();
include '../db_conn.php';

$supplier = $conn->real_escape_string($_POST['supplier']);
$contact = $conn->real_escape_string($_POST['contact']);
$address = $conn->real_escape_string($_POST['address']);

$sql = "INSERT INTO `tbl_supplier`(`supplier_name`, `supplier_contact`, `supplier_address`) VALUES ('$supplier','$contact','$address')";
$result = $conn->query($sql);

if(!$result){
    echo 'Failed to add supplier' . $conn->error;
}else{
    $_SESSION['confirm_msg'] = "Successfuly Add New Supplier";
    header('location: ../../dashboard/supplier.php');
}