<?php
session_start();
include '../db_conn.php';

if (isset($_POST['add_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_stock = $_POST['product_stock'];

    if (isset($_SESSION['cart'])) {

        $items = array_column($_SESSION['cart'], 'product_id');

        if (in_array($product_id, $items)) {
            $_SESSION['deleteMsg'] = "This item is already added in cart";
            header('location: ../../customer-dashboard/dashboard.php');
        } else {
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_stock' => $product_stock,
                'product_qty' => 1
            );
            $_SESSION['confirm_msg'] = "Item Added To Cart";
            header('location: ../../customer-dashboard/dashboard.php');
        }

    } else {
        $_SESSION['cart'][0] = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_stock' => $product_stock,
            'product_qty' => 1
        );
        $_SESSION['confirm_msg'] = "Item Added To Cart";
        header('location: ../../customer-dashboard/dashboard.php');
    }
}

if (isset($_POST['remove_item'])) {
    $id = $_POST['product_id'];
    foreach ($_SESSION['cart'] as $key => $item) {

        if ($item['product_id'] == $id) {

            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);

            $_SESSION['confirm_msg'] = "Item is remove to cart";
            header('location: ../../customer-dashboard/order.php');
        }
    }
}

if (isset($_POST['product_qty'])) {

    $id = $_POST['product_id'];
    foreach ($_SESSION['cart'] as $key => $item) {

        if ($item['product_id'] == $id) {
            $_SESSION['cart'][$key]['product_qty'] = $_POST['product_qty'];
            header('location: ../../customer-dashboard/order.php');
        }
    }
}

if (isset($_POST['purchase'])) {

    $total_cost = $conn->real_escape_string($_POST['total']);
    $amount_payed = $conn->real_escape_string($_POST['amount_payed']);
    $customer_id = $_SESSION['login_id'];

    if ($total_cost > $amount_payed) {
        $_SESSION['deleteMsg'] = "Insufficient Amount Payed";
        header('location: ../../customer-dashboard/order.php');
        exit();
    }

    foreach ($_SESSION['cart'] as $key => $item) {
        $product_id = $item['product_id'];
        $product_qty = $item['product_qty'];
        $product_name = $item['product_name'];

        $sql = "SELECT `stock` FROM `tbl_product` WHERE `product_id` = $product_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row['stock'] < $product_qty) {
            $_SESSION['deleteMsg'] = "This " . $product_name . " item have only " . $row['stock'] . " stock available";
            header('location: ../../customer-dashboard/order.php');
            exit();
        } else {
            $new_stock = $row['stock'] - $product_qty;
        }

        $sql = "INSERT INTO `tbl_order`(`customer_id`, `product_id`, `payed`, `quantity_buy`, `total_cost`) VALUES ('$customer_id','$product_id','$amount_payed','$product_qty','$total_cost')";
        $result = $conn->query($sql);
        if (!$result) {
            echo 'Failed to purchase order' . $conn->error;
            exit();
        }

        $sql = "UPDATE `tbl_product` SET `stock`='$new_stock' WHERE `product_id` = $product_id";
        $result = $conn->query($sql);
        if (!$result) {
            echo 'Failed to update product qty' . $conn->error;
            exit();
        }
    }

    $_SESSION['confirm_msg'] = "Successfully Purchase Order";
    foreach ($_SESSION['cart'] as $key => $item) {
        unset($_SESSION['cart'][$key]);
    }
    header('location: ../../customer-dashboard/order.php');
}

if (isset($_POST['order'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $deliver = $conn->real_escape_string($_POST['deliver']);

    if($deliver==0){
        $bool = 1;
    }else{
        $bool = 0;
    }

    $sql = "UPDATE `tbl_order` SET `is_delivered`='$bool' WHERE `order_id` = $id";
    $result = $conn->query($sql);

    if (!$result) {
        echo 'Failed to update order' . $conn->error;
    } else {
        $_SESSION['confirm_msg'] = "Successfuly Updated Order";
        header('location: ../../dashboard/order.php');
    }
}