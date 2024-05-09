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

        <!-- statistics data -->
        <div class="statistics">
            <div class="row">
                <div class="col-xl-6 pr-xl-2">
                    <div class="row">
                        <div class="col-sm-6 pr-sm-2 statistics-grid">
                            <div class="card card_border border-primary-top p-4">
                                <i class="lnr lnr-users"> </i>
                                <?php
                                $supplier_sql = "SELECT COUNT(*) as supplier FROM `tbl_supplier`";
                                $supplier_res = $conn->query($supplier_sql);
                                $supplier_row = $supplier_res->fetch_assoc();
                                ?>
                                <h3 class="text-primary number"><?= $supplier_row['supplier'] ?></h3>
                                <p class="stat-text">Total Suppliers</p>
                            </div>
                        </div>
                        <div class="col-sm-6 pl-sm-2 statistics-grid">
                            <div class="card card_border border-primary-top p-4">
                                <i class="lnr lnr-users"> </i>
                                <?php
                                $employee_sql = "SELECT COUNT(*) as employee FROM `tbl_employee_account`";
                                $employee_res = $conn->query($employee_sql);
                                $employee_row = $employee_res->fetch_assoc();
                                ?>
                                <h3 class="text-primary number"><?= $employee_row['employee'] ?></h3>
                                <p class="stat-text">Total Employee</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 pl-xl-2">
                    <div class="row">
                        <div class="col-sm-6 pr-sm-2 statistics-grid">
                            <div class="card card_border border-primary-top p-4">
                                <i class="lnr lnr-users"> </i>
                                <?php
                                $customer_sql = "SELECT COUNT(*) as customer FROM `tbl_customer_account`";
                                $customer_res = $conn->query($customer_sql);
                                $customer_row = $customer_res->fetch_assoc();
                                ?>
                                <h3 class="text-success number"><?= $customer_row['customer'] ?></h3>
                                <p class="stat-text">Total Customers</p>
                            </div>
                        </div>
                        <div class="col-sm-6 pl-sm-2 statistics-grid">
                            <div class="card card_border border-primary-top p-4">
                                <i class="lnr lnr-cart"> </i>
                                <h3 class="text-danger number">1,250k</h3>
                                <p class="stat-text">Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //statistics data -->

        <!-- accordions -->
        <div class="accordions">
            <div class="row">
                <!-- accordion style 1 -->
                <div class="col-lg-12 mb-4">
                    <div class="card card_border">
                        <div class="card-header chart-grid__header">
                            Bootstrap Accordions
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header bg-white p-0" id="headingOne">
                                        <a href="#" class="card__title p-3" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">Collapsed accordion heading </a>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body para__style">
                                            Nulla tincidunt quam justo, in tincidunt tortor sollicitudin a. Donec porta
                                            posuere
                                            libero sed varius. Phasellus hendrerit commodo sem, at sagittis sapien
                                            semper quis.
                                            Etiam vitae facilisis nibh. Maecenas erat nisl, blandit at nunc a, lobortis
                                            sagittis
                                            ex. Maecenas pharetra pulvinar tincidunt.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-white p-0" id="headingTwo">
                                        <a href="#" class="card__title p-3" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">Click here to collapse accordion</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body para__style">
                                            Nulla tincidunt quam justo, in tincidunt tortor sollicitudin a. Donec porta
                                            posuere
                                            libero sed varius. Phasellus hendrerit commodo sem, at sagittis sapien
                                            semper quis.
                                            Etiam vitae facilisis nibh. Maecenas erat nisl, blandit at nunc a, lobortis
                                            sagittis
                                            ex. Maecenas pharetra pulvinar tincidunt.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-white p-0" id="headingThree">
                                        <a href="#" class="card__title p-3" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">Click here to
                                            collapse accordion</a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body para__style">
                                            Nulla tincidunt quam justo, in tincidunt tortor sollicitudin a. Donec porta
                                            posuere
                                            libero sed varius. Phasellus hendrerit commodo sem, at sagittis sapien
                                            semper quis.
                                            Etiam vitae facilisis nibh. Maecenas erat nisl, blandit at nunc a, lobortis
                                            sagittis
                                            ex. Maecenas pharetra pulvinar tincidunt.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //accordion style 1 -->
            </div>
        </div>
        <!-- //accordions -->

        <!-- modals -->
        <section class="template-cards">
            <div class="card card_border">
                <div class="cards__heading">
                    <h3>Modals - <span>2 different types of bootstrap modals</span></h3>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-6 pr-lg-2 chart-grid">
                            <div class="card text-center card_border">
                                <div class="card-header chart-grid__header">
                                    Demo modal
                                </div>
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-style" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Launch demo
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 chart-grid">
                            <div class="card text-center card_border">
                                <div class="card-header chart-grid__header">
                                    Vertical centered
                                </div>
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-style" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        Launch demo
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //modals -->

    </div>

    <!-- //content -->
</div>
<!-- main content end-->