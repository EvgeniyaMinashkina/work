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

    foreach ($productsList as  $productsItem): ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><a href="/products/<?php echo $productsItem['id']; ?>"><?php echo $productsItem['name']; ?></a></td>
            <td><?php echo $productsItem['manufacturer']; ?></td>
            <td><?php echo $productsItem['price']; ?></td>

            <?php
            if($user[0]['is_admin']):?>
                <td><a href="/product/delete/<?php echo $productsItem['id']; ?>">Delete</a></td>
                <td><a href="/product/update/<?php echo $productsItem['id']; ?>">Edit</a></td>
            <?php endif; ?>
        </tr>
        <?php $i++;
    endforeach; ?>
    </tbody>
</table>
