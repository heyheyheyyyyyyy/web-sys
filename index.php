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
        <link rel="stylesheet" href="css/main.css">


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
        
        <!--can push into css file later or sth-->
        <style>
        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
        .msg-item-whatsapp {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(0, 151, 19, 0.7);
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        }
        .msg-item-whatsapp svg {
            height: 40px;
            width: 40px;
            color: white;
        }
        .msg-item-whatsapp svg:hover {
            color: green; /* set hover fill to green */
        }
        </style>
        <div class="floating-button">
            <a class="messanger msg-item-whatsapp" id="msg-item-2" href="https://wa.me/6583308530" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" opacity="1" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
                </svg>
            </a>
        </div>
    </body>
</html>
