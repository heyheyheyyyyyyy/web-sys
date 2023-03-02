<?php
    $fname = $lname = $email = $pwdHashed = $errorMsg = "";
    $success = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
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
        if (empty($_POST["pwd"])) 
        { 
            $errorMsg .= "Password is required.<br>";
            $success = false;
        }
        
        //If everything validated successfully, it will save the new user to the DB
        if ($success)
        {
            authenticateUser();
        }
    }

    else
    {
        echo "<h2>You have registered.</h2>";
        echo "<p>Please login using the following link:</p>";
        echo "<a href='login.php'>Go to Login page...</a>";
        exit();
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
    * Helper function to authenticate the login.
    */
    function authenticateUser()
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
            $stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE email=?");
            // Bind & execute the query statement:
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
        if ($result->num_rows > 0)
        {
            // Note that email field is unique, so should only have
            // one row in the result set.
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $pwdHashed = $row["password"];
            // Check if the password matches:
            if (!password_verify($_POST["pwd"], $pwdHashed))
            {
                // Don't be too specific with the error message - hackers don't
                // need to know which one they got right or wrong. :)
                $errorMsg = "Email not found or password doesn't match...";
                $success = false;
            }
        }
        else
        {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
        }
        $stmt->close();
        }
        $conn->close();
    }
?>
<html>
    <head>
        <title>Login Results</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
<!--Bootstrap CSS-->
<link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity=
        "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous">

<!-- Custom CSS -->
<link rel="stylesheet" href="css/main.css">

<!--jQuery-->
<script defer
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
</script>

<!--Bootstrap JS-->
<script defer
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
    integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
    crossorigin="anonymous">
</script>

<!-- Custom JS -->
<script defer src="js/main.js"></script>

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body>
        <?php
            include "nav.inc";
        ?>
        <main class="container">
            <hr>
            <?php
            if($success)
            {
                echo "<h2>Login sucessful!</h2>";
                echo "<h4>Welcome back, " . $fname . " " . $lname . ".</h4>";
                echo "<a href='index.php' class='btn btn-sucess' role='button'>Return to Home</a>";
            }
            else
            {
                echo "<h2>Oops!</h2>";
                echo "<h4>The following errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a href='login.php' class='btn btn-warning' role='button'>Return to Log-in</a>";
            }
            ?>
            <hr>
        </main>
        <br>
        <?php
        include "footer.inc";
        ?>
    </body>
</html>