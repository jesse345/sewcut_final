<?php
session_start();
include("../Model/db.php");
include '../includes/toastr.inc.php';

if (isset($_POST['UPDATESHIPPING'])) {
    $id = $_POST['shipping_id'];
    $n = $_POST['fullname'];
    $c = $_POST['contact_number'];
    $a = $_POST['address'];

    updateUser(
        'shipping_info',
        array('id', 'user_id', 'name', 'contact', 'address'),
        array($id, $_SESSION['id'], $n, $c, $a)
    );

    flash("msg", "success", "Updated Shipping Info");
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} elseif (isset($_POST['PLACEORDER'])) {
    // ORDER
    $cartIDs = $_POST['cart_id']; // Possibly multiple carts
    $userID = $_SESSION['id'];
    $productIDs = $_POST['product_id']; // Possibly multiple products
    $subTotal = $_POST['subTotal'];
    $seller_id = $_POST['seller_id'];
    $payment_type = $_POST['payment-type'];

    // ORDER DETAILS
    $fullname = $_POST['fullname'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];

    // Loop through cart items and insert orders
    foreach ($cartIDs as $i => $cartID) {
        // Create arrays for order and order_details fields and values
        $order_fields = array('cart_id', 'user_id', 'product_id', 'status', 'seller_id', 'total', 'isAccept', 'isPayed', 'payment_type');
        $order_values = array($cartID, $userID, $productIDs[$i], 'Pending', $seller_id, $subTotal, 'No', 'No', $payment_type);

        $order_details_fields = array('id', 'name', 'contact_number', 'shipping_address');
        $order_details_values = array($fullname, $contact_number, $address);

        updateCart(
            'carts',
            array('id', 'isOrder'),
            array($cartID, 'Yes')
        );

        // Insert data into the database
        if (addOrder('orders', $order_fields, $order_values, 'order_details', $order_details_fields, $order_details_values)) {
            if ($payment_type != 'COD') {
                $order_id = mysqli_insert_id($conn);
                header("location:../View/payment.php?order_id=" . $order_id);
            } else {
                header("location:../View/myPurchase.php");
            }
        } else {
            echo "Order placement failed!";
        }
    }

} elseif (isset($_POST['CANCELORDER'])) {
    $order_id = $_POST['order_id'];
    $deleteOrder = mysqli_fetch_assoc(getrecord('orders', 'id', $order_id));

    if ($deleteOrder['status'] == 'Pending') {
        removeOrder($order_id);
        flash("msg", "success", "Success");
        header("Location: ../View/myPurchase.php");
        exit();

    } else {
        flash("msg", "danger", "Can't Cancel");
        header("Location: ../View/myPurchase.php");
        exit();
    }
} elseif (isset($_POST['PAY'])) {
    $order_id = $_POST['order_id'];
    $user_id = $_POST['user_id'];
    $total = $_POST['total'];
    $reference_number = $_POST['reference_number'];

    $targetDir = "../images/";
    $target_file = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check !== false) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        // Assuming that the createUser and updateUser functions are defined elsewhere
        createUser(
            'order_payments',
            array('order_id', 'user_id', 'reference_no', 'receipt_image', 'amount'),
            array($order_id, $user_id, $reference_number, $target_file, $total)
        );

        updateUser('orders', array('id', 'isPayed'), array($order_id, 'Yes'));
        flash("msg", "success", "Payment Sent");
        header("Location: ../View/myPurchase.php");
        exit();
    } else {
        flash("msg", "error", "File is not an image.");
        header("Location: ../View/payment.php?order_id=" . $order_id);
        exit();
    }
}
