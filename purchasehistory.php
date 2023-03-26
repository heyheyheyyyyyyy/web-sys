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
        ?>
        <main class="container">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <strong><i class="fa fa-database"></i>Purchase History</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Date Of Purchase</th>
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
                                        </form>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <form action ='index.php' method='POST'>
                                            <button class="btn btn-success" type="submit">Back Home</button>
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
        $stmt = $conn->prepare("SELECT * FROM Group2.Purchase where User_id = ?");
        $stmt->bind_param('i', $user_id);
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}
