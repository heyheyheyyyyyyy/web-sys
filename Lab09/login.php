<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

<html>
    <head>
        <title>Member Login</title>
        
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
            <h2>Member Login</h2>
            <p>
                For existing members log in here. For new members, please go to the
                <a href="register.php">Sign Up page</a>.
            </p>
            <form action="process_login.php" method="post">
                <div class="form-group">
                <label for="email">Email:</label>
                <input class = "form-control" type="email" id="email" required name="email"
                        placeholder="Enter email">
                </div>
                <div class="form-group">
                <label for="pwd">Password:</label>
                <input class = "form-control" type="password" id="pwd" required name="pwd"
                        placeholder="Enter password">
                </div>
                <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </main>

        <?php
        include "footer.inc";
        ?>
    </body>
</html>