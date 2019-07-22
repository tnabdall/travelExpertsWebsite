<?php
include("functions.php");
if(isset($_POST['submit'])){
    // Grab data from form and unset value of submit button
    $loginData = $_POST;
    unset($loginData["submit"]);
    if($loginData['username']!='' && $loginData['password']!='' && verifyUserCredentials($loginData['username'],$loginData['password'])){
        $_SESSION['login_user']=$loginData['username']; // Lets us know user is logged in
        header("Location: ./agentRegister.php");
    }
    else{
        echo "<p>Login failed. Check username and password.</p>";
    }
}

?>