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

    </div>

    <!-- content block style 4 -->
    <div class="card card_border p-lg-5 p-3 mb-4">
        <div class="card-body py-3 p-0">
            <h3 class="block__title mb-lg-4">Product List</h3>
            <div class="row">
                <?php
                $sql = "SELECT * FROM `tbl_product` 
                        INNER JOIN tbl_supplier ON tbl_supplier.supplier_id = tbl_product.supplier_id
                        INNER JOIN tbl_category ON tbl_category.category_id = tbl_product.category_id";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 column mt-md-3 mt-3">
                        <form action="" method="post">
                            <a href="#img1"><img class="img-fluid rounded"
                                    src="../assets/images/<?= ($row['image'] != null) ? $row['image'] : "template.png" ?>"
                                    alt=""></a>
                            <a href="#para1">
                                <p class="grid-para">Product:   <?= $row['product_name'] ?></p>
                                <p class="grid-para">Description: <?= $row['description'] ?></p>
                            </a>
                            <a href="#caption1">
                                <p class="paragraph text-primary">Price: ₱<?= $row['price'] ?></p>
                            </a>
                            <input type="hidden" name="id" value="<?= $row['product_id'] ?>">
                            <button type="submit" class="btn btn-success">Add To Cart</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- //content block style 4 -->

    <!-- //content -->
</div>
<!-- main content end-->
<?php include 'customer-template/customer-footer.php'; ?>