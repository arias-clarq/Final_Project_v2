<?php
session_start();
$_SESSION['title'] = "Category";
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
                        data-target="#add-cat">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>

                    <table id="category" class="table table-hover text-capitalize" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `tbl_category`";
                            $result = $conn->query($sql);
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count += 1;
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $row['category'] ?></td>
                                    <td>
                                        <!-- edit trigger modal -->
                                        <button type="button" class="btn btn-info btn-style mb-3" data-toggle="modal"
                                            data-target="#edit-cat<?= $row['category_id'] ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit-cat<?= $row['category_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="../config/category/edit.php" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Category
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" value="<?= $row['category'] ?>"
                                                                    class="form-control" placeholder="Enter New Category"
                                                                    name="category">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="id"
                                                                value="<?= $row['category_id'] ?>">
                                                            <button type="submit" class="btn btn-success">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- delete trigger modal -->
                                        <button type="button" class="btn btn-danger btn-style mb-3" data-toggle="modal"
                                            data-target="#delete-cat<?= $row['category_id'] ?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete-cat<?= $row['category_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="../config/category/delete.php" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete
                                                                Category
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h5>Are you sure you want to delete this category?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="id"
                                                                value="<?= $row['category_id'] ?>">
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
<div class="modal fade" id="add-cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../config/category/add.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter New Category" name="category"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    new DataTable('#category');
</script>

<?php include '../template/footer.php'; ?>