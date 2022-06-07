<?php
use App\Services\Page;
use App\Models\Product;
?>
<!doctype html>
<html lang="en">
<?php //include ROOT . '/views/layouts/head.php';
Page::part('head');
?>

<body>
<?php //include ROOT . '/views/layouts/navbar.php';
Page::part('navbar');
?>
<div class="container">
    <div class="row justify-content-xl-center">
        <div class="col-xl-10">
            <div class="product product-single">
                <div class="product-img">
                    <img src="<?php echo Product::getImage($id)?>" class="img-thumbnail" alt="...">
                </div>
                <div class="product-body">
                    <h4 class="product-header"><?php echo $productsItem['name']; ?></h4>
                    <p class="product-brand"><?php echo $productsItem['manufacturer']; ?></p>
                    <p class="product-quantity"><?php echo $productsItem['quantity']; ?></p>
                    <p class="product-price pricing-wrap"><?php echo $productsItem['price']; ?></p>
                    <div class="product-info product-description">
                        <?php echo $productsItem['description']; ?>
                    </div>

                </div>
                <a href="/products">Back to Products</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>


