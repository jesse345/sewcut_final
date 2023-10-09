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
    <link rel="stylesheet" href="../assets/css/myProduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
    $user = mysqli_fetch_assoc(getrecord('user_details','id',$_SESSION['id']));
    ?>
    <div class="page-wrapper">
        <?php include("../layouts/header_layout.php"); ?>
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
								        <a href="myProduct.php" class="nav-link active">My Product</a>
								    </li>
                                    <li class="nav-item">
								        <a href="manageOrder.php" class="nav-link">Orders</a>
								    </li>
                                    <li class="nav-item">
								        <a href="myPurchase.php" class="nav-link">My Purchase</a>
								    </li>
                                     <li class="nav-item">
								        <a href="myShop.php" class="nav-link">My shop</a>
								    </li>
								</ul>
	                		</aside><!-- End .col-lg-3 -->
	                		<div class="col-10">
                                <a href="#addProduct-modal" data-toggle="modal" class="btn btn-dark float-right" >Add Product</a>
                                <table class="table table-hover text-center mt-5">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Stock</th>
                                            
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $productData = displayDetails('products', 'user_id', $_SESSION['id']);
                                            if(mysqli_num_rows($productData) > 0){
                                                while($product = mysqli_fetch_assoc($productData)):
                                                $productDetails = mysqli_fetch_assoc(displayDetails('product_details', 'id', $product['id']));
                                                $productImages = displayDetails('product_images', 'product_id', $product['id']);
                                                $product_details_etc = displayDetails('product_details_etc', 'product_id', $product['id']);
                                                $count++;
                                                ?>
                                                <tr> 
                                                    <td><b><?php echo $count ?></b></td>
                                                    <td><?php echo $productDetails['product_name'] ?></td>
                                                    <td>
                                                        <?php 
                                                        $stock = 0; // Initialize the $stock variable to 0 before the loop
                                                        while($pq = mysqli_fetch_assoc($product_details_etc)): 
                                                            $stock += $pq['quantity']; // Use += to accumulate the quantities
                                                        endwhile; 
                                                        echo $stock;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if($stock > 0){ ?>
                                                            <button  class="btn btn-success products">In Stock</button>
                                                        <?php } else { ?>
                                                            <button class="btn btn-danger products">Out of Stock</button>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="#viewmore-Modal<?php echo $product['id'] ?>" data-toggle="modal" class="btn btn-info products">View More</a>
                                                        <a href="#update-Modal<?php echo $product['id'] ?>" data-toggle="modal" class="btn btn-success products">Update</a>
                                                        <a href="#delete-Modal<?php echo $product['id'] ?>" data-toggle="modal" class="btn btn-danger products">Delete</a>
                                                    </td>
                                                </tr>
                                                 <!-- VIEW MORE MODAL -->
                                                <div class="modal fade" id="viewmore-Modal<?php echo $product['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog custom-modal add-modal" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <p>View More Details</p>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="icon-close"></i></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Product Name</label>
                                                                    <input type="text" class="form-control" value="<?php echo $productDetails['product_name'] ?>"  readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="comment">Descriptions</label>
                                                                    <textarea class="form-control" rows="5" readonly><?php echo $productDetails['description'] ?></textarea>
                                                                </div>
                                                                <?php  
                                                                mysqli_data_seek($product_details_etc, 0);
                                                                while($pqe = mysqli_fetch_assoc($product_details_etc)): 
                                                                ?>
                                                                    <div class="row">
                                                                        <div class="col-sm-3 col-lg-3">
                                                                            <label>Color</label>
                                                                            <input type="text" class="form-control" value="<?php echo $pqe['color']?>" readonly>
                                                                        </div>
                                                                        <div class="col-sm-3 col-lg-3">
                                                                            <label>Size</label>
                                                                            <input type="text" class="form-control" value="<?php echo $pqe['size']?>" readonly>
                                                                        </div>
                                                                        <div class="col-sm-3 col-lg-2">
                                                                            <label>Price</label>
                                                                            <input type="text" class="form-control" value="<?php echo $pqe['price']?>" readonly>
                                                                        </div>
                                                                        <div class="col-sm-3 col-lg-2">
                                                                            <label>Stock</label>
                                                                            <input type="text" class="form-control" value="<?php echo $pqe['quantity']?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                <?php endwhile; ?>
                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <input type="text" class="form-control" value="<?php echo $productDetails['category'] ?>"  readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Product Brand</label>
                                                                    <input type="text" class="form-control" value="<?php echo $productDetails['brand'] ?>"  readonly>
                                                                </div>
                                                                <div class="card-body">
                                                                    <label>Images</label>
                                                                    <div style="display:flex">
                                                                        <?php
                                                                        while ($pi = mysqli_fetch_assoc($productImages)):
                                                                            $imagePath = $pi['image'];
                                                                            
                                                                            // Check if the file extension is .mp4
                                                                            $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
                                                                            if (strtolower($fileExtension) == 'mp4'):
                                                                                ?>
                                                                            <div class="preview-item">
                                                                                <video width="320" height="240" controls>
                                                                                    <source src="<?php echo $imagePath; ?>" type="video/mp4">
                                                                                </video>
                                                                            </div>
                                                                                
                                                                            <?php else: ?>
                                                                                <div class="preview-item">
                                                                                    <img src="<?php echo $imagePath; ?>">
                                                                                </div>
                                                                            <?php endif;
                                                                        endwhile; ?>
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="comment">Additional Info</label>
                                                                    <textarea class="form-control" rows="5" readonly><?php echo $productDetails['additional_info'] ?></textarea>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger products" data-dismiss="modal" aria-label="Close">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <!-- DELETE MODAL -->
                                                <div class="modal fade" id="delete-Modal<?php echo $product['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header header1">
                                                                
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="icon-close"></i></span>
                                                                </button>
                                                            </div>
                                                            <form action="../Controller/ProductController.php" method="POST">
                                                                <div class="modal-body">
                                                                    <p style="font-size: 15px; font-weight: 500;">Are you sure you want to delete this product ?</p>
                                                                </div>
                                                                <input type="hidden" name="id" value="<?php echo $product['id']?>">
                                                                <div class="modal-footer footer1">
                                                                    <button type="button" class="btn btn-danger products" data-dismiss="modal" aria-label="Close">
                                                                        No
                                                                    </button>
                                                                    <button type="submit" class="btn btn-dark products" name="DELETEPRODUCT">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <!-- UPDATE MODAL -->
                                                <div class="modal fade" id="update-Modal<?php echo $product['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog custom-modal update-modal" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <p>Update Product</p>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="icon-close"></i></span>
                                                                </button>
                                                            </div>
                                                            <form action="../Controller/ProductController.php" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-body">                    
                                                                    <div class="form-group">
                                                                        <label>Product Name</label>
                                                                        <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                                                                        <input type="text" class="form-control" name="product_name" value="<?php echo $productDetails['product_name'] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="comment">Descriptions</label>
                                                                        <textarea class="form-control" name="description" rows="5" ><?php echo $productDetails['description'] ?></textarea>
                                                                    </div>
                                                                    <?php  
                                                                    $color = sizeOrColor('colors'); 
                                                                    $size  = sizeOrColor('sizes'); 
                                                                    $category = sizeOrColor('categories');
                                                                    
                                                                    mysqli_data_seek($product_details_etc, 0);
                                                                    while($pqe = mysqli_fetch_assoc($product_details_etc)): 
                                                                        ?>
                                                                        <div class="row">
                                                                            <div class="col-sm-3 col-lg-3">
                                                                                <label>Color</label>
                                                                                <input type="hidden" name="pqe_id[]" value="<?php echo $pqe['id']?>">
                                                                                <select class="form-control" name="color[]">
                                                                                    <option value="<?php echo $pqe['color']?>" selected><?php echo $pqe['color']?></option>
                                                                                    <?php 
                                                                                    mysqli_data_seek($color, 0);
                                                                                    while($c = mysqli_fetch_assoc($color)):
                                                                                        if ($c['color_name'] != $pqe['color']){
                                                                                        ?>
                                                                                        <option value="<?php echo $c['color_name']?>"><?php echo $c['color_name']?></option>
                                                                                        <?php } ?>
                                                                                        
                                                                                    <?php endwhile; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-3 col-lg-3">
                                                                                <label>Size</label>
                                                                                <select class="form-control" name="size[]">
                                                                                    <option value="<?php echo $pqe['size']?>" selected><?php echo $pqe['size']?></option>
                                                                                    <?php 
                                                                                    mysqli_data_seek($size, 0);
                                                                                    while($s = mysqli_fetch_assoc($size)):
                                                                                        if ($s['size'] != $pqe['size']){
                                                                                            ?>
                                                                                            <option value="<?php echo $s['size']?>"><?php echo $s['size']?></option>
                                                                                        <?php } ?>
                                                                                    <?php endwhile; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-3 col-lg-2">
                                                                                <label>Price</label>
                                                                                <input type="text" class="form-control" name="price[]" value="<?php echo $pqe['price']?>" >
                                                                            </div>
                                                                            <div class="col-sm-3 col-lg-2">
                                                                                <label>Stock</label>
                                                                                <input type="text" class="form-control" name="stock[]" value="<?php echo $pqe['quantity']?>">
                                                                            </div>
                                                                        </div>
                                                                    <?php endwhile; ?>
                                                                    <label for="">Category<span style="color:red">*</span></label>
                                                                    <select class="form-control" name="category" require>
                                                                        <option value="<?php echo $productDetails['category'];?>" selected><?php echo $productDetails['category'];?></option>
                                                                        <?php
                                                                        mysqli_data_seek($category, 0);
                                                                        while($c = mysqli_fetch_assoc($category)):?>
                                                                            <?php if ($c['category'] != $productDetails['category']) {?>
                                                                                <option value="<?php echo $c['category']?>"><?php echo $c['category']?></option>
                                                                            <?php } ?>
                                                                        <?php endwhile; ?>
                                                                    </select>
                                                                    <div class="form-group">
                                                                        <label>Product Brand</label>
                                                                        <input type="text" class="form-control" name="brand" value="<?php echo $productDetails['brand'] ?>" >
                                                                    </div>
                                                                    <div class="card-body">
                                                                    <label>Image and video</label><br>
                                                                    <div style="display:flex">
                                                                        <?php
                                                                        mysqli_data_seek($productImages, 0);
                                                                        while ($pi = mysqli_fetch_assoc($productImages)):
                                                                            
                                                                            $imagePath = $pi['image'];
                                                                            
                                                                            // Check if the file extension is .mp4
                                                                            $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
                                                                            if (strtolower($fileExtension) == 'mp4'):
                                                                                ?>
                                                                            
                                                                            <div class="preview-item">
                                                                                <video width="320" height="240" controls>
                                                                                    <source src="<?php echo $imagePath; ?>" type="video/mp4">
                                                                                </video>
                                                                            </div>
                                                                                
                                                                            <?php else: ?>
                                                                                <div class="preview-item">
                                                                                    <img src="<?php echo $imagePath; ?>">
                                                                                </div>
                                                                            <?php endif;
                                                                            
                                                                        endwhile; ?>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <label>Update Images and videos(Optional)</label><br>
                                                                        <?php
                                                                        mysqli_data_seek($productImages, 0);
                                                                        while ($pi = mysqli_fetch_assoc($productImages)):
                                                                            ?>
                                                                            <input type="hidden" name="image_id[]" value="<?=$pi['id']?>">
                                                                        <?php endwhile; ?>  
                                                                        <input type="file" name="image[]" id="fileInput123" multiple>
                                                                        <div class="imagePreviews123" style="display:flex">
                                                                        </div>
                                                                        <div class="error-container123"></div>
                                                                    </div>
                                                                
                                                                    <div class="form-group">
                                                                        <label for="comment">Additonal Info</label>
                                                                        <textarea class="form-control" name="add_info" rows="5" ><?php echo $productDetails['additional_info'] ?></textarea>
                                                                    </div>
                                                                   
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger products" data-dismiss="modal" aria-label="Close">
                                                                        Close
                                                                    </button>
                                                                    <button type="submit" class="btn btn-dark products" id="UPDATE" name="UPDATEPRODUCT">UPDATE</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php endwhile; ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="6">No product</td>
                                                </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
	                		</div>
	                	</div>
	                </div>
                </div>
            </div>
        </main>
        <br>
        <?php include("../layouts/footer.layout1.php"); ?>
    </div>

     <!-- ADD PRODUCT MODAL -->
    <div class="modal fade" id="addProduct-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog custom-modal add-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Add Product</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>
                </div>
                <form action="../Controller/ProductController.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Product Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Descriptions <span style="color:red">*</span></label>
                            <textarea class="form-control" rows="5" name="description" required></textarea>
                        </div>
                        <?php 
                        $color = sizeOrColor('colors'); 
                        $size  = sizeOrColor('sizes'); 
                        $brand = sizeOrColor('brands'); 
                        $category = sizeOrColor('categories');
                            ?>
                            <div class="card-body">
                                <div id="level-container">
                                    <div class="row">
                                        <div class="col-sm-3 col-lg-3">
                                            <label>Color <span style="color:red">*</span></label>
                                            <select class="form-control" name="color[]" required>
                                                <option value="" selected>Select Color</option>
                                                 
                                                <?php 
                                                mysqli_data_seek($color, 0);
                                                while($c = mysqli_fetch_assoc($color)):?>
                                                    <option value="<?php echo $c['color_name']?>"><?php echo $c['color_name']?></option>
                                               <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 col-lg-3">
                                            <label>Size <span style="color:red">*</span></label>
                                            <select class="form-control" name="size[]" required>
                                                <option value="" selected>Select Size</option>
                                                <?php while($s = mysqli_fetch_assoc($size)):?>
                                                    <option value="<?php echo $s['size']?>"><?php echo $s['size']?></option>
                                               <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 col-lg-2">
                                            <label>Price <span style="color:red">*</span></label>
                                            <input type="number" class="form-control" name="price[]" required>
                                        </div>
                                        <div class="col-sm-3 col-lg-2">
                                            <label>Stock <span style="color:red">*</span></label>
                                            <input type="number" class="form-control" name="stock[]" required>
                                        </div>

                                        <div class="col-sm-3 col-lg-2" style="position: relative;top: 33px;left: 57px;">
                                            <button type="button" class="add" style="background-color: transparent;border: none;"> 
                                                <i class="fa fa-plus-circle" style="font-size: 31px; color: green;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <label for="">Category<span style="color:red">*</span></label>
                         <select class="form-control" name="category" require>
                            <option value="" selected>Select Category</option>
                            <?php
                            mysqli_data_seek($category, 0);
                            while($c = mysqli_fetch_assoc($category)):?>
                                <option value="<?php echo $c['category']?>"><?php echo $c['category']?></option>
                            <?php endwhile; ?>
                        </select>
                        <label>Brand <span style="color:red">*</span></label>
                       <select class="form-control" name="brand" required>
                            <option value="" selected>Select Brand</option>
                            <?php 
                            mysqli_data_seek($brand, 0);
                            while($b = mysqli_fetch_assoc($brand)):?>
                                <option value="<?php echo $b['brand_name']?>"><?php echo $b['brand_name']?></option>
                            <?php endwhile; ?>
                        </select>
                       
                        <div class="card-body">
                            <label>Upload Images and Videos (up to 4 only) <span style="color:red">*</span></label><br>
                            <input type="file" name="image[]" id="fileInput" multiple required>
                            <div class="imagePreviews" style="display:flex">
                            </div>
                            <div class="error-container"></div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Additional Information</label>
                            <textarea class="form-control" rows="5" name="add_info"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger products" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                        <button type="submit" class="btn btn-dark products" id="add_product_btn"  name="ADDPRODUCT">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php 
        include("../layouts/jsfile.layout.php");
        include("toastr.php");
        include('../assets/js/prod.php');
    ?>
    
</body>
<script>
    $(document).ready(function () {
     $("#UPDATE #add_product_btn").one('click', function (event) {  
           event.preventDefault();
           //do something
           $(this).prop('disabled', true);
     });
});
</script>
</html>