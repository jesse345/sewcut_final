<?php
include("../Model/db.php");
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include("../layouts/head.layout.php") ?>
    <style>
        .btn {
            min-width: 100px;
        }
    </style>
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
                    <li class="breadcrumb-item active" aria-current="page">My Order</li>
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
                                        <a href="myProduct.php" class="nav-link">My Product</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="manageOrder.php" class="nav-link active">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="myPurchase.php" class="nav-link">My Purchase</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="myShop.php" class="nav-link">My shop</a>
                                    </li>
                                </ul>
                            </aside>
                            <div class="col-10">
                                <?php $sel = getOrderEachBuyer('orders', $_SESSION['id']);
                                while ($seller = mysqli_fetch_assoc($sel)):
                                    ?>
                                    <h6>Order by:</h6>
                                    <table class="table table-hover text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Order By</th>
                                                <th>Product Name</th>
                                                <th>Total Price</th>
                                                <th>Payment Type</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $b = getOrderSeller('orders', $_SESSION['id']);
                                            while ($c = mysqli_fetch_assoc($b)):
                                                $orderby = mysqli_fetch_assoc(getrecord('user_details', 'id', $c['user_id']));
                                                $order_payments = mysqli_fetch_assoc(getrecord('order_payments', 'order_id', $c['id']));
                                                $productDetails = mysqli_fetch_assoc(displayDetails('product_details', 'id', $c['product_id']));
                                                $cart = mysqli_fetch_assoc(displayDetails('carts', 'id', $c['cart_id']));
                                                $count++;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $c['id'] ?>
                                                    </td>
                                                    <td>
                                                        <?= ucfirst($orderby['firstname']) . ' ' . ucfirst($orderby['lastname']) ?>
                                                    </td>
                                                    <td>
                                                        <?= $productDetails['product_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($cart['total'], 2) ?>
                                                    </td>
                                                    <?php if ($c['payment_type'] == 'onlinepayment') { ?>
                                                        <td>
                                                            Online Payment
                                                        </td>
                                                        <td>
                                                            <a href="#viewmore-Modal<?php echo $c['id'] ?>" data-toggle="modal"
                                                                class="btn btn-info">View More</a>
                                                            <a href="#viewReceipt-Modal<?php echo $c['id'] ?>" data-toggle="modal"
                                                                class="btn btn-info">View Receipt</a>
                                                            <button class="btn btn-info">Chat Buyer</button>
                                                            <button class="btn btn-success">Approve</button>
                                                            <button class="btn btn-danger">Disapprove</button>
                                                        </td>

                                                    <?php } else { ?>
                                                        <td>
                                                            Cash On Delivery
                                                        </td>
                                                        <button class="btn btn-info">View More</button>
                                                        <button class="btn btn-info">Chat Buyer</button>
                                                        <button class="btn btn-success">Approve</button>
                                                        <button class="btn btn-danger">Disapprove</button>
                                                    <?php } ?>
                                                </tr>
                                                <!-- VIEW Receitp -->
                                                <div class="modal fade" id="viewReceipt-Modal<?php echo $c['id'] ?>"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog custom-modal add-modal" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <p>View Receipt</p>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true"><i class="icon-close"></i></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" style="padding:30px;">
                                                                <p>This receipt is for 3 and 4 Order ID only</p>
                                                                <div class="form-group">
                                                                    <label>Reference Number</label>
                                                                    <input type="text" class="form-control" value="" readonly>
                                                                </div>
                                                                <img src="" alt="">

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
                                                <!-- VIEW MORE MODAL -->
                                                <div class="modal fade" id="viewmore-Modal<?php echo $c['id'] ?>" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
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
                                <?php endwhile; ?>
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
