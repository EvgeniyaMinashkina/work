<?php
use App\Services\Page;
use App\Models\Product;
?>
<!doctype html>
<html lang="en">
<?php Page::part('head'); ?>

<body>
<div class="wrapper">
    <?php Page::part('navbar'); ?>
    <div class="content">
        <div class="container">
            <div class="row justify-content-xl-center">
                <div class="col-xl-10">
                    <div class="product product-single" id="product-<?php echo $productsItem['id']; ?>">
                        <div class="product-main">
                            <div class="product-image">
                                <img src="<?php echo Product::getImage($id)?>" class="img-thumbnail" alt="...">
                            </div>
                            <div class="product-body">
                                <h1 class="product-header"><?php echo $productsItem['name']; ?></h1>
                                <div class="wrap-info-product">
                                    <p class="product-manufacturer">Manufacturer: <?php echo $productsItem['manufacturer']; ?></p>
                                    <hr>
                                    <p class="product-quantity">Quantity: <?php echo $productsItem['quantity']; ?></p>
                                    <hr>
                                    <p class="product-price pricing-wrap">Price: <?php echo $productsItem['price']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="product-footer">
                            <div class="product-info product-description">
                                <h4>Description</h4>
                                <?php echo $productsItem['description']; ?>
                            </div>
                        </div>
                        <a href="/products" class="btn button right">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php Page::part('footer');?>


