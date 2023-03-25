<?php include 'session.php'; ?>
<?php
if (isset($_POST['edit'])) {
    $user_id = $_SESSION['User_id'];
    $product_id = $_POST['product_id'];
    $cart_id = $_POST['cart_id'];
    $cart_qty = $_POST['cart_qty'];

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
        $stmt = $conn->prepare("UPDATE Group2.Cart SET Cart_qty = ? where Product_id = ? and Cart_id = ? and User_id = ?");
        $stmt->bind_param("iiii", $cart_qty, $product_id, $cart_id, $user_id);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
if (isset($_POST['delete'])) {
    $user_id = $_SESSION['User_id'];
    $product_id = $_POST['product_id'];
    $cart_id = $_POST['cart_id'];

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
        $stmt = $conn->prepare("DELETE from Group2.Cart where Product_id = ? and Cart_id = ? and User_id = ?");
        $stmt->bind_param("iii", $product_id, $cart_id, $user_id);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
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
            <br><!-- comment -->
            <br><!-- comment -->
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <strong><i class="fa fa-database"></i> Cart</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Individual Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            show();
                            if ($result->num_rows > 0) :
                                foreach ($result as $cart) :
                                    ?>
                                    <tr>
                                <form action="" method="POST">
                                    <td><?= $cart['Product_name'] ?></td>
                                    <td>$ <?= $cart['Product_price'] ?></td>
                                    <td><input type='number' name='cart_qty' value ='<?= $cart['Cart_Qty'] ?>' width='50' ></td>
                                    <td>$ <?= $cart['Product_price'] * $cart['Cart_Qty'] ?></td>
                                    <td>
                                        <input type="hidden" name="cart_id" value="<?= $cart['Cart_id'] ?>"> 
                                        <input type="hidden" name="product_id" value="<?= $cart['Product_id'] ?>">      
                                        <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                                        <button class="btn btn-danger" type="submit" name="delete">Remove</button>
                                    </td>
                                </form>
                                </tr>
                                <?php $total = $total + $cart['Product_price'] * $cart['Cart_Qty'] ?>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><p><b>Total Price</b></p></td>
                                <td><p><b>Checkout</b></p></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>$ <?= $total ?></td>
                                <td>
                                    <form action ='checkout.php' method='POST'>
                                        <button class="btn btn-success" type="submit" name="checkout">Checkout</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        endif;
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>

<?php

function show() {
    global $errorMsg, $success, $result;
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
        $stmt = $conn->prepare("SELECT A.Product_id, A.Cart_id, A.Cart_Qty, B.Product_name, B.Product_price FROM Group2.Cart as A "
                . "inner join Group2.Product as B ON A.Product_id = B.Product_id AND A.User_id = ?");
        $stmt->bind_param("i", $user_id);
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}