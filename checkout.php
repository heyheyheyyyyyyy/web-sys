<?php include 'session.php'; ?>
<?php
if (isset($_POST['purchase'])) {
    $user_id = 2;
    $total = $_POST['total'];

    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $stmt = $conn->prepare("SELECT A.Cart_Qty, B.Product_name FROM Group2.Cart as A "
                . "inner join Group2.Product as B where A.Product_id = B.Product_id AND A.User_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            foreach ($result as $cart) {
                //echo "<script>console.log('{$cart['Product_name']}');</script>";
                $total_product[] = array('Product' => $cart['Product_name'], 'Qty' => $cart['Cart_Qty']);
            }
        }
        $stmt->close();

        $json_data = json_encode($total_product);
        echo "<script>console.log('{$json_data}');</script>";
        echo "<script>console.log('{$total}');</script>";
        $stmt1 = $conn->prepare("INSERT INTO Group2.Purchase(Purchase_date, Purchase_totalprice, total_products, User_id) VALUES (CURRENT_TIMESTAMP,:total,:json_data,:user_id)");
        $stmt1->bindParam(":total", $total);
        $stmt1->bindParam(":json_data", $json_data);
        $stmt1->bindParam(":user_id", $user_id);

        if (!$stmt1->execute()) {
            $errorMsg = "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
            echo "<script>console.log('{$errorMsg}');</script>";
            $success = false;
        }
        $stmt1->close();

//        $stmt2 = $conn->prepare("UPDATE Group2.Cart SET Cart_qty = ? where Product_id = ? and Cart_id = ? and User_id = ?");
//        $stmt2->bind_param("iiii", $cart_qty, $product_id, $cart_id, $user_id);
//        if (!$stmt1->execute()) {
//            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//            $success = false;
//        }
//        $stmt2->close();
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
                                        <td><?= $cart['Product_name'] ?></td>
                                        <td>$ <?= $cart['Product_price'] ?></td>
                                        <td><?= $cart['Cart_Qty'] ?></td>
                                        <td>$ <?= $cart['Product_price'] * $cart['Cart_Qty'] ?></td>
                                        </form>
                                    </tr>
                                    <?php
                                    $total = $total + $cart['Product_price'] * $cart['Cart_Qty'];
                                    ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><p><b>Total Price</b></p></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>$ <?= $total ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <form action ='' method='POST'>
                                            <input type="hidden" name="total" value="<?= $total ?>">
                                            <button class="btn btn-success" type="submit" name="purchase">Purchase</button>
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
    $user_id = 2;
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
                . "inner join Group2.Product as B where A.Product_id = B.Product_id and A.User_id = ?");
        $stmt->bind_param('i', $user_id);
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}
