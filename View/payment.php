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
    <?php include("../layouts/head.layout.php") ?>
    <title>My Product</title>
    <style>
        .form-control {
            border: 1px solid #000;
            color: #000;
        }
    </style>
</head>

<body>
    <?php
    $user = mysqli_fetch_assoc(getrecord('user_details', 'id', $_SESSION['id']));
    $o = getOrderbyID('orders', $_GET['order_id']);
    $order = mysqli_fetch_assoc($o);
    $seller = mysqli_fetch_assoc(getrecord('user_details', 'id', $order['seller_id']));
    ?>
    <div class="page-wrapper">
        <?php include("../layouts/header_layout.php");
        ?>
        <main class="main mb-15">
            <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-with-filter">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                    </ol>
                </div><!-- End .container -->
            </nav>
            <div style="display: flex; justify-content: center; align-items: center;">
                <form action="../Controller/orderController.php" method="POST" enctype="multipart/form-data">
                    <!-- Your form fields here -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Gcash Name</label>
                                <input type="text" class="form-control" value="<?= $seller['gcash_name'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Gcash Number</label>
                                <input type="text" class="form-control" value="<?= $seller['gcash_number'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Total Amount</label>
                        <input type="hidden" name="order_id" value="<?= $_GET['order_id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                        <input type="text" class="form-control" name="total" value="<?= $order['total'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" id="imageInput" accept="image/*" required>
                    </div>
                    <div class="preview">
                        <img id="imagePreview" src="#" alt="Image Preview" style="height: 140px; display: none;">
                    </div>
                    <div class="form-group">
                        <label for="email">Reference number</label>
                        <input type="text" class="form-control" name="reference_number"
                            placeholder="Enter Reference number" required>
                    </div>
                    <button type="submit" name="PAY" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </main><!-- End .main -->
        <br>
        <?php include("../layouts/footer.layout1.php"); ?>
    </div>
    <?php include("../layouts/jsfile.layout.php"); ?>
    jsfile.layout.php
</body>
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function (e) {
        if (e.target.files.length === 0) {
            return;
        }
        let file = e.target.files[0];
        let url = URL.createObjectURL(file);
        imagePreview.src = url;

        // Display the preview image
        imagePreview.style.display = 'block';
    });
</script>

</html>
