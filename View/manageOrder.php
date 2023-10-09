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
    <?php include("../layouts/head.layout.php")?>
    <title>My Account</title>
</head>
<body>
    <?php
    $user = mysqli_fetch_assoc(getrecord('user_details','id',$_SESSION['id']));
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
	                			<ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist" style="height:600px;">
								    <li class="nav-item">
								        <a href="myAccount.php" class="nav-link">My Account</a>
								    </li>
								    <li class="nav-item">
								        <a href="myProduct.php" class="nav-link">My Product</a>
								    </li>
                                    <li class="nav-item">
								        <a href="manageOrder.php" class="nav-link active">My Orders</a>
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
                                    <h6>Order By: </h6>
                                    <table class="table table-hover text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Total Price</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php getOrder('orders',$_SESSION['id']) ?>
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