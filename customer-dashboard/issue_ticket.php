<?php
session_start();
$_SESSION['title'] = "Issued Ticket";
include 'customer-template/customer-header.php'; ?>
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
                            <th>Employee Name</th>
                            <th>Message</th>
                            <th>Date Issued</th>
                            <th>Date Resolved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT t.customer_id, t.ticket_id, t.employee_id, t.issue_date, t.resolve_date, t.message, t.is_resolved, e.firstname as ef, e.lastname as el 
                        FROM `tbl_ticket` t 
                        LEFT JOIN tbl_employee_info e  ON e.employee_id = t.employee_id WHERE t.customer_id = '{$_SESSION['login_id']}'";
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
                                <td><?= $employee_name ?></td>
                                <td><textarea class="form-control"><?= $row['message'] ?></textarea></td>
                                <td><?= $formattediDate ?></td>
                                <td><?= ($row['resolve_date'] != null) ? $formattedrDate : "<p class='btn btn-danger btn-sm'>Not Yet Resolve</p>" ?>
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
<?php include 'customer-template/customer-footer.php'; ?>