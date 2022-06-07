<?php

use App\Models\User;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/products">4Works</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="/products">Home</a>
            </div>
        </div>
        <div class="d-flex">
            <!--            --><?php //if(!$_SESSION["user"]){ ?>
            <!--                    <a class="nav-link" href="/login">Login</a>-->
            <!--                    <a class="nav-link" href="/register">Register</a>-->
            <!--               --><?php //} else { ?>
            <!--                    <a class="nav-link" href="#">-->
            <?php //echo $_SESSION["user"]["email"]; ?><!--</a>-->
            <!--                    <form action="/auth/logout" method="post">-->
            <!--                        <button type="submit" class="btn dtn-danger">Logout</button>-->
            <!--                    </form>-->
            <!--            --><?php //} ?>
            <?php if (User::isGuest()): ?>
                <a class="nav-link" href="/login">Login</a>
                <a class="nav-link" href="/register">Register</a>
            <?php else: ?>
                <a class="nav-link" href="/logout">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
