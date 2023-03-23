<?php include 'session.php'; ?>
<?php
if (isset($_POST['addCart'])) {
    $product_id = $_POST['product_id'];
    $user_id = 2;
    $cart_qty = 1;

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
            echo "<script>console.log('{$result}');</script>";
            $stmt->close();

            $stmt1 = $conn->prepare("SELECT Cart_Qty from Group2.Cart where User_id = ? and Product_id = ?");
            $stmt1->bind_param("ii", $user_id, $product_id);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            if ($result1->num_rows > 0) {
                $row = $result->fetch_assoc();
                $qty = $row["Cart_Qty"];
            }
            $qty = $qty + 1;
            $stmt1->close();
            $stmt2 = $conn->prepare("UPDATE Group2.Cart SET Cart_qty = ? where Product_id = ? and Cart_id = ? and User_id = ?;");
            $stmt2->bind_param("iii", $qty, $product_id, $user_id);
            $stmt2->execute();
            $stmt2->close();
        } else {
            $stmt->close();
            $stmt1 = $conn->prepare("INSERT INTO Group2.Cart(Product_id,User_id, Cart_Qty) VALUES (?,?,?)");
            $stmt1->bind_param("iii", $product_id, $user_id, $cart_qty);
            if (!$stmt1->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $success = false;
            }
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
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <strong><i class="fa fa-database"></i> Products</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            show();
                            if ($result->num_rows > 0) :
                                foreach ($result as $product) :
                                    ?>
                                    <tr>
                                        <td><?= $product['Product_name'] ?></td>
                                        <td><?= $product['Product_price'] ?></td>
                                        <td>
                                            <form action="" method="POST">
                                                <input type="hidden" name="product_id" value="<?= $product['Product_id'] ?>"> 
                                                <button class="btn btn-primary" type="submit" name="addCart">Add to Cart</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        </main>
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
