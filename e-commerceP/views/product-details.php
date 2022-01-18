<?php
include_once "layouts/header.php";
include_once "layouts/nav.php";
include_once __DIR__."/../app/models/Product.php";
$productObject = new Product;
if ($_GET) {
    // if page has id key
    if (isset($_GET['id'])) {
        // if key has integer value
        if (is_numeric($_GET['id'])) {
            $productObject->setId($_GET['id']);
            $getProductByIDResult = $productObject->getProductByID();
            // check on integer value in db
            if ($getProductByIDResult) {
                $product = $getProductByIDResult->fetch_object();
            } else {
                header('location:errors/404.php');
            }
        } else {
            // echo "ok";die;
            header('location:errors/404.php');
        }
    } else {
        header('location:errors/404.php');
    }
}else{
    header('location:errors/404.php');
}

?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3><?= $product->name_en ?></h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active"><?= $product->name_en ?></li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- Product Deatils Area Start -->
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img class="zoompro" src="../assets/img/product-details/<?= $product->image ?>" data-zoom-image="../assets/img/product-details/<?= $product->image ?>" alt="zoom" />
                    <div id="gallery" class="mt-20 product-dec-slider owl-carousel">
                        <a data-image="../assets/img/product-details/s1-<?= $product->image ?>" data-zoom-image="../assets/img/product-details/s1-<?= $product->image ?>">
                            <img src="../assets/img/product-details/s1-<?= $product->image ?>" alt="">
                        </a>
                       
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $product->name_en ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <?php for($i=0;$i<$product->reviews_avg;$i++){ ?>
                                <i class="ion-android-star-outline theme-star"></i>
                            <?php }for($i=0;$i<5-$product->reviews_avg;$i++){ ?>
                                <i class="ion-android-star-outline"></i>
                            <?php }  ?>
                            
                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li><?= $product->reviews_count ?> Reviews </li>
                                <li> Add Your Reviews</li>
                            </ul>
                        </div>
                    </div>
                    <span><?= $product->price ?> EGP</span>
                    <div class="in-stock">
                        <p>Available: <span><?= $product->amount > 0 ? 'In stock' : 'Out Of Stock' ?></span></p>
                    </div>
                    <p><?= $product->details_en ?> </p>

                    <div class="quality-add-to-cart">
                        <div class="quality">
                            <label>Qty:</label>
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="01">
                        </div>
                        <div class="shop-list-cart-wishlist">
                            <a title="Add To Cart" href="#">
                                <i class="icon-handbag"></i>
                            </a>
                            <a title="Wishlist" href="#">
                                <i class="icon-heart"></i>
                            </a>
                        </div>
                    </div>

                    <div class="pro-dec-categories">
                        <ul>
                            <li class="categories-title">Tags: </li>
                            <li><a href="#"><?=  $product->brand_name_en ?>, </a></li>
                            <li><a href="#"> <?=  $product->subcategory_name_en ?> ,</a></li>
                            <li><a href="#"> <?=  $product->category_name_en ?> ,</a></li>
                            
                        </ul>
                    </div>
                    <div class="pro-dec-social">
                        <ul>
                            <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                            <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                            <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a></li>
                            <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                <a data-toggle="tab" href="#des-details2">Tags</a>
                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p><?= $product->details_en ?></p>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper">
                        <ul>
                            <li><span>Tags:</span></li>
                            <li><a href="#"><?=  $product->brand_name_en ?>, </a></li>
                            <li><a href="#"> <?=  $product->subcategory_name_en ?> ,</a></li>
                            <li><a href="#"> <?=  $product->category_name_en ?> ,</a></li>
                        </ul>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="rattings-wrapper">
                    <?php 
                        $getReviewsByProductResult = $productObject -> getReviewsByProduct();
                        if($getReviewsByProductResult){
                            $reviews = $getReviewsByProductResult->fetch_all(MYSQLI_ASSOC);
                            foreach ($reviews as $index => $review) { ?>
                               <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <?php for($i=0;$i<$review['value'];$i++){ ?>
                                                <i class="ion-star theme-color"></i>
                                            <?php }for($i=0;$i<5-$review['value'];$i++){ ?>
                                                <i class="ion-android-star-outline"></i>
                                            <?php }  ?>
                                            <span><?= $review['value'] ?></span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3><?= $review['name'] ?></h3>
                                            <span><?= $review['created_at'] ?></span>
                                        </div>
                                    </div>
                                    <p><?= $review['comment'] ?></p>
                                </div>
                            <?php }
                        }else{
                            echo "<div class='alert alert-warning'> No Reviews Yet </div>";
                        }

                    ?>
                        

                    </div>
                    <?php 
                    if(isset($_SESSION['user'])){ ?>
                        <div class="ratting-form-wrapper">
                        <h3>Add your Comments :</h3>
                        <div class="ratting-form">
                            <form action="#">
                                <div class="star-box">
                                    <h2>Rating:</h2>
                                    <div class="ratting-star">
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="rating-form-style mb-20">
                                            <input placeholder="Name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="rating-form-style mb-20">
                                            <input placeholder="Email" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="rating-form-style form-submit">
                                            <textarea name="message" placeholder="Message"></textarea>
                                            <input type="submit" value="add review">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Related Products</h2>
            </div>
            <div class="col-4">
                <div class="product-img">
                    <a href="product-details.html">
                        <img alt="" src="../assets/img/product/product-1.jpg">
                    </a>
                    <span>-30%</span>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.html">Le Bongai Tea</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php include_once "layouts/footer.php"; ?>