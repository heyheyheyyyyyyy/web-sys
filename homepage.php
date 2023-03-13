<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container" >
            <h1 style="text-align:center">HomePage</h1>
            <div class="HomePage">
        
                <p  style="text-align:center">Some text about our Homepage.</p>
                <p  style="text-align:center">Resize the browser window to see that this page is responsive by the way.</p>
               
            </div><!-- #masthead -->
            <h2 style="text-align:center">Our Products!</h2>
            <div class="row">
                 <div class="card-group" style="display: flex; justify-content: center; align-items: center">
                    <div class="column">
                        <div class="card">
                            <img src="images/waterbottle1.jpeg" alt="Eco Bottle" style="display: block; margin: auto;">
                            <div class="container">
                                <h2>$10.00</h2>
                                <p class="title">ECO Bottle</p>
                                <p>Some text that describes item.</p>

                                <p><button class="button"><a href="contactus.php">Add to cart</a></button></p>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card" >
                            <img src="images/waterbottle2.jpeg" alt="Eco Bottle" "style="display: block; margin: auto;" >
                            
                            <div class="container">
                                <h2>$30.00</h2>
                                <p class="title">ECO Bottles</p>
                                <p>Package items four bottle for $30.00.</p>

                                <p><button class="button"><a href="contactus.php">Add to cart</a></button></p>
                            </div>
                        </div>
                    </div> 
                    <div class="column">
                        <div class="card">
                            <img src="images/waterbottle3.jpeg" alt="Eco Bottle"  style="display: block; margin: auto;">
                            <div class="container">
                                <h2>$9.00</h2>
                                <p class="title">ECO Bottle 3</p>
                                <p>Some text that describes item.</p>

                                <p><button class="button"><a href="contactus.php">Add to cart</a></button></p>
                            </div>
                        </div>
                    </div> 
                    <div class="column">
                        <div class="card">
                            <img src="images/waterbottle4.jpeg" alt="Eco Bottle" style="display: block; margin: auto;">
                            <div class="container">
                                <h2>$20.00</h2>
                                <p class="title">ECO Bottle 4</p>
                                <p>Some text that describes item.</p>

                                <p><button class="button"><a href="contactus.php">Add to cart</a></button></p>
                            </div>
                        </div>
                    </div>  
                    <div class="column">
                        <div class="card">
                            <img src="images/waterbottle2.jpeg" alt="Eco Bottle" style="display: block; margin: auto;">
                            <div class="container">
                                <h2>$20.00</h2>
                                <p class="title">ECO Bottle 5</p>
                                <p>Some text that describes item.</p>

                                <p><button class="button"><a href="contactus.php">Add to cart</a></button></p>
                            </div>
                        </div>
                    </div>  
                    <div class="column">
                        <div class="card">
                            <img src="images/waterbottle1.jpeg" alt="Eco Bottle" style="display: block; margin: auto;">
                            <div class="container">
                                <h2>$20.00</h2>
                                <p class="title">ECO Bottle 6</p>
                                <p>Some text that describes item.</p>

                                <p><button class="button"><a href="contactus.php">Add to cart</a></button></p>
                            </div>
                        </div>
                    </div>  
                </div>
        </main>
        <hr id="about">
        <!-- About Section -->
        <div class="w3-container w3-padding-32 w3-center">  
            <h3 style="text-align:center"> About Us, The Eco Bottle </h3><br>

            <img src="images/Mission.jpg" alt="Me" style="display:block;margin:auto" width="800" height="533">
            <div class="w3-padding-32">
                <h4 style="text-align:center"><b>Sustainability Is Our Dream!</b></h4>
                <h6 style="text-align:center"><i>With Passion, Going Green</i></h6>
                <p>Welcome to our eco water bottle website! We are committed to sustainability and providing eco-friendly solutions to help reduce single-use plastic waste. Our water bottles are made from high-quality materials that are durable, reusable, and recyclable.

                    We believe in taking a holistic approach to sustainability, and we strive to minimize our environmental impact at every stage of our product's lifecycle. From sourcing our materials to manufacturing and distribution, we prioritize eco-friendly practices and aim to reduce waste and carbon emissions.

                    Our mission is to inspire and empower individuals to make sustainable choices and create a positive impact on our planet. Join us in our journey towards a more sustainable future!</p>
            </div>
        </div>
        <hr>

        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>