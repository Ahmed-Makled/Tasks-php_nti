<?php
include_once "shared/header.php";
include_once "shared/navbar.php";
include_once "../models/Category.model.php";
include_once "../models/subcategory.model.php";
include_once "../models/product.model.php";
include_once "../models/brand.model.php";


$categoryObj = new category;
$subcategoryObj = new subcategory;
$productData = new product;
$brandData = new brand;

if (isset($_GET['sub'])) {
    if ($_GET['sub']) {
        if (is_numeric($_GET['sub'])) {
            $subcategoryObj->setId($_GET['sub']);
            $subResult = $subcategoryObj->searchOnSub();
            if ($subResult) {
                $subcategoryId = $_GET['sub'];
                $productData->setSubcategory_id($subcategoryId);
                $productsResult = $productData->productsBySub();
            } else {
                header('location:404.php');
            }
        } else {
            header('location:404.php');
        }
    } else {
        header('location:404.php');
    }
}

if (isset($_GET['brand'])) {
    if ($_GET['brand']) {
        if (is_numeric($_GET['brand'])) {
            $brandData->setId($_GET['brand']);
            $brandResult = $brandData->searchOnBrand();
            if ($brandResult) {
                $brandId = $_GET['brand'];
                $productData->setBrand_id($brandId);
                $productsResult = $productData->productsByBrand();
            } else {
                header('location:404.php');
            }
        } else {
            header('location:404.php');
        }
    } else {
        header('location:404.php');
    }
}

if (isset($_GET['cat'])) {
    if ($_GET['cat']) {
        if (is_numeric($_GET['cat'])) {
            $categoryObj->setId($_GET['cat']);
            $categoryResult = $categoryObj->searchOnCategory();
            if ($categoryResult) {
                $CategoryId = $_GET['cat'];
                $categoryObj->setId($CategoryId);
                $productsResult = $categoryObj->productsByCat();
            } else {
                header('location:404.php');
            }
        } else {
            header('location:404.php');
        }
    } else {
        header('location:404.php');
    }
}
if (!isset($_GET['brand']) and !isset($_GET['sub']) and !isset($_GET['cat'])) {
    $productsResult = $productData->selectData();
}


?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>SHOP PAGE</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">SHOP PAGE</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- Shop Page Area Start -->
<div class="shop-page-area ptb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="shop-topbar-left">
                        <ul class="view-mode">
                            <li class="active"><a href="#product-grid" data-view="product-grid"><i
                                        class="fa fa-th"></i></a></li>
                            <li><a href="#product-list" data-view="product-list"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
                        <p>Showing 1 - 20 of 30 results </p>
                    </div>
                    <div class="product-sorting-wrapper">
                        <div class="product-shorting shorting-style">
                            <label>View:</label>
                            <select>
                                <option value=""> 20</option>
                                <option value=""> 23</option>
                                <option value=""> 30</option>
                            </select>
                        </div>
                        <div class="product-show shorting-style">
                            <label>Sort by:</label>
                            <select>
                                <option value="">Default</option>
                                <option value=""> Name</option>
                                <option value=""> price</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?php

                            if ($productsResult) {
                                $products = $productsResult->fetch_all(MYSQLI_ASSOC);
                                foreach ($products as $key => $product) { ?>
                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.php?pro=<?= $product['id'] ?>">
                                            <img alt="" src="../assets/img/product/<?= $product['image'] ?>">
                                        </a>
                                        <div class="product-action">
                                            <a class="action-wishlist" href="#" title="Wishlist">
                                                <i class="ion-android-favorite-outline"></i>
                                            </a>
                                            <a class="action-cart" href="#" title="Add To Cart">
                                                <i class="ion-ios-shuffle-strong"></i>
                                            </a>
                                            <a class="action-compare" href="#" data-target="#exampleModal"
                                                data-toggle="modal" title="Quick View">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content text-left">
                                        <div class="product-hover-style">
                                            <div class="product-title">
                                                <h4>
                                                    <a
                                                        href="product-details.php?pro=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                                </h4>
                                            </div>
                                            <div class="cart-hover">
                                                <h4><a href="product-details.php?pro=<?= $product['id'] ?>">+ Add to
                                                        cart</a></h4>
                                            </div>
                                        </div>
                                        <div class="product-price-wrapper">
                                            <span><?= $product['price'] ?> EGP</span>
                                        </div>
                                    </div>
                                    <div class="product-list-details">
                                        <h4>
                                            <a
                                                href="product-details.php?pro=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                        </h4>
                                        <div class="product-price-wrapper">
                                            <span><?= $product['price'] ?> EGP</span>
                                        </div>
                                        <p><?= $product['details'] ?></p>
                                        <div class="shop-list-cart-wishlist">
                                            <a href="#" title="Wishlist"><i
                                                    class="ion-android-favorite-outline"></i></a>
                                            <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                            <a href="#" data-target="#exampleModal" data-toggle="modal"
                                                title="Quick View">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
                            } else {
                                echo "<div class='alert alert-warning'> No Products </div>";
                            }
                            ?>


                        </div>
                    </div>
                    <div class="pagination-total-pages">
                        <div class="pagination-style">
                            <ul>
                                <li><a class="prev-next prev" href="#"><i class="ion-ios-arrow-left"></i> Prev</a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a class="prev-next next" href="#">Next<i class="ion-ios-arrow-right"></i> </a></li>
                            </ul>
                        </div>
                        <div class="total-pages">
                            <p>Showing 1 - 20 of 30 results </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Shop By Categories</h4>
                        <div class="shop-catigory">
                            <ul id="faq">
                                <?php $categoriesResult = $categoryObj->selectData();
                                if ($categoriesResult) {
                                    $categories = $categoriesResult->fetch_all(MYSQLI_ASSOC);
                                    foreach ($categories as $index => $category) { ?>
                                <li> <a data-toggle="collapse" data-parent="#faq"
                                        href="#shop-catigory-<?= $category['id'] ?>"><?= $category['name'] ?><i
                                            class="ion-ios-arrow-down"></i></a>
                                    <ul id="shop-catigory-<?= $category['id'] ?>" class="panel-collapse collapse ">
                                        <?php
                                                $subcategoryObj->setCategory_id($category['id']);
                                                $subsResult = $subcategoryObj->getSubsFromCats();
                                                if ($subsResult) {
                                                    $subs = $subsResult->fetch_all(MYSQLI_ASSOC);
                                                    foreach ($subs as $key => $sub) { ?>
                                        <li><a href="shop.php?sub=<?= $sub['id'] ?>"><?= $sub['name'] ?></a></li>
                                        <?php }
                                                } else {
                                                    echo "No Sub Categories Yet";
                                                }
                                                ?>


                                    </ul>
                                </li>
                                <?php }
                                } else {
                                    echo "No Categories Yet";
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                    <div class="shop-price-filter mt-40 shop-sidebar-border pt-35">
                        <h4 class="shop-sidebar-title">Price Filter</h4>
                        <div class="price_filter mt-25">
                            <span>Range: $100.00 - 1.300.00 </span>
                            <div id="slider-range"></div>
                            <div class="price_slider_amount">
                                <div class="label-input">
                                    <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                </div>
                                <button type="button">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="shop-widget mt-40 shop-sidebar-border pt-35">
                        <h4 class="shop-sidebar-title">By Brand</h4>
                        <div class="sidebar-list-style mt-20">
                            <ul>
                                <?php
                                $brandsResult = $brandData->selectData();
                                if ($brandsResult) {
                                    $brands = $brandsResult->fetch_all(MYSQLI_ASSOC);
                                    foreach ($brands as $key => $brand) { ?>
                                <li><a href="shop.php?brand=<?= $brand['id']; ?>"><?= $brand['name']; ?> </a>
                                    <?php  }
                                } else { ?>
                                <li>No Brands</li>
                                <?php }
                                    ?>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer style Start -->
<?php include_once "shared/footer.php" ?>