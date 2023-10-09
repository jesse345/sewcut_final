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
    <title>My Product</title>
    <style>
        .table.table-summary tbody td {
            border-bottom: none;
            height: 40px;
        }

        .summary-total {
            border-top: .1rem solid #ebebeb;
        }
    </style>
</head>

<body>
    <?php
    $shipping_info = mysqli_fetch_assoc(getrecord('shipping_info', 'user_id', $_SESSION['id']));
    $user = mysqli_fetch_assoc(getrecord('user_details', 'id', $_SESSION['id']));
    $p = displayDetails('product_details', 'category', 'dress');
    ?>
    <div class="page-wrapper">
        <?php include("../layouts/header_layout.php"); ?>
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <div class="page-content">
                <div class="cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <table class="table table-cart table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subTotal = 0;
                                        $cart = displayEachseller($_SESSION['id'], $_GET['seller']);
                                        $count = 0;
                                        while ($c = mysqli_fetch_assoc($cart)):
                                            $productPrice = getProductPrice($c['product_id'], $c['color'], $c['size']);
                                            $productImages = displayDetails('product_images', 'product_id', $c['product_id']);
                                            $p = mysqli_fetch_assoc($productImages);
                                            $productDetails = mysqli_fetch_assoc(displayDetails('product_details', 'id', $c['product_id']));
                                            $count++;
                                            ?>
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="#productViewMore-Modal<?php echo $c['id'] ?>"
                                                                data-toggle="modal">
                                                                <img src="<?php echo $p['image'] ?>">
                                                            </a>
                                                            <div class="modal fade"
                                                                id="productViewMore-Modal<?php echo $c['id'] ?>"
                                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog custom-modal add-modal"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="card-body">
                                                                                <label>Images and Videos</label><br>
                                                                                <img src="<?php echo $p['image'] ?>"
                                                                                    class="img-responsive">
                                                                                <?php while ($pi = mysqli_fetch_assoc($productImages)): ?>
                                                                                    <?php
                                                                                    $fileExtension = pathinfo($pi['image'], PATHINFO_EXTENSION);

                                                                                    if (in_array($fileExtension, array('jpg', 'jpeg', 'png', 'gif'))):
                                                                                        // Display Image
                                                                                        ?>
                                                                                        <img src="<?php echo $pi['image']; ?>"
                                                                                            class="img-responsive mt-3" alt="Image">
                                                                                    <?php elseif (in_array($fileExtension, array('mp4', 'avi', 'mov'))):
                                                                                        // Display Video
                                                                                        ?>
                                                                                        <video controls class="video-responsive"
                                                                                            style="margin-top:10px;width:523px;">
                                                                                            <source
                                                                                                src="<?php echo $pi['image']; ?>"
                                                                                                type="video/<?php echo $fileExtension; ?>">
                                                                                            <!-- Add more source elements for other video formats if needed -->
                                                                                            Your browser does not support the video
                                                                                            tag.
                                                                                        </video>
                                                                                    <?php endif; ?>
                                                                                <?php endwhile; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-danger products"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                Close
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a href="#">
                                                                <?= $productDetails['product_name'] ?>
                                                            </a>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                </td>
                                                <td class="price-col">
                                                    <?= $productPrice['price'] ?>
                                                </td>
                                                <td class="price-quantity">
                                                    <?= $c['quantity'] ?>
                                                </td>
                                                <td>
                                                    <?= $c['total'] ?>
                                                </td>
                                            </tr>
                                            <form action="../Controller/orderController.php" method="POST">
                                                <?php $subTotal += $c['total'] ?>
                                                <input type="hidden" name="seller_id" value="<?= $_GET['seller'] ?>">

                                                <input type="hidden" name="cart_id[]" value="<?= $c['id'] ?>">
                                                <input type="hidden" name="product_id[]" value="<?= $c['product_id'] ?>">
                                            <?php endwhile; ?>
                                            <input type="hidden" name="subTotal" value="<?= $subTotal ?>">
                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                                <div class="cart-bottom">
                                    <a href="cart.php" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i
                                            class="icon-refresh"></i></a>
                                </div><!-- End .cart-bottom -->
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary summary-cart" style="margin-top:40px;">
                                    <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->
                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-shipping-estimate">
                                                <td>Shipping Info<br> <a href="#ShippingInfo-Modal"
                                                        data-toggle="modal">Change Shipping Info</a></td>
                                                <input type="hidden" class="form-control" name="fullname"
                                                    value="<?= ucfirst($shipping_info['name']) ?>">
                                                <input type="hidden" class="form-control" name="contact_number"
                                                    value="<?= $shipping_info['contact'] ?>">
                                                <input type="hidden" class="form-control" name="address"
                                                    value="<?= $shipping_info['address'] ?>">
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>Type of Payment</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Cash On Delivery</td>
                                                <td><input type="radio" name="payment-type" value="COD" required></td>
                                            </tr>
                                            <tr>
                                                <td>Online Payment</td>
                                                <td><input type="radio" name="payment-type" value="onlinepayment"
                                                        required></td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>Number of Item(s):</td>
                                                <td>
                                                    <?= $count ?>
                                                </td>
                                            </tr>
                                            <tr class="summary-total" style="border-top:none">
                                                <td>Total:</td>
                                                <td>P
                                                    <?= $subTotal ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block"
                                        name="PLACEORDER">PLACE ORDER</button>
                                    </form>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        <br>
        <?php include("../layouts/footer.layout1.php"); ?>
    </div>
    <div class="modal fade" id="ShippingInfo-Modal" tabindex="-1" role="dialog" aria-hidden="true"
        style="margin-top:200px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Shipping Info</h5>
                </div>
                <form action="../Controller/orderController.php" method="POST">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label>FullName</label>
                                <input type="hidden" class="form-control" name="shipping_id"
                                    value="<?= ucfirst($shipping_info['id']) ?>">
                                <input type="text" class="form-control" name="fullname"
                                    value="<?= ucfirst($shipping_info['name']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_number"
                                    value="<?= $shipping_info['contact'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address"
                                    value="<?= $shipping_info['address'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger products" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success products" name="UPDATESHIPPING">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("../layouts/jsfile.layout.php");
    include("toastr.php");
    ?>
</body>

</html>
