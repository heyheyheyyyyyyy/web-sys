<<<<<<< HEAD


<nav id="main_nav" class="nav-menu-wrapper medium-down--hide" role="navigation">
                
                <!-- begin site-nav -->
                <ul class="site-nav" id="AccessibleNav">
                  
                    
                      <li class="site-nav__item">
                        <a
                          href="/collections/all"
                          class="site-nav__link"
                          data-meganav-type="child"
                          >
                            Shop
                        </a>
                      </li>
                    
                  
                    
                      <li class="site-nav__item">
                        <a
                          href="/blogs/featured"
                          class="site-nav__link"
                          data-meganav-type="child"
                          >
                            Features
                        </a>
                      </li>
                    
                  
                    
                      <li class="site-nav__item">
                        <a
                          href="/pages/contact-us-1"
                          class="site-nav__link"
                          data-meganav-type="child"
                          >
                            Contact
                        </a>
                      </li>
                    
                  
                    
                      <li class="site-nav__item">
                        <a
                          href="/pages/locations"
                          class="site-nav__link"
                          data-meganav-type="child"
                          >
                            Locations
                        </a>
                      </li>
                    
                  
                    
                      <li class="site-nav__item">
                        <a
                          href="https://uactp.com/"
                          class="site-nav__link"
                          data-meganav-type="child"
                          >
                            UACTP
                        </a>
                      </li>
                    
                  

                </ul> <!-- // MAIN MENU site-nav -->
              </nav>

 <nav id="utility_nav" class="nav-menu-wrapper medium-down--hide" role="navigation">                     <!-- begin site-nav -->
              <ul class="site-nav" id="Utility_Nav">
                
                  <li class="site-nav__item site-nav--search__bar auto-search-header">
                    <div class="search-bar-wrappa">
                    <!-- /snippets/search-bar-auto.liquid -->

                    
                      </div>
                    <a id="search_init_btn" class="site-nav__link site-nav__link--icon">
                      Search
                    </a>
                  </li>
                

                
                  <li class="site-nav__item site-nav__expanded-item site-nav__item--compressed">
                    <a class="site-nav__link site-nav__link--icon" href="/account">

                      
                      login
                      
                     
                      <span class="icon-fallback-text">
                       
                        <span class="fallback-text">
                          
                            Log In
                          
                        </span>
                      </span>
                    </a>
                  </li>
                

                <li class="site-nav__item site-nav__item--compressed">
                  <a class="site-nav__link site-nav__link--icon cart-link load-cart ">
                    cart
                  <span class="load-cartzor cart-item-count">(0)</span>
                    <span class="icon-fallback-text">
                      <!--<span class="icon icon-cart" aria-hidden="true"></span>-->
                      <span class="fallback-text">Cart</span>
                    </span>
                  </a>
                </li>
                <li class="site-nav__item site-nav__item--compressed">
                         
=======
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
              <a class="nav-link" href="ProductPage.php">Our Products</a>
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
>>>>>>> e1033c48f367e1ad691a449a74f2cffe583f0b10
