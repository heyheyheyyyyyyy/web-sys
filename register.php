<!DOCTYPE html>
<?php
// Start the session
include "session.php";
if (isset($_SESSION['User_id'])) {
    header("location: index.php");
}
?>

<html lang="en">
    <head>
        <?php
        include "head.inc.php";
        ?>
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
            <h1>Member Registration</h1>
            <p>
                For existing members, please go to the
                <a href="login.php">Sign In page</a>.
            </p>
            <form action="process_register.php" method="post">
                <div class="form-group">
                    <label for="User_fname">First Name:</label><br>
                    <input class="form-control" type="text" id="User_fname"
                           name="User_fname" placeholder="Enter first name"><br>
                </div>
                <div class="form-group">
                    <label for="User_lname">Last Name:</label><br>
                    <input class="form-control" type="text" id="User_lname"
                           required name="User_lname" maxlength="45" placeholder="Enter last name"><br>
                </div>
                <div class="form-group">
                    <label for="User_email">Email:</label><br>
                    <input class="form-control" type="email" id="User_email"
                           required name="User_email" placeholder="Enter email"><br>
                </div>
                <div class="form-group">
                    <label for="User_address">Address:</label><br>
                    <input class="form-control" type="text" id="User_address"
                           required name="User_address" placeholder="Enter address"><br>
                </div>
                <div class="form-group">
                    <label for="User_postcode">Postcode:</label><br>
                    <input class="form-control" type="tel" pattern="[0-9]{6}"  id="User_postcode"
                           required name="User_postcode" placeholder="Enter Postal code"><br>
                </div>
                <div class="form-group">
                    <label for="User_phone">Phone:</label><br>
                    <input class="form-control" type="tel" pattern="[0-9]{8}" id="User_phone"
                           required name="User_phone" placeholder="Enter Phone number"><br>
                </div>
                <div class="form-group">
                    <label for="User_password">Password:</label><br>
                    <input class="form-control" type="password" id="User_password"
                           required name="User_password" minlength='8' placeholder="Enter password"><br>
                </div>
                <div class="form-group">
                    <label for="User_password_cfm">Confirm Password:</label><br>
                    <input class="form-control" type="password" id="User_password_cfm"
                           required name="User_password_cfm" minlength='8' placeholder="Confirm password"><br>
                </div>
                <div class="form-check">
                    <label>
                        <input type="checkbox" name="agree" required>
                        Agree to terms and conditions.
                    </label>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>