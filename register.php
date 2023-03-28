<?php
// Start the session
include "session.php";
?>

<html>
    <?php
    include "head.inc.php";
    ?>
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
                    <label for="User_fname">First Name:</label>
                    <input class="form-control" type="text" id="User_fname"
                           name="User_fname" placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="User_lname">Last Name:</label>
                    <input class="form-control" type="text" id="User_lname"
                           required name="User_lname" maxlength="45" placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="User_email">Email:</label>
                    <input class="form-control" type="email" id="User_email"
                           required name="User_email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="User_address">Address:</label>
                    <input class="form-control" type="text" id="User_address"
                           required name="User_address" placeholder="Enter address">
                </div>
                <div class="form-group">
                    <label for="User_postcode">Postcode:</label>
                    <input class="form-control" type="tel" pattern="[0-9]{6}"  id="User_postcode"
                           required name="User_postcode" placeholder="Enter Postal code">
                </div>
                <div class="form-group">
                    <label for="User_phone">Phone:</label>
                    <input class="form-control" type="tel" pattern="[0-9]{8}" id="User_phone"
                           required name="User_phone" placeholder="Enter Phone number">
                </div>
                <div class="form-group">
                    <label for="User_password">Password:</label>
                    <input class="form-control" type="password" id="User_password"
                           required name="User_password" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="User_password_cfm">Confirm Password:</label>
                    <input class="form-control" type="password" id="User_password_cfm"
                           required name="User_password_cfm" placeholder="Confirm password">
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