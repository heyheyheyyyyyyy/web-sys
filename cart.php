<?php include 'session.php'; ?>
<?php
if (isset($_POST['edit'])) {
    $user_id = $_SESSION['User_id'];
    $product_id = $_POST['product_id'];
    $cart_id = $_POST['cart_id'];
    if ($_POST['cart_qty'] != null) {
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
            if ($cart_qty <= 0) {
                echo "<script>alert('Please enter a valid number!');</script>";
            } else {
                $stmt = $conn->prepare("UPDATE Group2.Cart SET Cart_qty = ? where Product_id = ? and Cart_id = ? and User_id = ?");
                $stmt->bind_param("iiii", $cart_qty, $product_id, $cart_id, $user_id);
                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
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
<html lang="en">
    <head>
        <?php
        include "head.inc.php";
        include "nav.inc.php";
        ?>
    </head>
    <body id="admin-page">
        <main class="container">
            <!-- Bootstrap row -->
            <div class="row" id="body-row">
                <!-- Sidebar -->
                <!-- Main -->
                <main class="col p-4 d-block" style="overflow: auto;">
                    <!-- Cart -->
                    <div class="tab-pane fade show active" id="show-home" role="tabpanel" aria-label="pills-home-tab">
                        <h3>Cart</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Individual Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price of Selected Product(s)</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                show();
                                $total = 0;
                                if ($result->num_rows > 0) :
                                    foreach ($result as $cart) :
                                        ?>
                                        <tr>
                                            
                                            
                                            <td><img src="<?= $cart['Product_image'] ?>" alt="<?= $cart['Product_name'] ?>" style="width: 100px;"><br><br><?= $cart['Product_name'] ?></td>
                                            <td>$ <?= $cart['Product_price'] ?></td>
                                            <td><?= $cart['Cart_Qty'] ?></td>
                                            <td>$ <?= $cart['Product_price'] * $cart['Cart_Qty'] ?></td>
                                            <td>
                                                <form action="" method="POST">
                                                    <div class="input-group align-items-center">
                                                        <input type="number" name="cart_qty" class="form-control form-control-sm" placeholder="Change Quantity" aria-label="Change Quantity" min="0" max="10" style="width: 60px;">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary btn-sm" type="submit" name="edit">Edit</button>
                                                        </div>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="cart_id" value="<?= $cart['Cart_id'] ?>">
                                                            <input type="hidden" name="product_id" value="<?= $cart['Product_id'] ?>">
                                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to remove this item?')" type="submit" name="delete">Remove</button>
                                                        </form>
                                                    </div>


                                                </form>
                                            </td>
                                        </tr>
                                        <?php $total = $total + $cart['Product_price'] * $cart['Cart_Qty'] ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td><p><b>Total Cart Price:</b></p></td>
                                        <td><p><b>Checkout:</b></p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>$ <?= $total ?></td>
                                        <td>
                                            <form action ='payment.php' method='POST'>
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
        $stmt = $conn->prepare("SELECT A.Product_id, A.Cart_id, A.Cart_Qty, B.Product_name, B.Product_price, B.Product_image FROM Group2.Cart as A 
inner join Group2.Product as B ON A.Product_id = B.Product_id AND A.User_id = ?");
        $stmt->bind_param("i", $user_id);
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}
