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
            <h2 class="mt-4">Sign In</h2>
            <form class="mt-4" action="#" method = "post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email"  id="email" value="<?php echo $email; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" >
                </div>
                <div class="mb-3">
                    <input type="submit" name="submit" class="btn button" value="Submit">
                </div>
            </form>
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