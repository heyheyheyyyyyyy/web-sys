<?php
// Start the session
include "session.php";
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "<h2> This page is not meant to be run directly.</h2>";
    echo "<p> You can register at the link below: </p>";
    echo "<a href = 'register.php'> Go to Sign Up page...</a>";
    exit();
}
?>

<html>
    <?php
    include "head.inc.php";
    ?>
    <body>
        <?php
        include "nav.inc.php";

        $email = $pwd_hashed = $errorMsg = "";
        $success = true;

        if (empty($_POST["User_email"])) { //checking if email is empty
            $errorMsg .= "Email is required.<br>";
            $success = false;
        } else {
            $email = $_POST["User_email"];
        }

        if (empty($_POST["User_password"])) { //checks if pwd is empty
            $errorMsg .= "Password is required.<br>";
            $success = false;
        } else {
            $pwd_hashed = $_POST["User_password"];
        }
        authenticateUser();

        if ($success) {
            $_SESSION['User_id'] = $id;
            $_SESSION['User_role'] = $role;
            $_SESSION['lname'] = $lname;
            
            echo "<script>console.log('$lname')</script>";
            
            echo "<main class='container'><div class='formsclass'>";
            echo "<h1>Login Successful!!</h1>";
            echo
            "<form action='index.php'>
                <div class='form-group'>
                    <button class='btn btn-success' type='submit'>Home</button>
                </div>
            </form>";
        } else {
            echo "<main class='container'><div class='formsclass'>";
            echo "<h1>Oops!</h1>";
            echo "<h2>The following input errors were detected:</h2>";
            echo "<p>" . $errorMsg . "</p>";
            echo
            "<form action='login.php'>
                <div class='form-group'>
                    <button class='btn btn-danger' type='submit'>Return to Login</button>
                </div>
            </form>";
        }
        echo "</div></main>";
        include "footer.inc.php";
        ?>
    </body>
</html>

<?php
/*
 * Helper function to authenticate the login.
 */

function authenticateUser() {
    global $id, $fname, $lname, $email, $pwd_hashed, $address, $postcode, $phoneno, $role, $errorMsg, $success;
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
        $stmt = $conn->prepare("SELECT * FROM Group2.Users WHERE User_email=?");
// Bind & execute the query statement:
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
// Note that email field is unique, so should only have
// one row in the result set.
            $row = $result->fetch_assoc();
            $id = $row['User_id'];
            $fname = $row["User_fname"];
            $lname = $row["User_lname"];
            $pwd_hashed = $row["User_password"];
            $address = $row["User_address"];
            $postcode = $row["User_postcode"];
            $phoneno = $row["User_phone"];
            $role = $row["Role_id"];

// Check if the password matches:
            if (!password_verify($_POST["User_password"], $pwd_hashed)) {
// Don't be too specific with the error message - hackers don't
// need to know which one they got right or wrong. :)
                $errorMsg = "Email not found or password doesn't match...";
                $success = false;
            }
        } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
