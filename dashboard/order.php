<?php
session_start();
$_SESSION['title'] = "Order List";
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

                    <table id="orders" class="table table-hover text-capitalize" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Purchase</th>
                                <th>Customer Name</th>
                                <th>Purchase Quantity</th>
                                <th>Payed</th>
                                <th>Total Cost</th>
                                <th>Received Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT *, (CASE WHEN `is_delivered` = 1 THEN 1 ELSE 0 END) as delivered FROM `tbl_order` 
                            INNER JOIN tbl_customer_info ON tbl_customer_info.customer_info_id = tbl_order.customer_id
                            INNER JOIN tbl_product ON tbl_product.product_id = tbl_order.product_id
                            ORDER BY delivered ASC";
                            $result = $conn->query($sql);
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count++;
                                if ($row['is_delivered'] != 0) {
                                    $deliver_text = "Cancel This Delivery?";
                                    $text = "Mark As Delivered";
                                    $color = "btn-success";
                                } else {
                                    $deliver_text = "Deliver this order?";
                                    $text = "Ship Order";
                                    $color = "btn-danger";
                                }
                                if ($row['is_received'] != 0) {
                                    $text2 = "Received";
                                    $color2 = "btn-success";
                                } else {
                                    $text2 = "Not Recieved";
                                    $color2 = "btn-danger";
                                }
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <form action="product.php" method="post">
                                            <input type="hidden" value="<?= $row['product_id'] ?>" name="o_product_id"
                                                value="example">
                                            <button type="submit"
                                                class="btn text-primary text-capitalize"><?= $row['product_name'] ?></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="customer_mgt.php" method="post">
                                            <input type="hidden" value="<?= $row['customer_id'] ?>" name="o_customer_id"
                                                value="example">
                                            <button type="submit"
                                                class="btn text-primary text-capitalize"><?= $row['firstname'] . ' ' . $row['lastname'] ?></button>
                                        </form>
                                    </td>
                                    <td><?= $row['quantity_buy'] ?></td>
                                    <td><?= $row['payed'] ?></td>
                                    <td><?= $row['total_cost'] ?></td>
                                    <td><p class="btn btn-sm <?= $color2 ?>"><?= $text2 ?></p></td>
                                    <td>
                                        <!-- deliver trigger modal -->
                                        <button type="button" class="btn <?= $color ?> btn-sm mb-3" data-toggle="modal"
                                            data-target="#deliver<?= $row['order_id'] ?>">
                                            <?= $text ?>
                                        </button>

                                        <!-- deliver Modal -->
                                        <div class="modal fade" id="deliver<?= $row['order_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="../config/product/order.php" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                Order | <?= $row['order_id'] ?>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h5><?=$deliver_text?></h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="id" value="<?= $row['order_id'] ?>">
                                                            <input type="hidden" name="deliver" value="<?= $row['is_delivered'] ?>">
                                                            <button name="order" type="submit"
                                                                class="btn btn-success">Confirm</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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
    new DataTable('#orders');
</script>

<?php include '../template/footer.php'; ?>b