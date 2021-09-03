<?php
include_once "shared/header.php";
include_once "shared/navbar.php";
include_once "../models/product.model.php";
$productobj = new product;

if (isset($_GET['pro'])) {

    if ($_GET['pro']) {

        if (is_numeric($_GET['pro'])) {

            $productobj->setId($_GET['pro']);

            $productResult = $productobj->searchOnProduct();
            // echo 'ok';
            // die;
            if ($productResult) {

                $product = $productResult->fetch_object();
            } else {
                header('location:404.php');
            }
        } else {
            header('location:404.php');
        }
    } else {
        header('location:404.php');
    }
} else {
    header('location:404.php');
}

?>
<!-- header end -->
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3><?= $product->name ?></h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active"><?= $product->name ?></li>
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
                    <img class="zoompro" src="../assets/img/product/<?= $product->image ?>"
                        data-zoom-image="../assets/img/product-details/product/<?= $product->image ?>" alt="zoom" />
                    <div id="gallery" class="mt-20 product-dec-slider owl-carousel">
                        <a data-image="../assets/img/product-details/product/<?= $product->image ?>"
                            data-zoom-image="assets/img/product-details/product/<?= $product->image ?>">
                            <img src="../assets/img/product-details/product/<?= $product->image ?>" alt="">
                        </a>

                    </div>
                    <!-- <span>-29%</span> -->
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $product->name ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <?php for ($i = 1; $i <= $product->reviews_avg; $i++) { ?>
                            <i class="ion-android-star-outline theme-star"></i>
                            <?php }
                            for ($i = $product->reviews_avg; $i < 5; $i++) { ?>
                            <i class="ion-android-star-outline"></i>
                            <?php } ?>


                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li><?= $product->reviews_count ?> Reviews </li>
                                <li> Add Your Reviews</li>
                            </ul>
                        </div>
                    </div>
                    <span><?= $product->price ?></span>
                    <div class="in-stock">
                        <p>Available: <span>
                                <?php
                                if ($product->quantity) {
                                    $class = "text-success";
                                    $msg = "in-stock: ";
                                    if ($product->quantity < 10) {
                                        $class = "text-danger";
                                        $msg .= $product->quantity;
                                    }
                                } else {
                                    $class = "text-danger";
                                    $msg = "out-of-stock";
                                }
                                ?>
                                <span class="<?= $class ?>"><?= $msg ?></span>
                            </span></p>
                    </div>
                    <p><?= $product->details ?></p>

                    <div class="quality-add-to-cart">
                        <div class="quality">
                            <label>Qty:</label>
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
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
                            <li><a href="shop.php?cat=<?= $product->category_id ?>"><?= $product->category_name ?>,</a>
                            </li>
                            <li><a href="shop.php?sub=<?= $product->subcategory_id ?>"><?= $product->subcategory_name ?>,
                                </a></li>
                            <li><a href="shop.php?brand=<?= $product->brand_id ?>"><?= $product->brand_name ?></a></li>

                        </ul>
                    </div>
                    <div class="pro-dec-social">
                        <ul>
                            <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                            <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                            <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a>
                            </li>
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
                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p><?= $product->details; ?></p>
                    </div>
                </div>

                <div id="des-details3" class="tab-pane">
                    <?php
                    $productobj->setId($product->id);
                    $reviewsResult = $productobj->getProductReviews();
                    if ($reviewsResult) {
                        $reviews = $reviewsResult->fetch_all(MYSQLI_ASSOC);
                        foreach ($reviews as $index => $review) { ?>
                    <div class="rattings-wrapper">
                        <div class="sin-rattings">
                            <div class="star-author-all">
                                <div class="ratting-star f-left">
                                    <?php for ($i = 1; $i <= $review['value']; $i++) { ?>
                                    <i class="ion-star theme-color"></i>
                                    <?php }
                                            for ($i = $review['value']; $i < 5; $i++) { ?>
                                    <i class="ion-android-star-outline"></i>
                                    <?php } ?>
                                    <span><?= $review['value'] ?></span>
                                </div>
                                <div class="ratting-author f-right">
                                    <h3><?= $review['user_name'] ?></h3>
                                    <span><?= $review['created_at'] ?></span>
                                </div>
                            </div>
                            <p><?= $review['comment'] ?></p>
                        </div>

                    </div>
                    <?php }
                    } else {
                        echo "<div class='alert alert-warning'> No Reviews Yet </div>";
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-35">
            <div class="section-title-wrap">
                <h3 class="section-title section-bg-white">Related Products</h3>
            </div>
        </div>
        <div class="row">
            <?php
            $productobj->setSubcategory_id($product->subcategory_id);
            $relatedProductsResult = $productobj->relatedProducts();
            if ($relatedProductsResult) {
                $relatedProducts = $relatedProductsResult->fetch_all(MYSQLI_ASSOC);
                foreach ($relatedProducts as $key => $relatedProduct) { ?>
            <div class="col-3">
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="product-details.php">
                            <img alt="" src="assets/img/product/<?= $relatedProduct['image'] ?>">
                        </a>
                        <div class="product-action">
                            <a class="action-wishlist" href="#" title="Wishlist">
                                <i class="ion-android-favorite-outline"></i>
                            </a>
                            <a class="action-cart" href="#" title="Add To Cart">
                                <i class="ion-ios-shuffle-strong"></i>
                            </a>
                            <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal"
                                title="Quick View">
                                <i class="ion-ios-search-strong"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-content text-left">
                        <div class="product-hover-style">
                            <div class="product-title">
                                <h4>
                                    <a href="product-details.php"><?= $relatedProduct['name'] ?></a>
                                </h4>
                            </div>
                            <div class="cart-hover">
                                <h4><a href="product-details.php">+ Add to cart</a></h4>
                            </div>
                        </div>
                        <div class="product-price-wrapper">
                            <span><?= $relatedProduct['price'] ?> EGP</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            } else {
            }
            ?>

        </div>
    </div>
</div>
<!-- Footer style Start -->
<?php include_once "shared/footer.php" ?>