<?php
session_start();

//So that if no user login. user will redirect to home page
if (!isset($_SESSION['User_id'])) {
    header("location: index.php");
}
else if (session_destroy()) {
    header("location: index.php");
}
?>

