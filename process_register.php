<?php
    $fname = $lname = $email = $pwdHashed = $errorMsg = "";
    $success = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        //$_POST will return first name from its input
        //First name
        //If there's input, it will be sanitized.
        //Starts with not empty because first name is not required.
        if (!empty($_POST["fname"])) 
        {
            $fname = sanitize_input($_POST["fname"]);
        }

        //Last name
        //If input is empty, errormsg will be shown. Else, sanitized the input.
        if (empty($_POST["lname"])) 
        {
            $errorMsg .= "Last name is required.<br>";
            $success = false;
        }
        else 
        {
            $lname = sanitize_input($_POST["lname"]);
        }

        //Email 
        if (empty($_POST["email"])) 
        {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        }
        else
        {
            $email = sanitize_input($_POST["email"]);

            // Additional check to make sure e-mail address is well-formed.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $errorMsg .= "Invalid email format.";
                $success = false;
            }
        }

        //Password
        if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"])) 
        { 
            $errorMsg .= "Password and password confirmation are required.<br>";
            $success = false;
        }
        else 
        {
            if ($_POST["pwd"] != $_POST["pwd_confirm"]) 
            {
                $errorMsg .= "Passwords Not Matched!.<br>";
                $success = false;
            }
            else 
            {
                //We can't sanitize the password as it could strip out characters that are meant to be part of the password.
                //Hence, we will hash the password before storing into database.
                $pwdHashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT); 
            }
        }
        //If everything validated successfully, it will save the new user to the DB
        if ($success)
        {
            saveMemberToDB();
        }
    }

    //Helper function that checks input for malicious or unwanted content.
    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    /*
    * Helper function to write the member data to the DB
    */
    function saveMemberToDB()
    {
        global $fname, $lname, $email, $pwdHashed, $errorMsg, $success;
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
            $stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
            // Bind & execute the query statement:
            $stmt->bind_param("ssss", $fname, $lname, $email, $pwdHashed);
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
        <title>Registration Results</title>
        <?php
            include "head.inc.php";
        ?>
    </head>
    <body>
        <?php
            include "nav.inc.php";
        ?>
        <main class="container">
            <hr>
            <?php
            if($success)
            {
                echo "<h2>Your registration is sucessful!</h2>";
                echo "<h4>Thank you for signing up, " . $fname . " " . $lname . ".</h4>";
                echo "<a href='login.php' class='btn btn-success' role='button'>Return to Log-in</a>";
            }
            else
            {
                echo "<h2>Oops!</h2>";
                echo "<h4>The following errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a href='register.php' class='btn btn-warning' role='button'>Return to Sign Up</a>";
            }
            ?>
            <hr>
        </main>
        <br>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>