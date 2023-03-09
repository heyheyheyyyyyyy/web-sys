<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src ="images/cats.jpg" width="40" height="40" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="index.php#dogs">Dogs</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="index.php#cats">Cats</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="AboutUs.php">About Us</a>
          </li>
      </ul>
    </div>
  <div>
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <?php
    session_start();
    if (isset($_SESSION['email'])) {
        echo '<li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <button class="btn btn-secondary">
                    <i class="fa fa-sign-out"></i> Log out
                  </button>
                </a>
              </li>';
    } else {
        echo '<li class="nav-item">
                <a class="nav-link" href="register.php">
                  <button class="btn btn-primary">
                    <i class="fa fa-user-circle"></i> Register
                  </button>
                </a>
              </li>';
        echo '<li class="nav-item">
                <a class="nav-link" href="login.php">
                  <button class="btn btn-success">
                    <i class="fa fa-sign-in"></i> Log in
                  </button>
                </a>
              </li>';
    }
    ?>
  </ul>
</div>
</nav>