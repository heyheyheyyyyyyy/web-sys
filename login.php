<?php include 'session.php'; ?>
<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
        <link rel="stylesheet" href="css/Signup.css">
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container">
            <h1>Member Log In</h1>
            <p>
                Existing members log in here. For new members, please go to the
                <a href="register">Sign Up page</a>.
            </p>
            <form action="process_login.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" type="email" id="User_email"
                           required name="User_email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input class="form-control" type="password" id="User_password"
                           required name="User_password" 
                           placeholder="Enter password">
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
