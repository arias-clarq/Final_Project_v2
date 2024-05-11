<?php
session_start();
$_SESSION['title'] = "Help Support";
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

    </div>

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

                <table id="ticket" class="table table-hover text-capitalize" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <?php
                            if ($_SESSION['login_role'] == 1) {
                                ?>
                                <th>Employee Name</th>
                                <?php
                            }
                            ?>
                            <th>Message</th>
                            <th>Date Issued</th>
                            <th>Date Resolved</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT t.customer_id, t.ticket_id, t.employee_id, t.issue_date, t.resolve_date, t.message, t.is_resolved, c.firstname as cf, c.lastname as cl, e.firstname as ef, e.lastname as el 
                        FROM `tbl_ticket` t 
                        INNER JOIN tbl_customer_info c ON c .customer_id = t.customer_id
                        LEFT JOIN tbl_employee_info e  ON e.employee_id = t.employee_id";
                        $result = $conn->query($sql);
                        $count = 0;
                        while ($row = $result->fetch_assoc()) {
                            $count += 1;
                            $idate = strtotime($row['issue_date']);
                            $formattediDate = date("F j, Y", $idate);

                            $rdate = strtotime($row['resolve_date']);
                            $formattedrDate = date("F j, Y", $rdate);

                            if ($row['ef'] != null || $row['el'] != null) {
                                $employee_name = $row['ef'] . ' ' . $row['el'];
                            } else {
                                $employee_name = "<p class='btn btn-danger btn-sm'>Not Yet Resolve</p>";
                            }

                            ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td>
                                    <form action="customer_mgt.php" method="post">
                                        <input type="hidden" value="<?= $row['customer_id'] ?>" name="o_customer_id"
                                            value="example">
                                        <button type="submit"
                                            class="btn text-primary text-capitalize"><?= $row['cf'] . ' ' . $row['cl'] ?></button>
                                    </form>
                                </td>
                                <?php
                                if (($row['ef'] != null || $row['el'] != null) && $_SESSION['login_role'] == 1) {
                                    ?>
                                    <td>
                                        <form action="employee_mgt.php" method="post">
                                            <input type="hidden" value="<?= $row['employee_id'] ?>" name="o_employee_id"
                                                value="example">
                                            <button type="submit"
                                                class="btn text-primary text-capitalize"><?= $employee_name ?></button>
                                        </form>
                                    </td>
                                <?php } else if ($_SESSION['login_role'] == 1) { ?>
                                        <td><?= $employee_name ?></td>
                                <?php } ?>
                                <td><textarea class="form-control"><?= $row['message'] ?></textarea></td>
                                <td><?= $formattediDate ?></td>
                                <td><?= ($row['resolve_date'] != null) ? $formattedrDate : "<p class='btn btn-danger btn-sm'>Not Yet Resolve</p>" ?>
                                </td>
                                <td>
                                    <!-- resolve trigger modal -->
                                    <button type="button" class="btn btn-success btn-style mb-3" data-toggle="modal"
                                        data-target="#resolve<?= $row['ticket_id'] ?>">
                                        Mark As Resolve
                                    </button>

                                    <!-- resolve Modal -->
                                    <div class="modal fade" id="resolve<?= $row['ticket_id'] ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="../config/ticket/update.php" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Mark This As
                                                            Resolved?
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                        <input type="hidden" name="id" value="<?= $row['ticket_id'] ?>">
                                                        <input type="hidden" name="e_id"
                                                            value="<?= $_SESSION['login_id'] ?>">
                                                        <button type="submit" class="btn btn-success">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
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

    <!-- //content -->
</div>
<!-- main content end-->

<script>
    new DataTable('#ticket');
</script>

<?php include '../template/footer.php'; ?>b