<?php
include 'session.php';
if (isset($_SESSION['User_id'])) {
    header("location: index.php");
}
?>
<html lang="en">
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
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container">
            <h1>Member Log In</h1>
            <p>
                Existing members log in here. For new members, please go to the
                <a href="register.php">Sign Up page</a>.
            </p>
            <form action="process_login.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input class="form-control" type="email" id="User_email"
                           required name="User_email" placeholder="Enter email"><br>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label><br>
                    <input class="form-control" type="password" id="User_password"
                           required name="User_password" 
                           placeholder="Enter password"><br>
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
