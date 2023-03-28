<?php
include 'session.php';
if (isset($_POST['addCart'])) {
    if (!isset($_SESSION['User_id'])) {
        echo '<script> alert("Please log in before you can add items to cart")</script>';
    }

    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['User_id'];
    $cart_qty = 1;
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
    <head>
        <?php
        include "head.inc.php";
        ?>
        <link rel="stylesheet" href="css/main.css">
        <style>
            .product-grid {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center; /* Add this rule */
                max-width: 1200px;
                margin: 0 auto; /* Add this rule */
            }

            .product-card {
                width: calc((100% - 30px) / 3);
                height:  600px;
                margin: 10px 5px;
                background-color: white;
                border-radius: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }
            .product-card-image img {
                width: 100%;
                height: 400px;
                object-fit: cover;
                object-position: center;
            }
            .product-card-details {
                padding: 20px;
            }
            .product-name {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .product-description {
                font-size: 14px;
                margin-bottom: 10px;
            }
            .product-price {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .product-card-buttons {
                display: flex;
                justify-content: center;
                align-items: center;
            }

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
                background-color: #eee;
                color: black;
                border: none;
            }
            .btn-info {
                background-color: #007bff;
                color: white;
                border: none;
            }
            .btn-info:hover {
                background-color: #0069d9;
            }
        </style>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <div class="container">
            <h2>Our Products!</h2>
            <br>
            <div class="product-grid"> 
                <?php
                $config = parse_ini_file('../../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

                if ($_GET['search'] != null) {
                    $sql = $conn->prepare("SELECT * FROM Group2.Product where Product_name LIKE CONCAT('%',?,'%')");
                    $sql->bind_param('s', $_GET['search']);
                    $sql->execute();
                    $result = $sql->get_result();
                } else {
                    $sql = "SELECT * FROM Group2.Product";
                    $result = $conn->query($sql);
                }


                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $product_name = $row["Product_name"];
                        $product_image = $row["Product_image"];
                        $product_price = $row["Product_price"];
                        $product_desc = $row["Product_desc"];
                        $product_id = $row["Product_id"];

                        echo'
                    <div class = "product-card">
                    <div class = "product-card-image">
                    <a href = "productpage.php?id=' . $product_id . '">
                    <img class = "product-image" src = "' . $product_image . '" alt = "' . $product_name . '">
                    </a>
                    </div>
                    <div class = "product-card-details">
                    <p class = "product-name">' . $product_name . '</p>
                    <p class = "product-description">' . $product_desc . '</p>
                    <p class = "product-price"> SGD ' . $product_price . '</p>
                    <div class = "product-card-buttons">
                    <form action = "productpage.php?id=' . $product_id . '" method = "POST">
                    <button class = "btn btn-secondary" type = "submit">View Product</button>
                    </form>
                    <form action = "" method = "POST">
                    <input type = "hidden" value = "' . $product_id . '">
                    <button class = "btn btn-info" type = "submit" name = "addCart">Add to Cart</button>
                    </form>
                    </div>
                    </div>
                    </div>';
                    }
                } else {
                    echo "No products found.";
                }
                ?>
            </div>
        </div>
        <?php
        include "footer.inc.php";
        ?>
    </body> 
</html>
