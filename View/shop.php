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
</head>

<body onload="getLocation()">
	<?php
	$user = mysqli_fetch_assoc(getrecord('user_details', 'id', $_SESSION['id']));
	?>
	<div class="page-wrapper">
		<?php include("../layouts/header_layout.php"); ?>
		<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-with-filter">
				<div class="container">
					<form action="../Controller/shopController.php" method="POST">
						<input type="hidden" name="lats" id="lats">
						<input type="hidden" name="longs" id="longs">
						<button type="submit" name="NEARESTSHOP"
							style="border:none;background-color:transparent;font-size:16px;"><i
								class="icon-bars"></i>Near
							Me</button>
					</form>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Shop</li>
					</ol>
				</div>
			</nav>
			<?php $shop = displayShop();
			while ($row = mysqli_fetch_array($shop)): ?>
				<a href="storeShop.php?shop_id=<?= $row['id'] ?>">
					<div class="page-header text-center mb-5"
						style="margin-left:250px;margin-right:250px;background-image: url('../assets/images/backgrounds/login-bg.jpg')">
						<div class="container">
							<h1 class="page-title" style="color:#000;font-size:5rem!important;font-weight:500;">
								<?= $row['shop_name'] ?><span style="color:#26180b;">
									<?= $row['address'] ?>
								</span>
							</h1>
						</div>
					</div>
				</a>
			<?php endwhile; ?>
		</main>
		<br>
		<?php include("../layouts/footer.layout1.php"); ?>
	</div>
	<?php
	include("../layouts/jsfile.layout.php");
	include("toastr.php");
	include('../assets/js/prod.php');
	?>
</body>

<script>


	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			alert("Geolocation is not supported by this browser.");
		}
	}
	function showPosition(position) {
		document.getElementById("lats").value = + position.coords.latitude;
		document.getElementById("longs").value = + position.coords.longitude;
	}
</script>

</html>
