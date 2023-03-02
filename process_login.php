<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        $email = $pwd_hashed = $errorMsg = "";
        $success = true;

        if (empty($_POST["email"])) { //checking if email is empty
            $errorMsg .= "Email is required.<br>";
            $success = false;
        } else {
            $email = $_POST["email"];
        }

        if (empty($_POST["pwd"])) { //checks if pwd is empty
            $errorMsg .= "Password is required.<br>";
            $success = false;
        } else {
            $pwd_hashed = $_POST["pwd"];
        }
        authenticateUser();

        echo "<main class='container'><div class='formsclass'>";
        if ($success) {
            echo "<h2>Login successful!</h2>";
            echo "<h4>Welcome back, " . $fname . " " . $lname . ".</h4>";
            echo
            "<form action='index.php'>
                <button class='btn btn-success' type='submit'>Return to Home</button>
            </form>";
            
            $_SESSION['email'] = $email;
        } else {
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
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
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
        $stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE
email=?");
// Bind & execute the query statement:
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
// Note that email field is unique, so should only have
// one row in the result set.
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $pwd_hashed = $row["password"];
// Check if the password matches:
            if (!password_verify($_POST["pwd"], $pwd_hashed)) {
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
