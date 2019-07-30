<!-- Authors: Owiny Ayroech
Date: July 31,2019
Version: 2.5
Functionality: Processes login for login.php -->
<?php
include("functions.php");
if(isset($_POST['submitButton'])){
    // Grab data from form and unset value of submit button
    $loginData = $_POST;
    unset($loginData["submitButton"]);
    // Verifies username and password in db
    if($loginData['username']!='' && $loginData['password']!='' && verifyUserCredentials($loginData['username'],$loginData['password'])){
        header("Location: ./agentRegister.php"); // Redirects agent to header. Agent page will redirect customer to index if customer logged in.
    }
    else{
        // sets a failed login session message
        $_SESSION['failedLogin']='failed';
    }
}

?>