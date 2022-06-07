<?php
use App\Services\Page;
?>
<!doctype html>
<html lang="en">
<?php Page::part('head'); ?>

<body>
<?php Page::part('navbar'); ?>
<div class="container">
    <h2 class="mt-4">Удалить товар <?php echo $id; ?>?</h2>
    <p>Вы действительно хотите удалить этот товар?</p>
    <form method="post">
        <input type="submit" name="submit" value="Delete" />
    </form>
</div>
</body>
</html>


