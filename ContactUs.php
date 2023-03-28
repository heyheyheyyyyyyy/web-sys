<?php include 'session.php';?>
<html>
    <head>
        <?php
        include "head.inc.php";
        ?>
        <link rel="stylesheet" href="css/main.css">
        <style>
            .elem-group {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main>
        <div class="container">
            <h1>Contact Us</h1>
            <p>Fill in the form below to contact us.</p>

            <form action="contact.php" method="post">
                <div class="elem-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" pattern="[A-Za-z\s]{3,20}" required>
                </div>
                <div class="elem-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="john.doe@email.com" required>
                </div>

                <div class="elem-group">
                    <label for="department">Department:</label>
                    <select id="department" name="department" required>
                        <option value="">Select a Department</option>
                        <option value="billing">Billing</option>
                        <option value="marketing">Marketing</option>
                        <option value="technical-support">Technical Support</option>
                    </select>
                </div>

                <div class="elem-group">
                    <label for="short-problem">Short description on problem:</label>
                    <br>
                    <input type="text" id="short-problem" name="short-problem" required placeholder="Unable to Reset my Password" pattern="[A-Za-z0-9\s]{8,60}">
                </div>

                <div class="elem-group">
                    <label for="long_problem">Describe the problem in detail:</label>
                    <br>
                    <textarea id="long_problem" name="long_problem" required></textarea>
                </div>
                <button type="submit">Submit Form</button>
            </form>
        </div>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>

<!--//connect to database portion-->


//<?php
//// Connect to the database
//$servername = "localhost";
//$username = "your_username";
//$password = "your_password";
//$dbname = "your_database_name";
//
//$conn = mysqli_connect($servername, $username, $password, $dbname);
//if (!$conn) {
//  die("Connection failed: " . mysqli_connect_error());
//}
//
//// Get the form data
//$name = $_POST['name'];
//$email = $_POST['email'];
//$department = $_POST['department'];
//$short_problem = $_POST['short-problem'];
//$long_problem = $_POST['long_problem'];
//
//// Insert the form data into the database
//$sql = "INSERT INTO contacts (name, email, department, short_problem, long_problem)
//VALUES ('$name', '$email', '$department', '$short_problem', '$long_problem')";
//
//if (mysqli_query($conn, $sql)) {
//  echo "Form submitted successfully!";
//} else {
//  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//}
//
//// Close the database connection
//mysqli_close($conn);
//?>