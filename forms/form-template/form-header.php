<?php
include '../../config/db_conn.php';

if (!$_SESSION['login_session']) {
  header('location: ../../index.php');
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?= $_SESSION['title'] ?></title>

  <!-- Template CSS -->
  <link rel="stylesheet" href="../../assets/css/style-starter.css">

  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
  <div class="se-pre-con"></div>
  <section>
    <?php include 'form-sidebar.php';?>