<?php
include("../Model/db.php");
session_start();
error_reporting(0);

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../layouts/head.layout.php") ?>
    <title>My Account</title>
</head>

<body>
    <?php
    $user = mysqli_fetch_assoc(getrecord('user_details', 'id', $_SESSION['id']));
    ?>
    <div class="page-wrapper">
        <?php include("../layouts/header_layout.php"); ?>
        <div class="container mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Purchase</li>
                </ol>
            </nav>
        </div>
        <main class="main mt-3">
            <div class="page-content">
                <div class="dashboard">
                    <div class="container-fluid">
                        <div class="row">
                            <aside class="col-md-2 col-lg-2" style="border-right: 1px solid #ebebeb;">
                                <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist"
                                    style="height:600px;">
                                    <li class="nav-item">
                                        <a href="myAccount.php" class="nav-link">My Account</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="gcash_info.php" class="nav-link">Gcash Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="myProduct.php" class="nav-link">My Product</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="manageOrder.php" class="nav-link">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="myPurchase.php" class="nav-link active">My Purchase</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="myShop.php" class="nav-link">My shop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="mySubscription.php" class="nav-link">Manage Subscription</a>
                                    </li>
                                </ul>
                            </aside>
                            <div class="col-10">
                                <table class="table table-hover text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Status</th>
                                            <th>Total Price</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $a = getOrder('orders', $_SESSION['id']);
                                        while ($buyer = mysqli_fetch_assoc($a)):
                                            $productDetails = mysqli_fetch_assoc(displayDetails('product_details', 'id', $buyer['product_id']));
                                            $cart = mysqli_fetch_assoc(displayDetails('carts', 'id', $buyer['cart_id']));
                                            $count++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $count ?>
                                                </td>
                                                <td>
                                                    <?= $productDetails['product_name'] ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info">
                                                        <?= $buyer['status'] ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    <?= $buyer['total'] ?>
                                                </td>
                                                <td>
                                                    <form action="../Controller/orderController.php" method="POST">
                                                        <a href="#viewmore-Modal<?php echo $buyer['id'] ?>"
                                                            data-toggle="modal" class="btn btn-success">View More</a>
                                                        <a href="chat.php?user=<?php echo $buyer['seller_id']?>" class="btn btn-primary">Chat Seller</a>
                                                        <input type="hidden" value="<?php echo $buyer['id'] ?>"
                                                            name="order_id">
                                                        <button type="submit" name="CANCELORDER"
                                                            class="btn btn-danger">Cancel Order</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- VIEW MORE MODAL -->
                                            <div class="modal fade" id="viewmore-Modal<?php echo $buyer['id'] ?>"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog custom-modal add-modal" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <p>View More Details</p>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true"><i class="icon-close"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="padding:30px;">
                                                            <div class="form-group">
                                                                <label>Product Name</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?= $productDetails['product_name'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Quantity</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?= $cart['quantity'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Product Size</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?= $cart['size'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Product Color</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?= $cart['color'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger products"
                                                                data-dismiss="modal" aria-label="Close">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include("../layouts/footer.layout1.php"); ?>
    </div>
    <?php
    include("../layouts/jsfile.layout.php");
    include("toastr.php");
    ?>
</body>

</html>
