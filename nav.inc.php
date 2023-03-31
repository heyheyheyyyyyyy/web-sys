<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <img src="images/logog.png" alt="logo">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarTogglerDemo02" 
                aria-controls="navbarTogglerDemo02" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product Category</a>
                    <ul class="dropdown-menu dropdown-menu">
                        <li><a class="dropdown-item" href="shoppage.php?category=EcoBottle">Eco Bottle</a></li>
                        <li><a class="dropdown-item" href="shoppage.php?category=Glass">Glass</a></li>
                        <li><a class="dropdown-item" href="shoppage.php?category=Insulated">Insulated</a></li>
                        <li><a class="dropdown-item" href="shoppage.php?category=BPA-free">BPA-free</a></li>
                        <li><a class="dropdown-item" href="shoppage.php?category=Stainless_Steel">Stainless_Steel</a></li>
                        <li><a class="dropdown-item" href="shoppage.php?category=Others">Others</a></li>
                    </ul>
                </li>
                <?php
                if ($_SESSION['User_role'] == 2) {
                    echo
                    "<li class='nav-item'><a class='nav-link' href='admin_page.php'>Admin Product</a></li>";
                    echo
                    "<li class='nav-item'><a class='nav-link' href='staffviewprofiles.php'>Admin Profiles</a></li>";
                }
                ?>

                <li class='nav-item'><a class='nav-link' href='contactus.php'>Contact</a></li>
                <li class='nav-item'><a class='nav-link' href='aboutus.php'>About Us</a></li>

            </ul>
            <!-- Right Links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form class="d-flex" action="shoppage.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search for product" aria-label="Search" name="search">
                        <button class="btn btn-outline-success search-btn" type="submit">Search</button>
                    </form>
                </li>
                <?php
                if (isset($_SESSION['User_id'])) {
                    $lname = $_SESSION['lname'];
                    echo
                    "<li class='nav-item dropdown'> 
                    <a class='nav-link dropdown-toggle' href='' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$lname</a>
                    <ul class='dropdown-menu dropdown-menu'>
                        <li><a class='dropdown-item' href='edit_profile.php'>Edit Profile</a></li>
                        <li><a class='dropdown-item' href = 'purchasehistory.php'>Purchase History</a></li>
                        <li><a class='dropdown-item' href = 'wishlist.php'>Wishlist</a></li>
                        <li><a class='dropdown-item' href = 'logout.php'>Logout</a></li>
                    </ul>
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

                <li class='nav-item'>
                    <a class='nav-link' href='cart.php'>Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
