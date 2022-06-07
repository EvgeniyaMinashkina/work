<?php

use App\Services\Page;

?>
<!doctype html>
<html lang="en">
<?php Page::part('head'); ?>
<body>
<?php Page::part('navbar'); ?>
<div class="user-block">
    <p>Hello, <?php echo $user['email']; ?></p>
    <?php if($user['is_admin']):?>
        <a class="nav-link" href="/product/create">Добавить новый продукт</a>
    <?php endif; ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card mt-3"
                <div class="card-body">
                    <form  action="#" method="post" class="form-inline">
                        <input type="text" class="form-control w-75" id="search" placeholder="Search">
                        <button type="button" id="btn-search" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-item-action" id="content">
<!--                        <a href="#" class="list-group-item-action p-2 border">List 1</a>-->
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="container">
    <h2 class="mt-4">Our products</h2>
    <div class="products">

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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="http://4works/assets/js/main.js"></script>
</body>
</html>

