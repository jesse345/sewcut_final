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
    <title>My Product</title>
</head>
<body>
    <?php
    $user = mysqli_fetch_assoc(getrecord('user_details','id',$_SESSION['id']));
    ?>
    <div class="page-wrapper">
        <?php include("../layouts/header_layout.php"); ?>
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-with-filter">
                <div class="container">
                	<a href="#" class="sidebar-toggler"><i class="icon-bars"></i>Filters</a>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>

                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <div class="page-content">
            	<div class="categories-page">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-md-6">
	                			<div class="banner banner-cat banner-badge">
		                			<a href="#">
		                				<img src="../assets/images/category/boxed/banner-1.jpg" alt="Banner">
		                			</a>

		                			<a class="banner-link" href="ShopDress.php">
		                				<h3 class="banner-title">Dresses</h3><!-- End .banner-title -->
		                				<h4 class="banner-subtitle">3 Products</h4><!-- End .banner-subtitle -->
		                				<span class="banner-link-text">Shop Now</span>
		                			</a><!-- End .banner-link -->
	                			</div><!-- End .banner -->

	                			<div class="banner banner-cat banner-badge">
		                			<a href="#">
		                				<img src="../assets/images/category/boxed/banner-2.jpg" alt="Banner">
		                			</a>

		                			<a class="banner-link" href="">
		                				<h3 class="banner-title">Jackets</h3><!-- End .banner-title -->
		                				<h4 class="banner-subtitle">2 Products</h4><!-- End .banner-subtitle -->
		                				<span class="banner-link-text">Shop Now</span>
		                			</a><!-- End .banner-link -->
	                			</div><!-- End .banner -->
	                		</div><!-- End .col-md-6 -->

	                		<div class="col-md-6">
	                			<div class="row">
	                				<div class="col-sm-6">
	                					<div class="banner banner-cat banner-badge">
				                			<a href="#">
				                				<img src="../assets/images/category/boxed/banner-3.jpg" alt="Banner">
				                			</a>

				                			<a class="banner-link" href="#">
				                				<h3 class="banner-title">T-shirts</h3><!-- End .banner-title -->
				                				<h4 class="banner-subtitle">0 Products</h4><!-- End .banner-subtitle -->
				                				<span class="banner-link-text">Shop Now</span>
				                			</a><!-- End .banner-link -->
			                			</div><!-- End .banner -->
	                				</div><!-- End .col-sm-6 -->

	                				<div class="col-sm-6">
	                					<div class="banner banner-cat banner-badge">
				                			<a href="#">
				                				<img src="../assets/images/category/boxed/banner-4.jpg" alt="Banner">
				                			</a>

				                			<a class="banner-link" href="#">
				                				<h3 class="banner-title">Jeans</h3><!-- End .banner-title -->
				                				<h4 class="banner-subtitle">1 Products</h4><!-- End .banner-subtitle -->
				                				<span class="banner-link-text">Shop Now</span>
				                			</a><!-- End .banner-link -->
			                			</div><!-- End .banner -->
	                				</div><!-- End .col-sm-6 -->
	                			</div><!-- End .row -->

	                			<div class="banner banner-cat banner-badge">
		                			<a href="#">
		                				<img src="..//assets/images/category/boxed/banner-5.jpg" alt="Banner">
		                			</a>

		                			<a class="banner-link" href="#">
		                				<h3 class="banner-title">Bags</h3><!-- End .banner-title -->
		                				<h4 class="banner-subtitle">4 Products</h4><!-- End .banner-subtitle -->
		                				<span class="banner-link-text">Shop Now</span>
		                			</a><!-- End .banner-link -->
	                			</div><!-- End .banner -->
	                		</div><!-- End .col-md-6 -->

	                		<div class="col-sm-6 col-md-3">
	                			<div class="banner banner-cat banner-badge">
		                			<a href="#">
		                				<img src="../assets/images/category/boxed/banner-6.jpg" alt="Banner">
		                			</a>

		                			<a class="banner-link" href="#">
		                				<h3 class="banner-title">Sportwear</h3><!-- End .banner-title -->
		                				<h4 class="banner-subtitle">0 Products</h4><!-- End .banner-subtitle -->
		                				<span class="banner-link-text">Shop Now</span>
		                			</a><!-- End .banner-link -->
	                			</div><!-- End .banner -->
	                		</div><!-- End .col-md-3 -->

	                		<div class="col-sm-6 col-md-3 order-md-last">
	                			<div class="banner banner-cat banner-badge">
		                			<a href="#">
		                				<img src="../assets/images/category/boxed/banner-8.jpg" alt="Banner">
		                			</a>

		                			<a class="banner-link" href="#">
		                				<h3 class="banner-title">Jumpers</h3><!-- End .banner-title -->
		                				<h4 class="banner-subtitle">1 Products</h4><!-- End .banner-subtitle -->
		                				<span class="banner-link-text">Shop Now</span>
		                			</a><!-- End .banner-link -->
	                			</div><!-- End .banner -->
	                		</div><!-- End .col-md-3 -->

	                		<div class="col-md-6">
	                			<div class="banner banner-cat banner-badge">
		                			<a href="#">
		                				<img src="../assets/images/category/boxed/banner-7.jpg" alt="Banner">
		                			</a>

		                			<a class="banner-link" href="#">
		                				<h3 class="banner-title">Shoes</h3><!-- End .banner-title -->
		                				<h4 class="banner-subtitle">2 Products</h4><!-- End .banner-subtitle -->
		                				<span class="banner-link-text">Shop Now</span>
		                			</a><!-- End .banner-link -->
	                			</div><!-- End .banner -->
	                		</div><!-- End .col-md-6 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .categories-page -->
				
				<div class="sidebar-filter-overlay"></div><!-- End .sidebar-filter-overlay -->
                <aside class="sidebar-shop sidebar-filter sidebar-filter-banner">
                	<div class="sidebar-filter-wrapper">
                		<div class="widget widget-clean">
        					<label><i class="icon-close"></i>Filters</label>
        					<a href="#" class="sidebar-filter-clear">Clean All</a>
        				</div>
	                	<div class="widget">
							<h3 class="widget-title">
						        Browse Category
							</h3><!-- End .widget-title -->

							<div class="widget-body">
								<div class="filter-items filter-items-count">
									<div class="filter-item">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="cat-1">
											<label class="custom-control-label" for="cat-1">Women</label>
										</div><!-- End .custom-checkbox -->
										<span class="item-count">3</span>
									</div><!-- End .filter-item -->

									<div class="filter-item">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="cat-2">
											<label class="custom-control-label" for="cat-2">Men</label>
										</div><!-- End .custom-checkbox -->
										<span class="item-count">0</span>
									</div><!-- End .filter-item -->

									<div class="filter-item">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="cat-3">
											<label class="custom-control-label" for="cat-3">Holiday Shop</label>
										</div><!-- End .custom-checkbox -->
										<span class="item-count">0</span>
									</div><!-- End .filter-item -->

									<div class="filter-item">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="cat-4">
											<label class="custom-control-label" for="cat-4">Gifts</label>
										</div><!-- End .custom-checkbox -->
										<span class="item-count">0</span>
									</div><!-- End .filter-item -->

									<div class="filter-item">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="cat-5">
											<label class="custom-control-label" for="cat-5">Homeware</label>
										</div><!-- End .custom-checkbox -->
										<span class="item-count">0</span>
									</div><!-- End .filter-item -->

									<div class="filter-item">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="cat-6" checked="checked">
											<label class="custom-control-label" for="cat-6">Grid Categories Fullwidth</label>
										</div><!-- End .custom-checkbox -->
										<span class="item-count">13</span>
									</div><!-- End .filter-item -->

									<div class="sub-filter-items">
										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-7">
												<label class="custom-control-label" for="cat-7">Dresses</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">3</span>
										</div><!-- End .filter-item -->

										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-8">
												<label class="custom-control-label" for="cat-8">T-shirts</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">0</span>
										</div><!-- End .filter-item -->

										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-9">
												<label class="custom-control-label" for="cat-9">Bags</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">4</span>
										</div><!-- End .filter-item -->

										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-10">
												<label class="custom-control-label" for="cat-10">Jackets</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">2</span>
										</div><!-- End .filter-item -->

										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-11">
												<label class="custom-control-label" for="cat-11">Shoes</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">2</span>
										</div><!-- End .filter-item -->

										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-12">
												<label class="custom-control-label" for="cat-12">Jumpers</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">1</span>
										</div><!-- End .filter-item -->

										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-13">
												<label class="custom-control-label" for="cat-13">Jeans</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">1</span>
										</div><!-- End .filter-item -->

										<div class="filter-item">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="cat-14">
												<label class="custom-control-label" for="cat-14">Sportwear</label>
											</div><!-- End .custom-checkbox -->
											<span class="item-count">0</span>
										</div><!-- End .filter-item -->
									</div><!-- End .sub-filter-items -->
								</div><!-- End .filter-items -->
							</div><!-- End .widget-body -->
						</div><!-- End .widget -->
					</div><!-- End .sidebar-filter-wrapper -->
                </aside><!-- End .sidebar-filter -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        <br>
        <?php include("../layouts/footer.layout1.php"); ?>
    </div>
    <?php include("../layouts/jsfile.layout.php"); ?>
    jsfile.layout.php
</body>
</html>