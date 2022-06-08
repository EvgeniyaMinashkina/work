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
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="wrap-search">
                        <form  action="#" method="post" class="form-inline">
                            <input type="text" class="form-control left" id="search" placeholder="Search">
                            <button type="button" id="btn-search" class="btn button right">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="mt-4">Our products</h2>
            <?php if($user['is_admin']):?>
                <a class="btn-add-product btn right" href="/product/create">Add new product</a>
            <?php endif; ?>
            <div class="products">
                <div class="table-custom-responsive">
                    <table class="table" id="products-table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach ($productsList as  $productsItem):
                            //var_dump($productsItem); ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><a href="/products/<?php echo $productsItem['id']; ?>"><?php echo $productsItem['name']; ?></a></td>
                                <td><?php echo $productsItem['manufacturer']; ?></td>
                                <td><?php echo $productsItem['price']; ?></td>
                                <?php if($user['is_admin']):?>
                                    <td><a href="/product/delete/<?php echo $productsItem['id']; ?>">Delete</a></td>
                                    <td><a href="/product/update/<?php echo $productsItem['id']; ?>">Edit</a></td>
                                <?php endif; ?>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php Page::part('footer');?>
