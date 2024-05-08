<?php
session_start();
$_SESSION['title'] = "Employee Delete Form";
include '../form-template/form-header.php';

$id = $_POST['id'];
$sql = "SELECT * FROM `tbl_employee_info` 
INNER JOIN tbl_job ON tbl_employee_info.job_id = tbl_job.job_id 
INNER JOIN tbl_relation ON tbl_employee_info.relation_id = tbl_relation.relation_id
INNER JOIN tbl_bill ON tbl_employee_info.bill_id = tbl_bill.bill_id
WHERE `employee_id` = $id";
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
        <form action="../../config/customer/delete.php" method="post">
            <section class="forms">

                <!-- form -->
                <div class="card card_border py-2 mb-4 d-flex justify-content-center align-items-center">
                    <div class="cards__heading">
                        <h3>Delete this account?<span></span></h3>
                        <h6><span></span><?= $_POST['username'] ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <form action="../../config/customer/delete.php" method="post">
                                <input type="hidden" value="<?= $_POST['id'] ?>" name="id">
                                <button type="submit" class="btn btn-success">Confirm</button>
                                <a href="../../dashboard/customer_mgt.php">
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                </a>
                            </form>
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