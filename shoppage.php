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
            <h1 style="text-align:center;background-color: #f2f2f2;">Products</h1>
            <div class="shoppage">
                <p  style="text-align:center">Eco Bottles.</p>
                <p  style="text-align:center">Resize the browser window to see that this page is responsive by the way.</p>

            </div><!-- #masthead -->
            <h2 style="text-align:center">Our Products!</h2>

            <div class="column">
                <?php
                show();
                if ($result->num_rows > 0) :
                    foreach ($result as $products) :
                        ?>
                        <tr>
                            <td><a href="#">
                                    <img width='250px' height='250px' src="<?= $products['Product_image'] ?>">
                                </a>
                            </td>

                            <td><?= $products['Product_name'] ?></td>
                            <td><?= $products['Product_desc'] ?></td>

                            <td><?= $products['Product_price'] ?></td>
                        <p><button class = "button"><a href = "productpage.php">Add to cart</a></button></p>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</main>
<hr id = "about">
<!--About Section-->
<div class = "w3-container w3-padding-32 w3-center">
    <h3 style = "text-align:center;background-color: #f2f2f2;"> About Us, The Eco Bottle </h3><br>

    <img src = "images/Mission.jpg" alt = "Me" style = "display:block;margin:auto" width = "800" height = "533">
    <div class = "w3-padding-32">
        <h4 style = "text-align:center"><b>Sustainability Is Our Dream!</b></h4>
        <h6 style = "text-align:center"><i>With Passion, Going Green</i></h6>
        <p>Welcome to our eco water bottle website!We are committed to sustainability and providing eco-friendly solutions to help reduce single-use plastic waste. Our water bottles are made from high-quality materials that are durable, reusable, and recyclable.

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
