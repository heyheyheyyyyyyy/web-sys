<?php
include 'session.php';
if ($_SESSION['User_role'] != 2) {
    header("location: index.php");
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
                    <strong><i class="fa fa-database"></i> Products</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title float-left">Table Products</h5>
                            <a href="staffaddproduct.php" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            show();
                            if ($result->num_rows > 0) :
                                foreach ($result as $user) :
                                    ?>
                                    <tr>
                                        <td><?= $user['User_id'] ?></td>
                                        <td><?= $user['User_fname'] ?> <?= $user['User_lname'] ?></td>
                                        <td><?= $user['User_email'] ?></td>
                                        <td><?= $user['Role_id'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
        $stmt = $conn->prepare("SELECT * FROM Group2.Users;");
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}
?>