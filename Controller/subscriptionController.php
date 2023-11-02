<?php
include("../Model/db.php");
session_start();
include '../includes/toastr.inc.php';

if (isset($_POST['subscribe'])) {
    $user_id = $_SESSION['id'];
    $typeofpayment = 'Gcash';
    $amount = $_POST['amount'];
    $reference_number = $_POST['ref'];

    if ($amount == 199) {
        $type = "Standard";
    } elseif ($amount == 399) {
        $type = "Advance";
    } elseif ($amount == 699) {
        $type = "Premium";
    }

    createUser(
        'subscription',
        array('user_id', 'type', 'type_of_payment', 'amount', 'reference_number'),
        array($user_id, $type, $typeofpayment, $amount, $reference_number)
    );

    $targetDir = "../images/";
    $target_file = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check !== false) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        updateUser(
            'subscription',
            array('user_id', 'receipt_img'),
            array($_SESSION['id'], $target_file)
        );
    }
    flash("msg", "success", "Wait for the admin to verify your payment. Thank you!");
    header("Location: ../View/mySubscription.php");
    exit();
} elseif(isset($_POST['FREETRIAL'])){
    createUser('subscription', 
                array('user_id','type'),
                array($_SESSION['id'],'Free'));
    flash("msg", "success", "Wait for the admin to verify your subscribtion. Thank you!");
    header("Location: ../View/mySubscription.php");
    exit();
}

