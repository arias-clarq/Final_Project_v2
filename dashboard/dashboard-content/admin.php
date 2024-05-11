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
                                <?php
                                $order_sql = "SELECT COUNT(*) as 'order' FROM `tbl_order`";
                                $order_res = $conn->query($order_sql);
                                $order_row = $order_res->fetch_assoc();
                                
                                ?>
                                <h3 class="text-danger number"><?= $order_row['order'] ?></h3>
                                <p class="stat-text">Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 pr-xl-2">
                    <div class="row">
                        <div class="col-sm-6 pr-sm-2 statistics-grid">
                            <div class="card card_border border-primary-top p-4">
                                <i class="lnr lnr-calendar-full text-info"> </i>
                                <?php
                                $attendance_sql = "SELECT COUNT(*) as attendance FROM `tbl_attendance`";
                                $attendance_res = $conn->query($attendance_sql);
                                $attendance_row = $attendance_res->fetch_assoc();
                                ?>
                                <h3 class="text-primary number"><?= $attendance_row['attendance'] ?></h3>
                                <p class="stat-text">Total Attendance</p>
                            </div>
                        </div>
                        <div class="col-sm-6 pl-sm-2 statistics-grid">
                            <div class="card card_border border-primary-top p-4">
                                <i class="lnr lnr-users"> </i>
                                <?php
                                $ticket_sql = "SELECT COUNT(*) as ticket FROM `tbl_ticket` WHERE is_resolved = 1";
                                $ticket_res = $conn->query($ticket_sql);
                                $ticket_row = $ticket_res->fetch_assoc();
                                ?>
                                <h3 class="text-primary number"><?= $ticket_row['ticket'] ?></h3>
                                <p class="stat-text">Total Ticket Resolved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //statistics data -->

        <!-- employee -->
        <section class="forms">
            <!-- forms 1 -->
            <div class="card card_border py-2 mb-4">
                <div class="cards__heading">
                    <h3>Employee List <span></span></h3>
                </div>
                <div class="card-body">
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
                    <table id="employee" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $admin_id = $_SESSION['login_id'];
                            $sql = "SELECT * FROM `tbl_employee_account` INNER JOIN tbl_login_role ON tbl_employee_account.login_role_id = tbl_login_role.login_role_id";
                            $result = $conn->query($sql);
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count += 1;
                                ?>
                                <tr>
                                    <th scope="row"><?= $count ?></th>
                                    <td><?= $row['username'] ?></td>
                                    <td>********</td>
                                    <td class="text-capitalize"><?= $row['login_role'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="../forms/view-forms/employee.php" method="post" class="me-2">
                                                <input type="hidden" name="id" value="<?= $row['employee_id'] ?>">
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-eye"
                                                        aria-hidden="true"></i> View</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- //forms 1 -->

        </section>

        <!-- customer -->
        <section class="forms">
            <!-- forms 1 -->
            <div class="card card_border py-2 mb-4">
                <div class="cards__heading">
                    <h3>Customer List <span></span></h3>
                </div>
                <div class="card-body">
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
                    <table id="customer" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['o_customer_id'])) {
                                $get_id = $_POST['o_customer_id'];
                                $sql = "SELECT * FROM `tbl_customer_account` INNER JOIN tbl_login_role ON tbl_customer_account.login_role_id = tbl_login_role.login_role_id WHERE `customer_id` = $get_id";
                            } else {
                                $sql = "SELECT * FROM `tbl_customer_account` INNER JOIN tbl_login_role ON tbl_customer_account.login_role_id = tbl_login_role.login_role_id";
                            }
                            $result = $conn->query($sql);
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count += 1;
                                ?>
                                <tr>
                                    <th scope="row"><?= $count ?></th>
                                    <td><?= $row['username'] ?></td>
                                    <td>********</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="../forms/view-forms/customer.php" method="post" class="me-2">
                                                <input type="hidden" name="id" value="<?= $row['customer_id'] ?>">
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-eye"
                                                        aria-hidden="true"></i> View</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- //forms 1 -->

        </section>

    </div>

    <!-- //content -->
</div>
<!-- main content end-->

<script>
    new DataTable('#employee');
    new DataTable('#customer');
</script>