<?php
session_start();
include("../Model/db.php");
include '../includes/toastr.inc.php';

if (isset($_POST['CREATESHOP'])) {
    $user_id = $_SESSION['id'];
    $shop_name = $_POST['shop_name'];
    $address_id = $_POST['address'];

    CreateShop(
        'shops',
        array('user_id', 'shop_name', 'address_id'),
        array($user_id, $shop_name, $address_id)
    );
    flash("msg", "success", "Shop Created Successfully");
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
