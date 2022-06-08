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
            <h1 class="mt-4">404: Page not found</h1>
        </div>
    </div>

    <?php Page::part('footer');?>