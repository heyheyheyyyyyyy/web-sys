<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="images/logog.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <!-- Center Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shoppage.php">Shop</a>
                </li>
                <?php
                if ($_SESSION['User_role'] == 2) {
                    echo
                    "<li class='nav-item'><a class='nav-link' href='admin_page.php'>Admin Product</a></li>";
                    echo
                    "<li class='nav-item'><a class='nav-link' href='staffviewprofiles.php'>Admin Profiles</a></li>";
                } else {
                    echo
                    "<li class='nav-item'><a class='nav-link' href='contactus.php'>Contact</a></li>";
                    echo
                    "<li class='nav-item'><a class='nav-link' href='aboutus.php'>About Us</a></li>";
                }
                ?>
            </ul>
            <!-- Right Links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form class="d-flex" action="shoppage.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search for product" aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </li>
                <?php
                if (isset($_SESSION['User_id'])) {
                    echo
                    "<li class='nav-item'>
                    <a class='nav-link' href='#'>Wishlist</a>
                </li>";
                    echo
                    "<li class='nav-item'>
                    <a class='nav-link' href='cart.php'>Cart</a>
                </li>";
                    echo
                    "<li class='nav-item'>
                    <a class='nav-link' href='edit_profile.php'>Edit Profile</a>
                </li>";
                    echo
                    "<li class='nav-item'>
                    <a class='nav-link' href='logout.php'>Logout</a>
                </li>";
                } else {
                    echo
                    "<li class = 'nav-item'>
                    <a class = 'nav-link' href = 'login.php'>Login</a>
                </li>";
                    echo
                    "<li class = 'nav-item'>
                    <a class = 'nav-link' href = 'register.php'>Register</a>
                </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
