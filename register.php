<?php include 'landing-template/header.php'; ?>
<!-- main content start -->
<div class="main-content">

    <!-- content -->
    <div class="container-fluid content-top-gap">

        <!-- forms 1 -->
        <div class="card card_border py-2 mb-4">
            <div class="cards__heading">
                <h3>Register<span></span></h3>
            </div>
            <div class="card-body">
                <form action="config/register.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="input__label">Username / Email</label>
                        <input type="text" class="form-control input-style" id="exampleInputEmail1"
                            aria-describedby="emailHelp" name="username" placeholder="Enter username or email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="input__label">Password</label>
                        <input type="password" class="form-control input-style" id="exampleInputPassword1"
                            placeholder="Enter password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                </form>
            </div>
        </div>
        <!-- //forms 1 -->

    </div>

    <!-- //content -->
</div>
<!-- main content end-->
<?php include 'landing-template/footer.php'; ?>