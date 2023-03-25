<?php
include 'session.php';
if (isset($_POST['addCart'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['User_id'];
    $cart_qty = 1;
    global $qty, $cart_id;

    echo "<script>console.log('{$product_id}');</script>";
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
        $stmt = $conn->prepare("SELECT * FROM Group2.Cart where Group2.Cart.User_id = ? and Group2.Cart.Product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cart_id = $row["Cart_id"];
            $qty = $row["Cart_Qty"];
            echo "<script>console.log('before qty : {$qty}');</script>";
            echo "<script>console.log('before cart: {$cart_id}');</script>";
        }
        if (isset($qty)) {
            $stmt->close();
            $qty = $qty + $cart_qty;
            echo "<script>console.log('qty : {$qty}');</script>";
            echo "<script>console.log('cart: {$cart_id}');</script>";
            $stmt1 = $conn->prepare("UPDATE Group2.Cart SET Cart_qty = ? where Cart_id = ?");
            $stmt1->bind_param("ii", $qty, $cart_id);
            if (!$stmt1->execute()) {
                $errorMsg = "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
                $success = false;
            }
            echo "<script>console.log('Updated database');</script>";
            $stmt1->close();
        } else {
            $stmt->close();
            $stmt1 = $conn->prepare("INSERT INTO Group2.Cart(Product_id,User_id, Cart_Qty) VALUES (?,?,?)");
            $stmt1->bind_param("iii", $product_id, $user_id, $cart_qty);
            if (!$stmt1->execute()) {
                $errorMsg = "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
                $success = false;
            }

            echo "<script>console.log('Added to database');</script>";
            $stmt1->close();
        }
    }
    $conn->close();
}
?>
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
            <h2 class="centered-text" style="text-align: center;">Our Products!</h2>
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
                                <form action="" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $products['Product_id'] ?>"> 
                                    <button class="btn btn-primary" type="submit" name="addCart">Add to Cart</button>
                                </form>
                                <br>
                                <br>
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
