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
            <h2 class="mt-4">Edit product #<?php echo $id ?></h2>
            <form class="mt-4" action="#" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $product['name']; ?>">
                </div>
                <div class="mb-3">
                    <img src="<?php echo Product::getImage($id)?>" width="200" alt="">
                    <input type="file" name="image" class="form-control" id="image" value="<?php echo $product['image']; ?>">
                </div>
                <div class="mb-3">
                    <label for="manufacturer" class="form-label">Brand</label>
                    <input type="text" name="manufacturer" class="form-control" id="manufacturer" value="<?php echo $product['manufacturer']; ?>">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price, $</label>
                    <input type="number" step="0.01" min="0" placeholder="0,00" name="price" class="form-control" id="price" value="<?php echo $product['price']; ?>">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" min="0" placeholder="0" name="quantity" class="form-control" id="quantity" value="<?php echo $product['quantity']; ?>">
                </div>
                <div class="mb-3">
                    <textarea name="description" placeholder="description" value=""><?php echo $product['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" name="submit" class="btn button" value="Submit">
                </div>
            <?php if(isset($errors) && is_array($errors)): ?>
                <ul class="form-validation">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?> </li>
                    <?php endforeach;?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <?php Page::part('footer');?>



