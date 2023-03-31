<?php
include 'session.php';
if ($_SESSION['User_role'] != 2) {
    header("location: index.php");
}

if (isset($_POST['edit'])) {

    global $errorMsg, $success;

    $user_id = $_POST['id'];
    $role_id = 2;
    //echo "<script>console.log('$user_id');</script>";
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

        //echo "<script>console.log('$user_id');</script>";
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
<html lang="en">
    <?php
    include "head.inc.php";
    include "nav.inc.php";
    ?>
    <body id="admin-page">
        <main class="container">
            <!-- Bootstrap row -->
            <div class="row" id="body-row">
                <!-- Sidebar -->
                <!-- Main -->
                <main class="col p-4 d-block" style="overflow: auto;">
                    <!-- Admin -->
                    <div class="tab-pane fade show active" id="show-home" role="tabpanel" aria-label="pills-home-tab">
                        <h3>User Profiles</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                show();
                                if ($result->num_rows > 0) :
                                    foreach ($result as $user) :
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $user['User_id'] ?></th>
                                            <td><?= $user['User_fname'] ?> <?= $user['User_lname'] ?></td>
                                            <td><?= $user['User_email'] ?></td>
                                            <td><?= $user['Role_name'] ?></td>
                                            <td>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?= $user['User_id'] ?>"> 
                                                    <button class="btn btn-sm btn-outline-primary" type="submit" name="edit">Update Role to Admin</button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick='return checkdelete()' type="submit" name="delete">Remove</button>
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