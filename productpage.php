<?php
include 'session.php';
if (isset($_POST['addCart'])) {
    if (!isset($_SESSION['User_id'])) {
        echo '<script> alert("Please log in before you can add items to cart")</script>';
    }

    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['User_id'];
    $cart_qty = $_POST['quantity'];
    global $qty, $cart_id;

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
            //echo "<script>console.log('before qty : {$qty}');</script>";
        }
        if (isset($qty)) {
            $stmt->close();
            $qty = $qty + $cart_qty;
            $stmt1 = $conn->prepare("UPDATE Group2.Cart SET Cart_qty = ? where Cart_id = ?");
            $stmt1->bind_param("ii", $qty, $cart_id);
            if (!$stmt1->execute()) {
                $errorMsg = "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
                $success = false;
            }
            //echo "<script>console.log('Updated database');</script>";
            $stmt1->close();
        } else {
            $stmt->close();
            $stmt1 = $conn->prepare("INSERT INTO Group2.Cart(Product_id,User_id, Cart_Qty) VALUES (?,?,?)");
            $stmt1->bind_param("iii", $product_id, $user_id, $cart_qty);
            if (!$stmt1->execute()) {
                $errorMsg = "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
                $success = false;
            }

            //echo "<script>console.log('Added to database');</script>";
            $stmt1->close();
        }
    }
    $conn->close();
}
?>




<html>
    <?php
    include "head.inc.php";
    ?>
    <style>
        .container {
            margin: 0 auto;
            max-width: 960px; /* Optional - set a max-width to prevent the container from getting too wide */
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }
        img {
            max-width: 100%;
            margin-bottom: 30px;
        }
        p {
            font-size: 1.2rem;
            line-height: 1.5;
            margin-bottom: 30px;
        }
        .quantity-input {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-right: 10px;
        }
        input[type="number"] {
            width: 50px;
        }
        button {
            width: 150px;
            height: 50px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
            padding: 10px 20px;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0069d9;
        }
        a {
            text-decoration: none;
        }
        .cart-button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2rem;
        }
        .cart-button:hover {
            background-color: #218838;
        }


    </style>
</head>
<body>
    <?php include "nav.inc.php"; ?>
    <main class="container">
        <?php
// Get the product ID from the query parameter
        $product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($product_id <= 0) {
            // Invalid product ID
            die("Invalid product ID");
        }

// Fetch the product from the database
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM Group2.Product WHERE Product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            // Product not found
            die("Product not found");
        }
        $products = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        ?>

        <h1><?= $products['Product_name'] ?></h1>
        <img height='500' width='400'src="<?= $products['Product_image'] ?>">
        <p><?= $products['Product_desc'] ?></p>
        <p>Price: $<?= $products['Product_price'] ?></p>

        <!-- Add to cart form -->
        <form action="" method="POST" style="display: inline-block;">
            <input type="hidden" name="product_id" value="<?= $products['Product_id'] ?>"> 
            <div class="quantity-input">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
            </div>
            <br> <!-- add a line break to separate the form elements -->
            <button class="btn btn-info" type="submit" name="addCart" style="display: inline-block; margin-left: 10px;">Add to Cart</button>
        </form>



        <!-- View Cart button -->
        <a href="cart.php" style="display: inline-block; margin-left: 10px;"><button style="display: inline-block;">View Cart</button></a>

<!--                 Wishlist button 
        <form action="" method="POST" style="display: inline-block;">
            <input type="hidden" name="product_id" value="<?= $products['Product_id'] ?>">
            <button class="btn btn-outline-danger" type="submit" name="Wishlist" style="display: inline-block; margin-left: 10px;">
                <?php if (in_array($products['Product_id'], $_SESSION['Wishlist'])): ?>
                    <i class="bi bi-heart-fill"></i>
                <?php else: ?>
                    <i class="bi bi-heart"></i>
                <?php endif; ?>
            </button>
        </form>-->

<!--        <form method="post" action="">
            <input type="hidden" name="product_id" value="<?= $products['Product_id'] ?>">
            <button type="submit" name="addwishlist">Add to Wishlist</button>
        </form>-->

    </main>
    <?php
    include "footer.inc.php";
    ?>
</body>
</html>


<