<?php

use App\Services\Page;

?>
<!doctype html>
<html lang="en">
<?php Page::part('head'); ?>
<body>
<?php Page::part('navbar'); ?>
<div class="container">
    <?php if($result): ?>
        <p>Вы зарегистрированы залогиньтесь на странице <a href="/login">Login</a></p>
    <?php else: ?>
        <h2 class="mt-4">Sign Up</h2>
        <form class="mt-4" action="#" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
            </div>
            <!--
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username">
            </div>
            -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" value="<?php echo $password; ?>">
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Password Confirmation</label>
                <input type="password" name="password_confirm" class="form-control" id="password_confirm">
            </div>
            <div class="mb-3">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        <!--        <button type="submit" class="btn btn-primary">Submit</button>-->
        </form>
        <?php if(isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?> </li>
                <?php endforeach;?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>