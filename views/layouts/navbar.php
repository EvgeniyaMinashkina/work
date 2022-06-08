<?php

use App\Models\User;
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/products">4Works</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

            </div>
            <div class="d-flex">
                <?php if (User::isGuest()): ?>
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                <?php else: ?>
                    <p class="nav-link"><?php echo User::getUserById($_SESSION['user'])["email"]; ?></p>
                    <a class="nav-link" href="/logout">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
