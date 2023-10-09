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
        <?php 
            include("../layouts/header_layout.php"); 
            $productDetails = mysqli_fetch_assoc(displayDetails('product_details','id',$_GET['product_id']));
            $productImages = displayDetails('product_images','product_id',$_GET['product_id']);
            $product_details_etc = displayDetails('product_details_etc','product_id',$_GET['product_id']);
            ?>
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Masonry Sticky Info</li>
                    </ol>

                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav><!-- End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                               <div class="product-gallery">
                                <?php
                                $collectedData = array();
                                $mainImage = ''; // Initialize a variable for the main image
                                foreach ($productImages as $i => $image) :
                                    $collectedData[] = $image['image'];
                                    $fileExtension = pathinfo($collectedData[$i], PATHINFO_EXTENSION);
                                    
                                    // Set the main image if it's an image file
                                    if (in_array($fileExtension, array('jpg', 'jpeg', 'png', 'gif')) && empty($mainImage)) {
                                        $mainImage = $collectedData[$i];
                                    }
                                ?>
                                <?php endforeach ?>

                                <!-- Display the main image -->
                                <figure class="product-main-image">
                                    <span class="product-label label-sale">Sale</span>
                                    <img id="product-zoom" src="<?php echo $mainImage ?>" data-zoom-image="<?php echo $mainImage ?>" alt="product image">
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure>

                                <!-- Display images and videos in the product-zoom-gallery -->
                                <div id="product-zoom-gallery" class="product-image-gallery product-gallery-masonry">
                                    <?php for ($i = 1; $i < count($collectedData); $i++) : ?>
                                        <?php $fileExtension = pathinfo($collectedData[$i], PATHINFO_EXTENSION); ?>
                                        <?php if (in_array($fileExtension, array('jpg', 'jpeg', 'png', 'gif'))) : ?>
                                            <!-- Display images -->
                                            <a class="product-gallery-item" href="#" data-image="<?php echo $collectedData[$i] ?>" data-zoom-image="<?php echo $collectedData[$i] ?>">
                                                <img src="<?php echo $collectedData[$i] ?>" alt="product cross">
                                            </a>
                                        <?php elseif (in_array($fileExtension, array('mp4', 'avi', 'mov'))) : ?>
                                            <!-- Display videos -->
                                            <a class="product-gallery-item" href="#" data-image="<?php echo $collectedData[$i] ?>" data-zoom-image="<?php echo $collectedData[$i] ?>">
                                                <video controls="" style="width: 571px;">
                                                    <source src="<?php echo $collectedData[$i] ?>" type="video/<?php echo $fileExtension; ?>">
                                                    Your browser does not support the video tag.
                                                </video>
                                                
                                            </a>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>


                            </div>

                            <div class="col-md-6">
                                <div class="product-details sticky-content">
                                    <h1 class="product-title"><?php echo $productDetails['product_name']?></h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-accordion" id="review-link">( 2 Reviews )</a>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                        <span class="new-price">P<?php echo minPrice($_GET['product_id'])['price']?> - P<?php echo maxPrice($_GET['product_id'])['price']?></span>
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p><?php echo $productDetails['description']?>.</p>
                                    </div><!-- End .product-content -->
                                    <form action="../Controller/cartController.php" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
                                        <div class="details-filter-row details-row-size">
                                            <label>Color:</label>
                                            <div class="select-custom">
                                                <select name="color" id="color" class="form-control" data-product-id="<?php echo $_GET['product_id']; ?>" >
                                                    <option  selected="selected">Select Color</option>
                                                    <?php
                                                    $addedColors = array(); // Initialize an array to keep track of added colors
                                                    foreach ($product_details_etc as $pde):
                                                        $color = $pde['color'];
                                                        if (!in_array($color, $addedColors)) { // Check if color is not already added
                                                            $addedColors[] = $color; // Add the color to the list of added colors
                                                    ?>
                                                        <option value="<?php echo $color ?>"><?php echo $color ?></option>
                                                    <?php
                                                        }
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="details-filter-row details-row-size">
                                            <label for="size">Size:</label>
                                            <div class="select-custom">
                                                <select name="size" id="size" class="form-control" >
                                                    <option value="" selected="selected">Select Size</option>
                                                    <?php
                                                    $addedSize = array(); 
                                                    foreach ($product_details_etc as $pde):
                                                        $size = $pde['size'];
                                                        if (!in_array($size, $addedSize)) { 
                                                            $addedSize[] = $size; 
                                                    ?>
                                                        <option value="<?php echo $size ?>"><?php echo $size ?></option>
                                                    <?php
                                                        }
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="details-filter-row details-row-size">
                                            <label for="qty">Qty:</label>
                                            <div class="product-details-quantity">
                                                <input type="number" name="quanity" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                                
                                            </div><!-- End .product-details-quantity -->
                                            <?php $totalQuantiy = sumOfProduct($_GET['product_id'])?>
                                            <p id="totalQuantity" style="margin-left:25px;"><?php echo $totalQuantiy['total'];?> available pieces</p>
                                            <p id="newTotal"></p>
                                        </div>
                                   
                                            <div class="product-details-action">
                                            <?php $checkCart = getRecordCart('carts',$_SESSION['id'],$_GET['product_id']);
                                            if (mysqli_num_rows($checkCart) > 0) {
                                            ?>
                                                <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']?>">
                                                <button type="submit" name="REMOVECART" class="btn-product btn-cart"><span>remove to cart</span></button>
                                            <?php } else {?>
                                                 <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']?>">
                                                <button type="submit" name="ADDTOCART" class="btn-product btn-cart"><span>add to cart</span></button>
                                            <?php }?>
                                    </form>
                                            <form action="../Controller/wishlistController.php" method="POST">    
                                                <div class="details-action-wrapper">
                                                    <?php $checkWishlist = getRecordWishlist('wishlists',$_SESSION['id'], $_GET['product_id']);
                                                    if (mysqli_num_rows($checkWishlist) > 0) {
                                                    ?>
                                                        <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']?>">
                                                        <a><button class="btn-product btn-wishlist" name="REMOVEWISHLIST" style="border:none;background-color:transparent;" title="Remove Wishlist"><span>Remove from Wishlist</span></button></a>
                                                    <?php } else {?>
                                                        <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']?>">
                                                        <a><button class="btn-product btn-wishlist"  name="ADDWISHLIST" style="border:none;background-color:transparent;" title="Wishlist"><span>Add to Wishlist</span></button></a>
                                                    <?php } ?>  

                                                    <a href="#" class="btn-product btn-compare" style="margin-left:30px;" title="Chat Seller"><span>Chat Seller</span></a>
                                                </div><!-- End .details-action-wrapper -->
                                            </form>
                                        </div>
                                     
                                    <div class="accordion accordion-plus product-details-accordion" id="product-accordion">
                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-desc-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-desc" aria-expanded="false" aria-controls="product-accordion-desc">
                                                        Description
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-desc" class="collapse" aria-labelledby="product-desc-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p><?php echo $productDetails['description']?>.</p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-info-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-info" aria-expanded="false" aria-controls="product-accordion-info">
                                                        Additional Information
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-info" class="collapse" aria-labelledby="product-info-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="product-desc-content">
                                                        <p><p><?php echo $productDetails['additional_info']?>.</p></p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->
                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-review-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-review" aria-expanded="false" aria-controls="product-accordion-review">
                                                        Reviews (2)
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-review" class="collapse" aria-labelledby="product-review-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="reviews">
                                                        <div class="review">
                                                            <div class="row no-gutters">
                                                                <div class="col-auto">
                                                                    <h4><a href="#">Samanta J.</a></h4>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings">
                                                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                                        </div><!-- End .ratings -->
                                                                    </div><!-- End .rating-container -->
                                                                    <span class="review-date">6 days ago</span>
                                                                </div><!-- End .col -->
                                                                <div class="col">
                                                                    <h4>Good, perfect size</h4>

                                                                    <div class="review-content">
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                                                    </div><!-- End .review-content -->

                                                                    <div class="review-action">
                                                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                                    </div><!-- End .review-action -->
                                                                </div><!-- End .col-auto -->
                                                            </div><!-- End .row -->
                                                        </div><!-- End .review -->

                                                        <div class="review">
                                                            <div class="row no-gutters">
                                                                <div class="col-auto">
                                                                    <h4><a href="#">John Doe</a></h4>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings">
                                                                            <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                                        </div><!-- End .ratings -->
                                                                    </div><!-- End .rating-container -->
                                                                    <span class="review-date">5 days ago</span>
                                                                </div><!-- End .col -->
                                                                <div class="col">
                                                                    <h4>Very good</h4>

                                                                    <div class="review-content">
                                                                        <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                                                    </div><!-- End .review-content -->

                                                                    <div class="review-action">
                                                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                                    </div><!-- End .review-action -->
                                                                </div><!-- End .col-auto -->
                                                            </div><!-- End .row -->
                                                        </div><!-- End .review -->
                                                    </div><!-- End .reviews -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->
                                    </div><!-- End .accordion -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        <br>
        <?php include("../layouts/footer.layout1.php"); ?>
    </div>
    <?php 
    include("../layouts/jsfile.layout.php");
    include("toastr.php");
    ?>
</body>
<script>
    $(document).ready(function() {
        $("#color, #size").on("change", function() {

            var totalQuantity = $('#totalQuantity');
           
            var newTotal = $('#newTotal')
            var selectedColor = $("#color").val();
            var selectedSize = $("#size").val();
            var product_id = $("#color").data("product-id");


            $.ajax({
                url: "../Controller/quantityController.php", 
                method: "POST", 
                data: { product_id:product_id,color: selectedColor, size: selectedSize },
                success: function (response) {
                     if (response != 0) {
                        $(".btn-increment").show();
                        totalQuantity.text(response + " available pieces").show();
                    } else {
                        $(".btn-increment").hide();
                        totalQuantity.text(response + " available pieces").show();
                    }
                    
                },
                error: function (error) {
                    console.log("Error:", error);
                }
            });

        }); 
    });
</script>
</html>