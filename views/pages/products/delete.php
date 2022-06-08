<?php
use App\Services\Page;
?>
<!doctype html>
<html lang="en">
<?php Page::part('head'); ?>

<body>
<div class="wrapper">
    <?php Page::part('navbar'); ?>

    <div class="content">
        <div class="container">
            <h2 class="mt-4">Delete product #<?php echo $id; ?>?</h2>
            <p>Are you sure you want to remove this product?</p>
            <div class="wrap-button">
                <form method="post" class="left">
                    <input type="submit" class="btn button-delete" name="submit" value="Delete" />
                </form>
                <a class="btn button right" href="/products">Cancel</a>
            </div>
        </div>
    </div>
<?php Page::part('footer');?>


