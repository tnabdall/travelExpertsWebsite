<!-- Authors: Owiny Ayroech
Date: July 31,2019
Version: 2.5
Functionality: Destroys all session variables related to logged in customer/agent -->
<?php
session_start();
unset($_SESSION['login_user']);
unset($_SESSION['login_username']);
unset($_SESSION['user_type']);
header("Location: ../index.php");
?>