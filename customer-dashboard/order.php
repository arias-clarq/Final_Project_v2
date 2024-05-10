<?php
session_start();
$_SESSION['title'] = "Order Page";
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
                    <table id="orders" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Cost</th>
                                <th>Action</th>
                                <th>Total Purchase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) {
                                foreach ($_SESSION['cart'] as $key => $item) {
                                    $count += 1;
                                    ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $item['product_name'] ?></td>
                                        <td>
                                            <form action="../config/product/order.php" method="post">
                                                <?= $item['product_price'] ?>
                                                <input type="hidden" class="iprice" value="<?= $item['product_price'] ?>">
                                            </form>
                                        </td>
                                        <td>
                                            <form action="../config/product/order.php" method="post">
                                                <input type="number" onchange="this.form.submit();" class="iquantity"
                                                    value="<?= $item['product_qty'] ?>" min="1"
                                                    max="<?= $item['product_stock'] ?>" name="product_qty">
                                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                            </form>
                                        </td>
                                        <td class='itotal'></td>
                                        <td>
                                            <form action="../config/product/order.php" method="post">
                                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                                <button name="remove_item" class="btn btn-outline-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <td colspan="7" class="text-center">
                                    <p>You Didnt Order Anything Yet</p>
                                </td>
                                <?php
                            }
                            ?>
                        </tbody>
                        <?php if (count($_SESSION['cart']) != 0) { ?>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                    <td>
                                        <p id="gtotal"></p>
                                        <button type="button" class="btn btn-outline-success btn-style mt-3 mb-3"
                                            data-toggle="modal" data-target="#purchase">
                                            Make Purchase
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        <?php } ?>
                    </table>

                </div>
            </div>
            <!-- //forms 1 -->

        </section>


    </div>

    <!-- //content -->
</div>

<script>
    var gt = 0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    var gtotal = document.getElementById('gtotal');

    function subtotal() {
        gt = 0;
        for (var i = 0; i < iprice.length; i++) {
            itotal[i].innerText = '₱' + (iprice[i].value) * (iquantity[i].value);
            gt += (iprice[i].value) * (iquantity[i].value);
        }
        gtotal.innerHTML = 'Total Purchase Amount: ₱' + gt;

        // Update modal content
        var modalGtotal = document.getElementById('modal-gtotal');
        if (modalGtotal) {
            modalGtotal.value = + gt;
        }
    }
    window.onload = function() {
        subtotal();
    };

</script>

<div class="modal fade" id="purchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../config/product/order.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Total Purchase Amount:</label>
                        <input type="number" id="modal-gtotal" class="form-control" name="total" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Amount Payed:</label>
                        <input type="number" class="form-control" name="amount_payed" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button name="purchase" type="submit" class="btn btn-success">Confirm</button>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- main content end-->
<?php include 'customer-template/customer-footer.php'; ?>