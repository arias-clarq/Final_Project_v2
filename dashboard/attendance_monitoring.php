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
                            <?php
                            $attendance_sql = "SELECT * FROM `tbl_attendance` 
                                RIGHT JOIN tbl_employee_account ON tbl_employee_account.employee_id = tbl_attendance.employee_id
                                INNER JOIN tbl_worktime_status ON tbl_worktime_status.worktime_status_id = tbl_attendance.worktime_status_id
                                INNER JOIN tbl_attendance_status ON tbl_attendance_status.attendance_status_id = tbl_attendance.attendance_status_id";
                            $attendance_result = $conn->query($attendance_sql);
                            $count = 0;
                            while ($attendance_row = $attendance_result->fetch_assoc()) {

                                $count += 1;
                                $date = strtotime($attendance_row['date']);
                                $formattedDate = date("F j, Y", $date);

                                $timeIn = strtotime($attendance_row['time_in']);
                                $formattedTimeIn = date("g:i:s A", $timeIn);

                                if ($attendance_row['time_out'] != null) {
                                    $timeOut = strtotime($attendance_row['time_out']);
                                    $formattedTimeOut = date("g:i:s A", $timeOut);
                                } else {
                                    $formattedTimeOut = null;
                                }


                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $attendance_row['username'] ?></td>
                                    <td><?= $formattedDate ?></td>
                                    <td><?= $formattedTimeIn ?></td>
                                    <td><?= ($formattedTimeOut != null) ? $formattedTimeOut : 'PENDING' ?></td>
                                    <td><?= $attendance_row['attendance_status'] ?></td>
                                    <td>9 AM</td>
                                    <td><?= $attendance_row['worktime_status'] ?></td>
                                    <td>
                                        <form action="../forms/edit-forms/attendance.php" method="post" class="me-2">
                                            <input type="hidden" name="id" value="<?= $attendance_row['attendance_id'] ?>">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i> Edit</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
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