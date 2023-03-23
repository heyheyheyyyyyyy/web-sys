<?php include 'session.php'; ?>
<html>
    <link rel="stylesheet" href="css/Shoppage.css">
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

            <div class="shoppage">
                <p class="centered-text">Eco Bottles.</p>
                <p class="centered-text">Resize the browser window to see that this page is responsive by the way.</p>

            </div><!-- #masthead -->
            <h2 class="centered-text">Our Products!</h2>

            <div class="column">
                <div class="card">
                     
                <?php
                show();
                if ($result->num_rows > 0) :
                    foreach ($result as $products) :
                        ?>



                             <a href="productpage.php?id=<?= $products['Product_id'] ?>">
                            <img width='300px' height='300px' class="products-image" src="<?= $products['Product_image'] ?>">
                            </a>
                            </td>      

                            <td class="Productname"><?= $products['Product_name'] ?></td> 
                            <br>

                            <td class="Productdesc"><?= $products['Product_desc'] ?></td>
                            <br>
                            <tr>
                            <br>
                            <td class="Productprice">$<?= $products['Product_price'] ?></td> <!-- Add class to the price td -->
                            <td> per bottle
                                <br>


                                <p><button class="AddtocartButton"><a href="productpage.php">Add to cart</a></button></p>
                                <?php
                            endforeach;
                        endif;
                        ?>

                </div>
               </div>
            </div>

        </main>
        <hr id="about">
        <!--About Section-->
        <div class="w3-container w3-padding-32 w3-center">
            <h3 class="centered-background"> About Us, The Eco Bottle </h3><br>

            <img src="images/Mission.jpg" alt="Me" style="display:block;margin:auto" width="800" height="533">
            <div class="w3-padding-32">
                <h4 class="centered-text"><b>Sustainability Is Our Dream!</b></h4>
                <h6 class="centered-text"><i>With Passion, Going Green</i></h6>
                <p>Welcome to our eco water bottle website!We are committed to sustainability and providing eco-friendly solutions to help reduce single-use plastic waste. Our water bottles are made from high-quality materials that are durable, reusable, and recyclable.

                    We believe in taking a holistic approach to sustainability, and we strive to minimize our environmental impact at every stage of our product's lifecycle. From sourcing our materials to manufacturing
                    and distribution, we prioritize eco-friendly practices and aim to reduce waste and carbon emissions.

                    Our mission is to inspire and empower individuals to make sustainable choices and create a positive impact on our planet. Join us in our journey towards a more sustainable future!</p>
            </div>
        </div>
        <hr>

        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>
<?php

function show() {
    global $errorMsg, $success, $result;
// Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
// Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
// Prepare the statement:
        $stmt = $conn->prepare("SELECT * FROM Group2.Product;");
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}
?>
