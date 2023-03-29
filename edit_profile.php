<?php
// Start the session
include "session.php";
$get_userid = $_SESSION['User_id'];

if ($get_userid == null) {
    header("location: index.php");
}
?>
<?php
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'],
        $config['password'], $config['dbname']);
// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
// Prepare the statement:
    $stmt = $conn->prepare("SELECT * FROM Group2.Users WHERE User_id=?");
// Bind & execute the query statement:
    $stmt->bind_param("i", $get_userid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Note that user_id is unique, so should only have
        // one row in the result set.
        $row = $result->fetch_assoc();
        $fname = $row["User_fname"];
        $lname = $row["User_lname"];
        $email = $row["User_email"];
        $address = $row["User_address"];
        $postcode = $row["User_postcode"];
        $phoneno = $row["User_phone"];
        $currentpw = $row["User_password"];
    }
    $stmt->close();
    $conn->close();
} // closing brace for else statement
?>
<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
        <link rel="stylesheet" href="css/Signup.css">
        <style>
    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
    }


    </style>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container">
            <h1>Edit Profile</h1>
            <p>To update profile, please enter updated details.<br> 
                You only need to fill in the "New Password," and "Confirm Password" fields if you wish to update your password.</p>

            <form action="process_update_profile.php" method="post">
                <div class='form-group'>
                    <label for='fname'>First Name:</label><br>
                    <input class='form-control' type='text' id='update_fname' name='update_fname' value='<?php echo $fname; ?>'><br>
                </div>

                <div class='form-group'>
                    <label for='lname'>Last Name:</label><br>
                    <input class='form-control' type='text' id='update_lname' name='update_lname' maxlength="45" value='<?php echo $lname; ?>' required><br>
                </div>

                <div class='form-group'>
                    <label for='email'>Email:</label><br>
                    <input class='form-control' type='email' id='update_email' name='update_email' value='<?php echo $email; ?>' required><br>
                </div>

                <div class='form-group'>
                    <label for='address'>Address:</label><br>
                    <input class='form-control' type='text' id='update_address' name='update_address' value='<?php echo $address; ?>' required><br>
                </div>

                <div class='form-group'>
                    <label for='postcode'>Postal Code:</label><br>
                    <input class='form-control' type='text' id='update_postcode' name='update_postcode' value='<?php echo $postcode; ?>' required><br>
                </div>

                <div class='form-group'>
                    <label for='phoneno'>Phone Number:</label><br>
                    <input class='form-control' type='text' id='update_phoneno' name='update_phoneno' value='<?php echo $phoneno; ?>' required><br>
                </div>

                <div class='form-group'>
                    <label for='password'> New Password:</label><br>
                    <input class='form-control' type='password' id='update_password' minlength='8' name='new_password' ><br>
                </div>

                <div class='form-group'>
                    <label for='password'> Confirm new Password:</label><br>
                    <input class='form-control' type='password' id='cfm_password' minlength='8' name='cfm_password' ><br>
                </div>
                <button type='submit' class='btn btn-primary'>Save Changes</button>
            </form>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>