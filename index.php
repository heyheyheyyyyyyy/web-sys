<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->

<html>
    <?php 
    include "head.inc.php";
    ?>
    <body>
        <?php
        include "nav.inc.php";
        ?>

       <div class= "slider-frame " >
            <div class="slide-images ">
                <div class= "img-container">>
                    <img src="images/pic1.jpg">
                </div>
                <div class="img-container">
                    <img src="images/pic2.jpg">
                </div>
                <div class="img- container">
                    <img src= "images/p3.jpg">
                </div>
            </div>
        </div>

        <div class="features">
            <div class="feature">
                <img src="images/snowflake.png" alt="" class="featureIcon">
                <span class="featureTitle">QuenchChill</span>
                <span class="featureDesc">Our bottle has a built-in cooling system, keeping your water refreshingly cold even in the hottest weather.</span>
            </div>
            <div class="feature">
                <img class="featureIcon" src="images/puzzle.png" alt="">
                <span class="featureTitle">QuenchFit</span>
                <span class="featureDesc">Our bottle is designed to fit comfortably in your hand, with a sleek and ergonomic shape that feels great to hold.</span>
            </div>
            <div class="feature">
                <img class="featureIcon" src="images/bpa.png" alt="">
                <span class="featureTitle">QuenchGuard</span>
                <span class="featureDesc">Bpa and toxin free</span>
            </div>
            <div class="feature">
                <img class="featureIcon" src="images/money.png" alt="">
                <span class="featureTitle">QuenchSaver</span>
                <span class="featureDesc">Our eco-friendly bottle design helps you save money and reduce waste by avoiding single-use plastic bottles.</span>
            </div>
        </div>

        <div class="product" id="product">
            <img src="https://images.pexels.com/photos/3737802/pexels-photo-3737802.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="" class="productImg">
            <div class="productDetails">
                <h1 class="productTitle">HydrO2</h1>
                <h1 class="productTitleSmall">new arrivals</h1>
                <h2 class="productPrice">$49.90</h2>
                <p class="productDesc">With inspiration drawn from the natural lotus effect, we utilize advanced technology to convert silicon dioxide, one of the earth's most fundamental elements, into a remarkably pristine glass-like interior finish, ensuring the purity of your drinks. Designed in California and produced in Singapore.

                </p>


                <div class="colors">
                    <div class="color"></div>
                    <div class="color"></div>
                </div>

                <button class="productButton">BUY NOW!</button>
            </div>
            <div class="payment">
                <h1 class="payTitle">Personal Information</h1>
                <label>Name and Surname</label>
                <input type="text" placeholder="Name" class="payInput">
                <label>Phone Number</label>
                <input type="text" placeholder="+6500000000" class="payInput">
                <label>Address</label>
                <input type="text" placeholder="Singapore" class="payInput">
                <h1 class="payTitle">Card Information</h1>
                <div class="cardIcons">
                    <img src="./img/visa.png" width="40" alt="" class="cardIcon">
                    <img src="./img/master.png" alt="" width="40" class="cardIcon">
                </div>
                <input type="password" class="payInput" placeholder="Card Number">
                <div class="cardInfo">
                    <input type="text" placeholder="mm" class="payInput sm">
                    <input type="text" placeholder="yyyy" class="payInput sm">
                    <input type="text" placeholder="cvv" class="payInput sm">
                </div>
                <button class="payButton">Checkout!</button>
                <span class="close">X</span>
            </div>
        </div>
        <div class="gallery">
            <div class="galleryItem">
                <h1 class="galleryTitle">Pure refreshment, every sip.</h1>
                <img src="https://images.pexels.com/photos/3738065/pexels-photo-3738065.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load"
                     alt="" class="galleryImg">
            </div>
            <div class="galleryItem">
                <img src="https://images.pexels.com/photos/3738060/pexels-photo-3738060.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load"
                     alt="" class="galleryImg">
                <h1 class="galleryTitle">Sip smart, hydrate better</h1>
            </div>
            <div class="galleryItem">
                <h1 class="galleryTitle">Quench your thirst, elevate your day.</h1>
                <img src="https://images.pexels.com/photos/6187637/pexels-photo-6187637.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load"
                     alt="" class="galleryImg">
            </div>
        </div>
        <div class="newSeason">
            <div class="nsItem">
                <img src="https://images.pexels.com/photos/10475606/pexels-photo-10475606.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load"
                     alt="" class="nsImg">
            </div>
            <div class="nsItem">
                <h3 class="nsTitleSm">MARCH NEW ARRIVALS</h3>
                <h1 class="nsTitle">MORE SLEEK</h1>
                <h1 class="nsTitle">MORE COLLECTIONS</h1>
                <a href="#nav">
                    <button class="nsButton">CHOOSE YOUR STYLE</button>
                </a>
            </div>
            <div class="nsItem">
                <img src="https://images.pexels.com/photos/10475607/pexels-photo-10475607.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load"
                     alt="" class="nsImg">
            </div>
        </div>
        <?php
        include "footer.inc.php";
        ?>
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        <script src="js/main.js"></script>
    </body>
</html>
