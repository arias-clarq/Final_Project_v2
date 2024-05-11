<?php
session_start();
$_SESSION['title'] = "Help Support";
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

    </div>

    <section class="forms">
        <!-- forms 1 -->
        <div class="card card_border py-2 mb-4">
            <div class="cards__heading">
                <h3>Send A Message <span></span></h3>
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
            <div class="card-body">
                <form action="../config/ticket/add.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="input__label">Enter Message</label>
                        <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?= $_SESSION['login_id'] ?>">
                    <button type="submit" class="btn btn-primary btn-style mt-4">Issue Ticket</button>
                </form>
            </div>
        </div>
        <!-- //forms 1 -->

    </section>

    <!-- //content -->
</div>
<?php include 'customer-template/customer-footer.php'; ?>