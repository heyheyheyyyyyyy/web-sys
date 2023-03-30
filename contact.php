<?php
include 'session.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: index.php");
}
?>
<html>
    <?php
    include "head.inc.php";
    include "nav.inc.php";
    ?>
    <body id="contact-page">
        <main class="container">
            <?php
            $visitor_name = "";
            $visitor_email = "";
            $email_title = "";
            $concerned_department = "";
            $visitor_message = "";
            $email_body = "<div>";

            if (isset($_POST['visitor_name'])) {
                $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
                $email_body .= "<div> 
                    <label><b>Visitor Name:</b></label>&nbsp;<span>" . $visitor_name . "</span> 
                    </div>";
            }
            if (isset($_POST['visitor_email'])) {
                $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
                $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
                $email_body .= "<div> 
                    <label><b>Visitor Email:</b></label>&nbsp;<span>" . $visitor_email . "</span> 
                    </div>";
            }

            if (isset($_POST['email_title'])) {
                $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
                $email_body .= "<div> 
                    <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>" . $email_title . "</span> 
                    </div>";
            }

            if (isset($_POST['concerned_department'])) {
                $concerned_department = filter_var($_POST['concerned_department'], FILTER_SANITIZE_STRING);
                $email_body .= "<div> 
                    <label><b>Concerned Department:</b></label>&nbsp;<span>" . $concerned_department . "</span> 
                    </div>";
            }

            if (isset($_POST['visitor_message'])) {
                $visitor_message = htmlspecialchars($_POST['visitor_message']);
                $email_body .= "<div> 
                    <label><b>Visitor Message:</b></label> 
                    <div>" . $visitor_message . "</div> 
                    </div>";
            }

            $email_body .= "</div>";

            echo "<h1 class='contact-header'>Thank you for contacting us</h1>";
            echo $email_body;
            echo "<a href='index.php' class='btn btn-primary'> Return Home</a>";
            ?>
        </main>
    </body>
    <br>
    <br>

    <?php
    include "footer.inc.php";
    ?>
</html>