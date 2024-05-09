<?php
session_start();
$_SESSION['title'] = "Attendance Edit Form";
include '../form-template/form-header.php';

$id =  $_POST['id'];
$sql = "SELECT * FROM `tbl_attendance` 
RIGHT JOIN tbl_employee_account ON tbl_employee_account.employee_id = tbl_attendance.employee_id
INNER JOIN tbl_worktime_status ON tbl_worktime_status.worktime_status_id = tbl_attendance.worktime_status_id
INNER JOIN tbl_attendance_status ON tbl_attendance_status.attendance_status_id = tbl_attendance.attendance_status_id
WHERE `attendance_id` = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
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

        <form action="../../config/employee/attendance_edit.php" method="post">

            <section class="forms">
                <!-- account -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Attendance<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" value="<?= isset($row['username']) ? $row['username'] : "" ?>"
                                    class="form-control" name="username" readonly>
                            </div>
                            <div class="form-group">
                                <label>Attendance Date:</label>
                                <div class="input-group">
                                    <input type="date" value="<?= isset($row['date']) ? $row['date'] : "" ?>" name="date" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Time In:</label>
                                <div class="input-group">
                                    <input type="datetime-local" value="<?= isset($row['time_in']) ? $row['time_in'] : "" ?>" name="time_in" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Time Out:</label>
                                <div class="input-group">
                                    <input type="datetime-local" value="<?= isset($row['time_out']) ? $row['time_out'] : "" ?>" name="time_out" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </form>


    </div>

    <!-- //content -->
</div>
<!-- main content end-->
<?php include '../form-template/form-footer.php'; ?>