<?php
session_start();
$_SESSION['title'] = "Dashboard";
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

        <!-- people -->
        <section class="people">
            <section class="w3l-team-block">
                <!-- //people cards style 1 -->
                <div class="card card_border mb-5">
                    <div class="cards__heading">
                        <h3>Product List<span></span></h3>
                    </div>
                    <div class="card-body">
                        <div class="teams mb-4">
                            <div class="row px-2">
                                <?php
                                $sql = "SELECT * FROM `tbl_product` 
                                INNER JOIN tbl_supplier ON tbl_supplier.supplier_id = tbl_product.supplier_id
                                INNER JOIN tbl_category ON tbl_category.category_id = tbl_product.category_id";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['stock'] > 0) {
                                        $status = "btn btn-success";
                                        $msg = "Available";
                                    } else {
                                        $status = "btn btn-danger";
                                        $msg = "Unavailable";
                                    }
                                    ?>
                                    <div class="col-lg-3 col-md-6 mb-lg-0 mb-4 px-2">
                                        <div class="item">
                                            <div class="d-team-grid team-info">
                                                <div class="column">
                                                    <a type="button" data-toggle="modal" data-target="#ord-prod">
                                                        <img src="../assets/images/<?= ($row['image'] != null) ? $row['image'] : "template.png" ?>"
                                                            alt="" height="400" width="100%" />
                                                    </a>
                                                </div>
                                                <div class="team-member">
                                                    <div class="input-group mb-3 <?= $status ?> justify-content-center">
                                                        <span><?= $msg ?></span>
                                                    </div>
                                                    <h3 class="name-pos mb-0"><?= $row['product_name'] ?></h3>
                                                    <p class="card-title text-primary">Price: ₱<?= $row['price'] ?></p>
                                                    <p>Description: <?= $row['description'] ?></p>
                                                    <div class="social">
                                                        <!-- add trigger modal -->
                                                        <button type="button" class="btn btn-success btn-style mt-3 mb-3"
                                                            data-toggle="modal" data-target="#ord-prod<?= $row['product_id'] ?>">
                                                            <i class="fa fa-cart-shopping" aria-hidden="true"></i> Add To
                                                            Cart
                                                        </button>

                                                        <!-- Add Modal -->
                                                        <div class="modal fade" id="ord-prod<?= $row['product_id'] ?>" tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <form action="../config/product/order.php" method="post"
                                                                        enctype="multipart/form-data">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLongTitle">
                                                                                Add To Cart</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text">Product
                                                                                    Name</span>
                                                                                <input type="text"
                                                                                    value="<?= $row['product_name'] ?>"
                                                                                    class="form-control" name="product_name"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text">Price</span>
                                                                                <input type="number"
                                                                                    value="<?= $row['price'] ?>"
                                                                                    class="form-control"
                                                                                    name="product_price" readonly>
                                                                            </div>
                                                                            <div class="input-group mb-3">
                                                                                <span
                                                                                    class="input-group-text">Description</span>
                                                                                <textarea name="description"
                                                                                    class="form-control">
                                                                                                                <?= $row['description'] ?>
                                                                                                            </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            <input type="hidden" name="product_id"
                                                                                value="<?= $row['product_id'] ?>">
                                                                            <input type="hidden" name="product_stock"
                                                                                value="<?= $row['stock'] ?>">
                                                                            <button name="add_cart" type="submit"
                                                                                class="btn btn-success">Confirm</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- //teams1 -->
        </section>
        <!-- //people -->

    </div>

    <!-- //content -->
</div>
<!-- main content end-->
<?php include 'customer-template/customer-footer.php'; ?>