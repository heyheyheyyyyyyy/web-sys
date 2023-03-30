<?php
include 'session.php';
if (!isset($_SESSION['User_id'])) {
    header("location: index.php");
}
?>
<html lang="en">
    <?php
    include "head.inc.php";
    include "nav.inc.php";
    ?>
    <body id="purchase-history">
        <main class="container">
            <!-- Bootstrap row -->
            <div class="row" id="body-row">
                <!-- Sidebar -->
                <!-- Main -->
                <main class="col p-4 d-block" style="overflow: auto;">
                    <!-- Admin -->
                    <div class="tab-pane fade show active" id="show-home" role="tabpanel" aria-label="pills-home-tab">
                        <h3>Purchase History</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Date Of Purchase</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                show();
                                if ($result->num_rows > 0) :
                                    foreach ($result as $purchase) :
                                        ?>
                                        <tr>
                                            <td><?= $purchase['Purchase_product'] ?></td>
                                            <td><?= $purchase['Purchase_qty'] ?></td>
                                            <td>$ <?= $purchase['Purchase_price'] ?></td>
                                            <td><?= date($purchase['Purchase_date']) ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </main>
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
        $stmt = $conn->prepare("SELECT * FROM Group2.Purchase where User_id = ?");
        $stmt->bind_param('i', $user_id);
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}?>
