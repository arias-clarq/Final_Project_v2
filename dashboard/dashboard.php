<?php
session_start();
$_SESSION['title'] = "Dashboard";
include '../template/header.php';
date_default_timezone_set('Asia/Manila');
?>

<?php
if ($_SESSION['login_role'] == 1) {
    include 'dashboard-content/admin.php';
} else {
    include 'dashboard-content/employee.php';
}
?>

<?php include '../template/footer.php'; ?>