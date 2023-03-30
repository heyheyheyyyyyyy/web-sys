


//<?php
//    include 'session.php';
//    // Create database connection.
//    $config = parse_ini_file('../../private/db-config.ini');
//    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
//
//    // Check connection
//    if ($conn->connect_error) {
//        $errorMsg = "Connection failed: " . $conn->connect_error;
//        $success = false;
//    } else {
//        if (isset($_POST['deletewishlist'])) {
//            $user_id = $_SESSION['User_id'];
//            $product_id = $_POST['product_id'];
//
//            // Prepare the statement:
//            $stmt = $conn->prepare("DELETE FROM Group2.Wishlist WHERE User_id = ? AND Product_id = ?");
//            $stmt->bind_param("ii", $user_id, $product_id);
//
//            // Execute the query statement:
//            $stmt->execute();
//
//            $stmt->close();
//        }
//    }
//
//    $conn->close();
//?>

<html>
    <head><?php
        include "head.inc.php";
        include "nav.inc.php";
        ?>
        <style>
            .wishlist-item {
                display: flex;
                align-items: center;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                box-shadow: 0 2px 5px rgba(0,0,0,.2);
            }

            .wishlist-item img {
                max-width: 100px;
                margin-right: 20px;
            }

            .wishlist-item-details {
                display: flex;
                flex-direction: column;
            }

            .wishlist-item-name {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .wishlist-item-price {
                font-size: 16px;
                margin-bottom: 10px;
            }

            .wishlist-item-remove {
                margin-left: auto;
                font-size: 18px;
                color: #f00;
                cursor: pointer;
            }
        </style>
    </head>
    <?php
    include 'session.php';

// Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $user_id = $_SESSION['User_id'];

        // Prepare the statement:
        $stmt = $conn->prepare("SELECT * FROM Group2.Wishlist INNER JOIN Group2.Product ON Group2.Wishlist.Product_id = Group2.Product.Product_id WHERE Group2.Wishlist.User_id = ?");
        $stmt->bind_param("i", $user_id);

        // Execute the query statement:
    $stmt->execute();
    $result = $stmt->get_result();

     if ($result->num_rows > 0) {
        // Display the results:
        while ($row = $result->fetch_assoc()) {
            echo "<div class='wishlist-item'>";
            echo "<img src='" . $row['Product_image'] . "' alt='Product Image'>";
            echo "<div class='wishlist-item-details'>";
            echo "<div class='wishlist-item-name'>" . $row['Product_name'] . "</div>";
            echo "<div class='wishlist-item-price'>$" . $row['Product_price'] . "</div>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='product_id' value='" . $row['Product_id'] . "'>";
            echo "<button type='submit' name='deletewishlist'>Delete</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Your wishlist is currently empty.</p>";
    }

    $stmt->close();
}

$conn->close();
    include "footer.inc.php";
    ?>
</body>
</html>

//<?php
//include 'session.php';
//if (isset($_POST['addwishlist'])) {
//    if (!isset($_SESSION['User_id'])) {
//        echo '<script> alert("Please log in before you can add items to wishlist")</script>';
//    }
//
//    // Create database connection.
//    $config = parse_ini_file('../../private/db-config.ini');
//    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
//
//    // Check connection
//    if ($conn->connect_error) {
//        $errorMsg = "Connection failed: " . $conn->connect_error;
//        $success = false;
//    } else {
//        $user_id = $_SESSION['User_id'];
//        $product_id = $_POST['product_id'];
//
//        // Prepare the statement:
//        $stmt = $conn->prepare("INSERT INTO Group2.Wishlist (User_id, Product_id) VALUES (?, ?)");
//        $stmt->bind_param("ii", $user_id, $product_id);
//
//        // Execute the statement:
//        if ($stmt->execute()) {
//            echo "Product added to wishlist!";
//        } else {
//            echo "Error adding product to wishlist: " . $conn->error;
//        }
//
//        $stmt->close();
//    }
//
//    $conn->close();
//?>
