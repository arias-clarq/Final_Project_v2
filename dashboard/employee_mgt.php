<?php
session_start();
$_SESSION['title'] = "Employee Management";
include '../template/header.php';
?>

<!-- main content start -->
<div class="main-content">

    <!-- content -->
    <div class="container-fluid content-top-gap">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="#">User Management</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $_SESSION['title'] ?></li>
            </ol>
        </nav>

        <section class="forms">
            <!-- forms 1 -->
            <div class="card card_border py-2 mb-4">
                <div class="cards__heading">
                    <h3><?= $_SESSION['title'] ?> <span></span></h3>
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
                    <div class="mb-3 d-flex">
                        <a href="../forms/add-forms/employee.php" type="button" class="btn btn-primary"><i
                                class="fa fa-plus" aria-hidden="true"></i> New</a>
                    </div>
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

                            if (isset($_POST['o_employee_id'])) {
                                $get_id = $_POST['o_employee_id'];
                                $sql = "SELECT * FROM `tbl_employee_account` INNER JOIN tbl_login_role ON tbl_employee_account.login_role_id = tbl_login_role.login_role_id WHERE `employee_id` = $get_id";
                            } else {
                                $sql = "SELECT * FROM `tbl_employee_account` INNER JOIN tbl_login_role ON tbl_employee_account.login_role_id = tbl_login_role.login_role_id WHERE `employee_id` != $admin_id";
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
                                    <td class="text-capitalize"><?= $row['login_role'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="../forms/view-forms/employee.php" method="post" class="me-2">
                                                <input type="hidden" name="id" value="<?= $row['employee_id'] ?>">
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-eye"
                                                        aria-hidden="true"></i> View</button>
                                            </form>
                                            <form action="../forms/edit-forms/employee.php" method="post" class="me-2">
                                                <input type="hidden" name="id" value="<?= $row['employee_id'] ?>">
                                                <button type="submit" class="btn btn-info"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i> Edit</button>
                                            </form>
                                            <form action="../forms/delete-forms/employee.php" method="post">
                                                <input type="hidden" value="<?= $row['username'] ?>" name="username">
                                                <input type="hidden" value="<?= $row['employee_id'] ?>" name="id">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                        aria-hidden="true"></i> Delete</button>
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
</script>

<?php include '../template/footer.php'; ?>