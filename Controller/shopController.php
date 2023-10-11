<?php
session_start();
include("../Model/db.php");
include '../includes/toastr.inc.php';

if (isset($_POST['CREATESHOP'])) {
    $user_id = $_SESSION['id'];
    $shop_name = $_POST['shop_name'];
    $address_id = $_POST['address'];

    $address = mysqli_fetch_assoc(getrecord('address', 'id', $address_id));
    CreateShop(
        'shops',
        array('user_id', 'shop_name', 'address', 'latitude', 'longitude'),
        array($user_id, $shop_name, $address['address'], $address['latitude'], $address['longitude'])
    );

    flash("msg", "success", "Shop Created Successfully");
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} elseif (isset($_POST['NEARESTSHOP'])) {
    $v1 = $_POST['lats'];
    $v2 = $_POST['longs'];
    header("location: ../View/nearestShop.php?lat=$v1&long=$v2");
}
