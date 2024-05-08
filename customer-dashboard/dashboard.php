<?php
session_start();
$_SESSION['title'] = "Dashboard";
include 'customer-template/customer-header.php'; ?>
<!-- main content start -->
<div class="main-content">

    <!-- content -->
    <div class="container-fluid content-top-gap">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $_SESSION['title'] ?></li>
            </ol>
        </nav>
        <div class="welcome-msg pt-3 pb-4">
            <h1>Hi <span class="text-primary text-capitalize"><?= $user_row['firstname'] ?></span>, Welcome back</h1>
        </div>

        <!-- action msg here -->
        <?php
        if (isset($_SESSION['confirm_msg'])) {
            ?>
            <div class="alert alert-success  alert-dismissible">
                <strong>
                    <?= $_SESSION['confirm_msg'] ?>
                </strong>
            </div>
            <?php
        } elseif (isset($_SESSION['deleteMsg'])) { ?>
            <div class="alert alert-danger  alert-dismissible">
                <strong>
                    <?= $_SESSION['deleteMsg'] ?>
                </strong>
            </div>
        <?php }
        unset($_SESSION['deleteMsg']);
        unset($_SESSION['confirm_msg']);
        ?>

    </div>

    <!-- //content -->
</div>
<!-- main content end-->
<?php include 'customer-template/customer-footer.php'; ?>