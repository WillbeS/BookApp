<?php /** @var \App\Data\Template\AppData $appData */ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-2">
    <div class="container">
        <a class="navbar-brand logo" href="index.php">Books App</a>
        <button class="navbar-toggler navbar-toggler-right"
                type="button" data-toggle="collapse"
                data-target="#navbarResponsive"
                aria-controls="navbarResponsive"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php if ($appData->isAdmin()): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="create-book.php">Add Book</a>
                    </li>
                <?php endif; ?>

                <?php if ($appData->getSession()->getUserId()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="my-books.php">My Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>