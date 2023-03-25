<?php
// Start the session
include "session.php";
?>

<?php
 
$fname=$lname=$email=$pwd_hashed=$address=$postcode=$phoneno=$errorMsg="";
$success = true;


 if ($_SERVER["REQUEST_METHOD"] == "POST")
 { 
     
// first NAME 
    if (!empty ($_POST["User_fname"]))
    {
        $fname = sanitize_input($_POST["User_fname"]);
    }    
 // LAST NAME 
   if (empty ($_POST["User_lname"]))
    {
        $errorMsg = "Last name is required.<br>";
        $success = false;
    }  
    else
    {
    $lname = sanitize_input($_POST["User_lname"]);
   
    }
   
     if (empty ($_POST["User_email"]))
    {
        $errorMsg = "Email is required.<br>";
        $success = false;
    }  
    else
    {
     $email = sanitize_input($_POST["User_email"]);
     if(!filter_var($email, FILTER_VALIDATE_EMAIL))
     {
        $errorMsg = "Invalid email format. <br>";
        $success = false;
   
    }
    
    $address_pattern = '/^[a-zA-Z0-9\s,.\'-]+$/'; 
    if (empty($_POST["User_address"])) {
        $errorMsg = "Address is required.<br>";
        $success = false;
    } else {
        $address = sanitize_input($_POST["User_address"]);
        if (!preg_match($address_pattern, $address)) {
            $errorMsg = "Invalid address format. <br>";
            $success = false;
        }
    }

   if (empty($_POST["User_postcode"])) {
    $errorMsg = "Postal code is required.<br>";
    $success = false;
    } else {
        $postcode = sanitize_input($_POST["User_postcode"]);
        if (!preg_match("/^[0-9]{6}$/", $postcode)) {
            $errorMsg = "Postal code must be exactly 6 digits.<br>";
            $success = false;
        }
    }

    if (empty($_POST["User_phone"])) {
        $errorMsg = "Phone number is required.<br>";
        $success = false;
    } else {
        $phoneno = sanitize_input($_POST["User_phone"]);
        if (!preg_match('/^\d{8}$/', $phoneno)) {
            $errorMsg = "Invalid phone number format. Phone number should be 8 digits.<br>";
            $success = false;
        }
    }
    
    if (empty($_POST["Role_id"])) {
        $errorMsg = "Role is required.<br>";
        $success = false;
    } else {
        $roleid = sanitize_input($_POST["Role_id"]);
        $valid_roles = array("1", "2");
        if (!in_array($roleid, $valid_roles)) {
            $errorMsg = "Invalid role. <br>";
            $success = false;
        }
    }
    
        if (empty($_POST["User_password"]) || empty($_POST["User_password_cfm"]))
            {
                        $errorMsg .= "Password and confirmation are required.<br>";
                        $success = false;
            }
        else
            {
                if ($_POST["User_password"] != $_POST["User_password_cfm"])
                { 
                    $errorMsg= "Passwords do not match. <br>";
                    $success = false;
                }

            else 
            {
                $pwd_hashed=password_hash($_POST["User_password"], PASSWORD_DEFAULT);
            }
          }
 }}
           
           else 
           { 
               echo "<h2> This page is not meant to be run directly.</h2>";
               echo "<p> You can register at the link below: </p>";
               echo "<a href = 'register.php'> Go to Sign Up page...</a>";
               exit();
           }
 
        //Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data  = trim($data);
    $data  = stripslashes($data);
    $data  = htmlspecialchars($data );  
    return $data ;
}
/*
* Helper function to write the member data to the DB
*/
function saveMemberToDB()
{
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success, $address, $postcode, $phoneno, $roleid;
    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
    $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error)
    {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
    }
    else
    {
    // Prepare the statement:
    $stmt = $conn->prepare("INSERT INTO Group2.Users (User_fname, User_lname,
    User_email, User_password, User_address, User_postcode, User_phone, Role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    // Bind & execute the query statement:
    $stmt->bind_param("ssssssss", $fname, $lname, $email, $pwd_hashed, $address, $postcode, $phoneno, $roleid);
    if (!$stmt->execute())
    {
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
        <title>Registration successful</title>
        <?php
        include "header.php";
        ?>
    </head> 
    <body> 
        <?php 
        include "nav.inc.php";
        ?> 
        <main class ="container">
            <hr> 
            <?php 
        if ($success)
            {saveMemberToDB(); 
                echo" <h2> You registration is successful!</h2>";
                echo "<h4> Thank you for signing up," . $fname ." " . $lname. ".</h4>";
                echo "<a href = 'login.php' class = 'btn btn-success'>Log-in</a>";
             }
             else 
             {
              echo "<h2>Oops!</h2>";
              echo "<h4> The following errors were detected: </h4>";
              echo "<p>" . $errorMsg . "</p>";
              echo "<a href='register.php' class='btn btn-danger'> Return to Sign Up</a>";
              }
              ?>

              

  </main>
        


         <br>   
        <?php 
        include "footer.inc.php";
        ?>
     </body>
     </html>