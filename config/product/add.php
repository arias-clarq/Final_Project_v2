<?php
session_start();
include '../db_conn.php';

$product = $conn->real_escape_string($_POST['product']);
$description = $conn->real_escape_string($_POST['description']);
$expiry_date = $conn->real_escape_string($_POST['expiry_date']);
$category = $conn->real_escape_string($_POST['category']);
$supplier = $conn->real_escape_string($_POST['supplier']);
$price = $conn->real_escape_string($_POST['price']);
$stock = $conn->real_escape_string($_POST['stock']);

// Check if an image file has been uploaded
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $target_directory = "../../assets/images/"; // Directory where uploaded images will be stored
    $target_file = $target_directory . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $_SESSION['deleteMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            header('location: ../../dashboard/product.php');
            exit();
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $_SESSION['deleteMsg'] = "Sorry, there was an error uploading your file.";
            header('location: ../../dashboard/product.php');
            exit();
        }

        // Insert product data into database including the image filename
        $image_name = basename($_FILES["image"]["name"]);
        $sql = "INSERT INTO `tbl_product`(`supplier_id`, `category_id`, `product_name`, `description`, `price`, `stock`, `expiry_date`,`image`) 
        VALUES ('$supplier','$category','$product','$description','$price','$stock','$expiry_date','$image_name')";
        
        $result = $conn->query($sql);
        if (!$result) {
            echo 'Failed to add product' . $conn->error;
        } else {
            $_SESSION['confirm_msg'] = "Successfully Added New Product";
            header('location: ../../dashboard/product.php');
        }

    } else {
        $_SESSION['deleteMsg'] = "File is not an image.";
        header('location: ../../dashboard/product.php');
        exit();
    }
} else {
    // Insert product data into database
    $sql = "INSERT INTO `tbl_product`(`supplier_id`, `category_id`, `product_name`, `description`, `price`, `stock`, `expiry_date`) 
    VALUES ('$supplier','$category','$product','$description','$price','$stock','$expiry_date')";
    $result = $conn->query($sql);
    if (!$result) {
        echo 'Failed to add product' . $conn->error;
    } else {
        $_SESSION['confirm_msg'] = "Successfully Added New Product";
        header('location: ../../dashboard/product.php');
    }
}
?>