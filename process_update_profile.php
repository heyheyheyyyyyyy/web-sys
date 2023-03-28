<?php
include "session.php";
if (!isset($_SESSION['User_id'])) {
    header("location: index.php");
    exit;
}
$get_userid = $_SESSION['User_id'];
?>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_msg = "";
    $success = true;
    
    // First name
    if (empty($_POST["update_fname"])) {
        $error_msg .= "First name is required.<br>";
        $success = false;
    } else {
        $update_fname = sanitize_input($_POST["update_fname"]);
         
    }

    // Last name
    if (empty($_POST["update_lname"])) {
        $error_msg .= "Last name is required.<br>";
        $success = false;
    } else {
        $update_lname = sanitize_input($_POST["update_lname"]);
    } 

    // Email
    if (empty($_POST["update_email"])) {
        $error_msg .= "Email is required.<br>";
        $success = false;
    } else {
        $update_email = sanitize_input($_POST["update_email"]);
        if (!filter_var($update_email, FILTER_VALIDATE_EMAIL)) {
            $error_msg .= "Invalid email format.<br>";
            $success = false;
        }
    }

    // Address
    if (empty($_POST["update_address"])) {
        $error_msg .= "Address is required.<br>";
        $success = false;
    } else {
        $update_address = sanitize_input($_POST["update_address"]);
        if (!preg_match('/^[a-zA-Z0-9\s,.#\'-]+$/', $update_address)) {
            $error_msg .= "Invalid address format.<br>";
            $success = false;
        }
    }

    // Postal code
    if (empty($_POST["update_postcode"])) {
        $error_msg .= "Postal code is required.<br>";
        $success = false;
    } else {
        $update_postcode = $_POST["update_postcode"];
        if (!preg_match('/^[0-9]{6}$/', $update_postcode)) {
            $error_msg .= "Postal code must be exactly 6 digits.<br>";
            $success = false;
        }
    }

    // Phone number
    if (empty($_POST["update_phoneno"])) {
        $error_msg .= "Phone number is required.<br>";
        $success = false;
    } else {
        $update_phoneno = $_POST["update_phoneno"];
        if (!preg_match('/^[0-9]{8}$/', $update_phoneno)) {
            $error_msg .= "Invalid phone number format. Phone number should be 8 digits.<br>";
            $success = false;
        }
    }
    //password
    if (empty($_POST["new_password"]) || empty($_POST["cfm_password"])) {
        $errorMsg .= "Password and confirmation are required.<br>";
        $success = false;
    } else {
        if ($_POST["new_password"] != $_POST["cfm_password"]) {
            $errorMsg = "Passwords do not match. <br>";
            $success = false;
        } else {
            $newpwd_hashed = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
        }
    }
}

$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'],
        $config['password'], $config['dbname']);
// Check connection

if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}
else    
        {
            //get all current fields
            $update_fname = $_POST["update_fname"];
            $update_lname = $_POST["update_lname"];
            
            $update_email = $_POST["update_email"];
            $update_address = $_POST["update_address"];
            

            $update_postcode = $_POST["update_postcode"];
            $update_phoneno = $_POST["update_phoneno"];
            //$update_password = $_POST["update_password"];
            
            
    }
            // once success, then update all
            if ($success) {
                 process_update($conn, $update_fname, $update_lname, $update_email,$update_address, $update_postcode, $update_phoneno, $newpwd_hashed, $get_userid);
                 // show that have changed profile
                include 'head.inc.php';
                include "nav.inc.php";
                
                echo" <h2> You have changed your profile!</h2>";
                echo "<a href='edit_profile.php' class='btn btn-danger'> Return to edit profile page</a>";
                include 'footer.inc.php';
            } else {
                 // show that have errors
                    include 'head.inc.php';
                                echo "<h2>Oops!</h2>";
                echo "<h4> The following errors were detected: </h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a href='edit_profile.php' class='btn btn-danger'> Return to edit profile page</a>";
                include 'footer.inc.php';
            }
        
        

?>

<?php

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/* This function creates a new entry in the product table
 *
 * Function takes in 9 arguments: 
 *      1. Database connection object
 *      2. First name (string)
 *      3. Last name (string)
 *      4. email (string)
 *      5. address (string)
 *      6. Postal Code (int)
 *      7. Phone number (int)
 *      8. Password hash (string) 
 *      9. User id (int)
 * 
 */
function process_update($conn, $update_fname, $update_lname, $update_email,
                    $update_address, $update_postcode, $update_phoneno, $newpwd_hashed,$get_userid)
{
    
    // Get the globl error_msg variable
    global $error_msg;
    // Prepare the statement
       $stmt = $conn->prepare("UPDATE Group2.Users SET "
            . "User_fname = (?), User_lname = (?), User_email = (?), User_address = (?), User_postcode = (?), User_phone = (?), User_password = (?)"
            . "WHERE User_id = (?)");
    // Bind & execute the query statement:
    $stmt->bind_param("ssssiisi", $update_fname, $update_lname, $update_email,
                    $update_address, $update_postcode, $update_phoneno, $newpwd_hashed, $get_userid);
    if (!$stmt->execute())
    {
        $error_msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $stmt->close();
        return false;
    }
    
    $stmt->close();
    
    // CLose the DB connection
    $conn->close();

}
?>