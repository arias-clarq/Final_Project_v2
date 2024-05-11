<?php
session_start();
$_SESSION['title'] = "Your Purchase";
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
                    <h5 class="text-primary mt-3">Note |<span> Upon receiving of item mark it as received to complete your purchase</span></h5>
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

                    <table id="purchase" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Purchase</th>
                                <th>Purchase Quantity</th>
                                <th>Payed</th>
                                <th>Total Cost</th>
                                <th>Deliver Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT *, (CASE WHEN `is_delivered` = 1 THEN 1 ELSE 0 END) as delivered FROM `tbl_order` 
                            INNER JOIN tbl_customer_info ON tbl_customer_info.customer_info_id = tbl_order.customer_id
                            INNER JOIN tbl_product ON tbl_product.product_id = tbl_order.product_id 
                            WHERE `tbl_order`.`customer_id`= {$_SESSION['login_id']} AND `is_received` != 1
                            ORDER BY delivered DESC";
                            $result = $conn->query($sql);
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count++;
                                if ($row['is_delivered'] != 0) {
                                    $text = "Being Delivered";
                                    $color = "btn-success";
                                } else {
                                    $text = "Not Yet On Delivery";
                                    $color = "btn-danger";
                                    $disabled[$count] = true;
                                }
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <?= $row['product_name'] ?>
                                    </td>
                                    <td><?= $row['quantity_buy'] ?></td>
                                    <td><?= $row['payed'] ?></td>
                                    <td><?= $row['total_cost'] ?></td>
                                    <td><p class="btn btn-sm <?= $color ?>"><?= $text ?></p></td>
                                    <td>
                                        <?php if(!isset($disabled[$count])) {?>
                                        <!-- received trigger modal -->
                                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#deliver<?= $row['order_id'] ?>">
                                            Mark as Received
                                        </button>

                                        <?php }else{ ?>
                                            <p>Your purchase is being proccess please wait</p>
                                        <?php } ?>


                                         <!-- received Modal -->
                                         <div class="modal fade" id="deliver<?= $row['order_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="../config/product/order.php" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                Mark as Received
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h5><?= $row['product_name'] ?></h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="id" value="<?= $row['order_id'] ?>">
                                                            <input type="hidden" name="received" value="<?= $row['is_received'] ?>">
                                                            <button name="mark" type="submit"
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

    <!-- //content -->
</div>
<script>
    new DataTable('#purchase');
</script>
<?php include 'customer-template/customer-footer.php'; ?>