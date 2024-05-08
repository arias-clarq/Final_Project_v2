<?php
session_start();
$_SESSION['title'] = "Attendance Monitoring";
include '../template/header.php';
?>

<!-- main content start -->
<div class="main-content">

    <!-- content -->
    <div class="container-fluid content-top-gap">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
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

                    <table id="attendance" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>TimeIn</th>
                                <th>TimeOut</th>
                                <th>Status</th>
                                <th>Start Shift</th>
                                <th>WorkTime_Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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
    new DataTable('#attendance');
</script>

<?php include '../template/footer.php'; ?>