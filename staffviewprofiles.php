<?php
include 'session.php';
if ($_SESSION['User_role'] != 2) {
    header("location: index.php");
}

if (isset($_POST['edit'])) {

    global $errorMsg, $success;

    $user_id = $_POST['id'];
    $role_id = 2;
    echo "<script>console.log('$user_id');</script>";
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
        $stmt = $conn->prepare("UPDATE Group2.Users SET Role_id = ? WHERE User_id = ?");
        $stmt->bind_param("ii", $role_id, $user_id);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }

        echo "<script>console.log('$user_id');</script>";
        $stmt->close();
    }
    $conn->close();
}

if (isset($_POST['delete'])) {

    global $errorMsg, $success;

    $user_id = $_POST['id'];

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
        $stmt = $conn->prepare("DELETE from Group2.Users where User_id = ?");
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
                                        <td><?= $user['Role_name'] ?></td>
                                        <td>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value="<?= $user['User_id'] ?>"> 
                                                <button class="btn btn-primary" type="submit" name="edit">Update Role to Admin</button>
                                                <button class="btn btn-danger" type="submit" name="delete">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <td><?php $error_msg ?></td>
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
        $stmt = $conn->prepare("SELECT A.User_id, A.User_fname, A.User_lname, A.User_email, B.Role_name "
                . "FROM Group2.Users as A "
                . "inner join Group2.Roles as B "
                . "on A.Role_id = B.Role_id ; ");
// Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    $conn->close();
}
?>