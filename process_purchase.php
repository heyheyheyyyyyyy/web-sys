<?php include 'session.php'; ?>
<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        $errorMsg = "";
        $user_id = $_SESSION['User_id'];
        $success = true;

        getItemsFromCart();

        $json_data = json_encode($total_product);
        echo "<script>console.log('{$json_data}');</script>";

        // Create database connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
                $config['password'], $config['dbname']);
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        }

        if ($success) {
            foreach ($total_product as $row) {
                // $stmt1 = $conn->prepare("INSERT INTO Group2.Purchase(Purchase_product) VALUES (?) ");
                $stmt = $conn->prepare("INSERT INTO Group2.Purchase(Purchase_product, Purchase_qty, Purchase_price, User_id) VALUES (?, ?, ?, ?)");

                $name = $row['Product'];
                $qty = $row['Qty'];
                $price = $row['Price'];
                $stmt->bind_param("siii", $name, $qty, $price, $user_id);
                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                }
                if ($success) {
                    updateCart();
                }

                echo "<script>console.log('name: {$name}');</script>";
                echo "<script>console.log('qty: {$qty}');</script>";
                echo "<script>console.log('price: {$price}');</script>";
                $stmt->close();
            }
        }
        echo "<main class='container'><div class='formsclass'>";
        if ($success) {
            echo "<h2>Thank you for purchase our products!!</h2>";
            echo
            "<form action='index.php'>
                <button class='btn btn-success' type='submit'>Back to Home</button>
            </form>";
        } else {
            echo "<h1>Oops!</h1>";
            echo "<h2>The following input errors were detected:</h2>";
            echo "<p>" . $errorMsg . "</p>";
        }
        echo "</div></main>";
        include "footer.inc.php";
        ?>
    </body>
</html>

<?php

function getItemsFromCart() {

    global $total_product, $errorMsg, $success;

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
// Prepare the statement:
        $stmt = $conn->prepare("SELECT A.Cart_Qty, B.Product_name ,B.Product_price FROM Group2.Cart as A "
                . "inner join Group2.Product as B ON A.Product_id = B.Product_id AND A.User_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            foreach ($result as $cart) {
                //echo "<script>console.log('{$cart['Product_name']}');</script>";
                $total_product[] = array('Product' => $cart['Product_name'], 'Qty' => $cart['Cart_Qty'], 'Price' => $cart['Cart_Qty'] * $cart['Product_price']);
            }
        }
        $stmt->close();
    }
    $conn->close();
}

function updateCart() {

    global $errorMsg, $success;

    $user_id = $_SESSION['User_id'];
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $stmt = $conn->prepare("DELETE FROM Group2.Cart where User_id = ?");
        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
