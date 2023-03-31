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


<?php
include 'session.php';
if (isset($_POST['Wishlist'])) {
    if (!isset($_SESSION['User_id'])) {
        echo '<script> alert("Please log in before you can add items to wishlist")</script>';
    }

    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['User_id'];

    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Get the Cart_id of the current user:
        $stmt = $conn->prepare("SELECT Cart_id FROM Group2.Cart WHERE User_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $cart_row = $result->fetch_assoc();
            $cart_id = $cart_row['Cart_id'];

            // Check if the product is already in the user's wishlist:
            $stmt2 = $conn->prepare("SELECT * FROM Group2.Wishlist WHERE User_id = ? AND Product_id = ?");
            $stmt2->bind_param("ii", $user_id, $product_id);
            $stmt2->execute();

            $result2 = $stmt2->get_result();
            if ($result2->num_rows > 0) {
                echo '<script> alert("This item is already in your wishlist")</script>';
            } else {
                $stmt2->close();
                // Add the product to the user's wishlist:
                $stmt3 = $conn->prepare("INSERT INTO Group2.Wishlist(Product_id, User_id, Cart_id) VALUES (?, ?, ?)");
                $stmt3->bind_param("iii", $product_id, $user_id, $cart_id);
                if (!$stmt3->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
                    $success = false;
                } else {
                    // Successfully added to wishlist
                }
                $stmt3->close();
            }
        } else {
            // No cart found for user, create a new cart:
            $stmt4 = $conn->prepare("INSERT INTO Group2.Cart(User_id, Cart_qty, Product_id) VALUES (?, ?, ?)");
            $stmt4->bind_param("iis", $user_id, $qty, $prod_id);
            $qty = null;
            $prod_id = null;
            $stmt4->execute();

            $cart_id = $stmt4->insert_id;

            $stmt4->close();

            // Add the product to the user's wishlist:
            $stmt5 = $conn->prepare("INSERT INTO Group2.Wishlist(Product_id, User_id, Cart_id) VALUES (?, ?, ?)");
            $stmt5->bind_param("iii", $product_id, $user_id, $cart_id);
            if (!$stmt5->execute()) {
                $errorMsg = "Execute failed: (" . $stmt5->errno . ") " . $stmt5->error;
                $success = false;
            } else {
                // Successfully added to wishlist
            }
            $stmt5->close();
        }
    }
    $conn->close();
}
?>




<html>
    <head>
        <?php
        include "head.inc.php";
        include "nav.inc.php";
        ?>
        <link rel="stylesheet" href="css/main.css">
        <style>
            .btn {
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 5px; /* Add this rule */
            }
            .btn-secondary {
                background-color: #ccc;
                color: black;
                border: none;
            }

            .btn-info {
                background-color: #007bff;
                color: black;
                border: none;
            }

            .btn-info:hover {
                background-color: #bbb;
            }
            .btn-primary {
                background-color: #007bff;
                color: white;
                border: none;
            }

            .btn-primary:hover {
                background-color: #0069d9;
            }
        </style>
    </head>
    <body id="productpage">
        <div style="display: table; width: 100%; height: 100%;">
            <div style="display: table-cell; vertical-align: middle; text-align: center;">
                <main class="productpage-container">
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
                    <img class="product-img" src="<?= $products['Product_image'] ?>">
                    <p><?= $products['Product_desc'] ?></p>
                    <p>Price: $<?= $products['Product_price'] ?></p>
                    <!-- Add to cart form -->
                    <form class="add-to-cart-form" action="" method="POST" style="display: inline-block;">
                        <input type="hidden" name="product_id" value="<?= $products['Product_id'] ?>"> 
                        <div style="text-align: center;">
                            <div class="quantity-input productpage" style="display: flex !important; justify-content: center !important; align-items: center !important;">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
                            </div><br>

                        </div>
                        <button  class="btn btn-secondary" type="submit" name="addCart">Add to Cart</button>
                    </form>

                    <!-- View Cart button -->
                    <a  href="cart.php" style="display: inline-block;"><button  class="btn btn-primary">View Cart</button></a>

                    <form class="add-to-wishlist-form" action="" method="POST" style="display: inline-block;">
                        <input type="hidden" name="product_id" value="<?= $products['Product_id'] ?>">
                        <button id="add-to-wishlist-btn" class="btn btn-secondary" type="submit" name="Wishlist"> Wishlist </button>
                    </form>
                </main>
            </div>
        </div>
    </body>
    <?php include "footer.inc.php"; ?>
</html>
