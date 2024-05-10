<?php
session_start();
$_SESSION['title'] = "Product Listing";
include '../template/header.php';
?>

<!-- main content start -->
<div class="main-content">

    <!-- content -->
    <div class="container-fluid content-top-gap">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Inventory Management</a></li>
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

                    <!-- add trigger modal -->
                    <button type="button" class="btn btn-primary btn-style mb-3" data-toggle="modal"
                        data-target="#add-prod">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>

                    <table id="product" class="table table-hover text-capitalize" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Expiry Date</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>SRP</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['o_product_id'])) {
                                $get_id = $_POST['o_product_id'];
                                $sql = "SELECT * FROM `tbl_product` 
                                INNER JOIN tbl_supplier ON tbl_supplier.supplier_id = tbl_product.supplier_id
                                INNER JOIN tbl_category ON tbl_category.category_id = tbl_product.category_id WHERE `product_id` = $get_id";
                            } else {
                                $sql = "SELECT * FROM `tbl_product` 
                                INNER JOIN tbl_supplier ON tbl_supplier.supplier_id = tbl_product.supplier_id
                                INNER JOIN tbl_category ON tbl_category.category_id = tbl_product.category_id";
                            }

                            $result = $conn->query($sql);
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count += 1;
                                $date = strtotime($row['expiry_date']);
                                $formattedDate = date("F j, Y", $date);
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <div class="row"><img src="../assets/images/<?= $row['image'] ?>" width="100"
                                                height="100"></div>
                                        <div class="row"><?= $row['product_name'] ?></div>
                                    </td>
                                    <td><?= $row['description'] ?></td>
                                    <td><?= $formattedDate ?></td>
                                    <td><?= $row['category'] ?></td>
                                    <td><?= $row['supplier_name'] ?></td>
                                    <td>₱<?= $row['price'] ?></td>
                                    <td><?= $row['stock'] ?></td>
                                    <td>
                                        <!-- edit trigger modal -->
                                        <button type="button" class="btn btn-info btn-style mb-3" data-toggle="modal"
                                            data-target="#edit-prod<?= $row['product_id'] ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit-prod<?= $row['product_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="../config/product/edit.php" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Product
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Product Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter Product"
                                                                    value="<?= $row['product_name'] ?>" name="product"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea class="form-control"
                                                                    placeholder="Enter Description" name="description"
                                                                    required><?= $row['description'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Expiration Date</label>
                                                                <input type="date" class="form-control"
                                                                    placeholder="Enter Address"
                                                                    value="<?= $row['expiry_date'] ?>" name="expiry_date"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Category</label>
                                                                <select class="form-control text-capitalize input-style"
                                                                    name="category">
                                                                    <option selected disabled>Select a Category</option>
                                                                    <?php
                                                                    $cat_sql = "SELECT * FROM `tbl_category`";
                                                                    $cat_result = $conn->query($cat_sql);
                                                                    while ($cat_row = $cat_result->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $cat_row['category_id'] ?>"
                                                                            <?= ($row['category_id'] == $cat_row['category_id']) ? "selected" : "" ?>>
                                                                            <?= $cat_row['category'] ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Supplier</label>
                                                                <select class="form-control text-capitalize input-style"
                                                                    name="supplier">
                                                                    <option selected disabled>Select a Supplier</option>
                                                                    <?php
                                                                    $cat_sql = "SELECT * FROM `tbl_supplier`";
                                                                    $cat_result = $conn->query($cat_sql);
                                                                    while ($cat_row = $cat_result->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $cat_row['supplier_id'] ?>"
                                                                            <?= ($row['supplier_id'] == $cat_row['supplier_id']) ? "selected" : "" ?>>
                                                                            <?= $cat_row['supplier_name'] ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>SRP</label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="Enter SRP" name="price"
                                                                    value="<?= $row['price'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Stock qty</label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="Enter quantity" name="stock"
                                                                    value="<?= $row['stock'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="id"
                                                                value="<?= $row['product_id'] ?>">
                                                            <button type="submit" class="btn btn-success">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <?php
                                        if ($_SESSION['login_role'] == 1) {
                                            ?>

                                            <!-- delete trigger modal -->
                                            <button type="button" class="btn btn-danger btn-style mb-3" data-toggle="modal"
                                                data-target="#delete-prod<?= $row['product_id'] ?>">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>

                                            <?php
                                        }
                                        ?>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete-prod<?= $row['product_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="../config/product/delete.php" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete
                                                                Product
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h5>Are you sure you want to delete this product?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="id"
                                                                value="<?= $row['product_id'] ?>">
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

    </div>

    <!-- //content -->
</div>
<!-- main content end-->

<!-- Add Modal -->
<div class="modal fade" id="add-prod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../config/product/add.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" placeholder="Enter Product" name="product" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" placeholder="Enter Description" name="description"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Expiration Date</label>
                        <input type="date" class="form-control" placeholder="Enter Address" name="expiry_date" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control text-capitalize input-style" name="category">
                            <option selected disabled>Select a Category</option>
                            <?php
                            $cat_sql = "SELECT * FROM `tbl_category`";
                            $cat_result = $conn->query($cat_sql);
                            while ($cat_row = $cat_result->fetch_assoc()) {
                                ?>
                                <option value="<?= $cat_row['category_id'] ?>"><?= $cat_row['category'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select class="form-control text-capitalize input-style" name="supplier">
                            <option selected disabled>Select a Supplier</option>
                            <?php
                            $cat_sql = "SELECT * FROM `tbl_supplier`";
                            $cat_result = $conn->query($cat_sql);
                            while ($cat_row = $cat_result->fetch_assoc()) {
                                ?>
                                <option value="<?= $cat_row['supplier_id'] ?>"><?= $cat_row['supplier_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>SRP</label>
                        <input type="number" class="form-control" placeholder="Enter SRP" name="price" required>
                    </div>
                    <div class="form-group">
                        <label>Stock qty</label>
                        <input type="number" class="form-control" placeholder="Enter quantity" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Image(Optional)</label>
                        <input type="file" class="form-control-file" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button name="submit" type="submit" class="btn btn-success">Confirm</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    new DataTable('#product');
</script>

<?php include '../template/footer.php'; ?>