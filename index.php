<?php include 'landing-template/header.php'; ?>
<!-- main content start -->
<div class="main-content">

    <!-- content -->
    <div class="container-fluid content-top-gap">

        <!-- forms 1 -->
        <div class="card card_border py-2 mb-4">
            <div class="cards__heading">
                <h3>Login <span></span></h3>
            </div>
            <div class="card-body">
                <!-- action msg here -->
                <?php
                if (isset($_SESSION['error_msg'])) {
                    ?>
                    <div class="alert alert-danger  alert-dismissible">
                        <strong>
                            <?= $_SESSION['error_msg'] ?>
                        </strong>
                    </div>
                    <?php
                } ?>
                <?php
                if (isset($_SESSION['success_msg'])) {
                    ?>
                    <div class="alert alert-success  alert-dismissible">
                        <strong>
                            <?= $_SESSION['success_msg'] ?>
                        </strong>
                    </div>
                    <?php
                } ?>
                <form action="config/login.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="input__label">Username / Email</label>
                        <input type="text" class="form-control input-style" id="exampleInputEmail1"
                            aria-describedby="emailHelp" name="username" placeholder="Enter username or email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="input__label">Password</label>
                        <input type="password" class="form-control input-style" id="exampleInputPassword1"
                            placeholder="Enter password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                    <a href="register.php" type="button " class="btn btn-primary btn-style mt-4">Register</a>
                </form>
            </div>
        </div>
        <!-- //forms 1 -->

    </div>

    <!-- //content -->
</div>
<!-- main content end-->
<?php include 'landing-template/footer.php'; ?>