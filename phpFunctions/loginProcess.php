<?php
include("functions.php");
if(isset($_POST['submitButton'])){
    // Grab data from form and unset value of submit button
    $loginData = $_POST;
    unset($loginData["submitButton"]);
    if($loginData['username']!='' && $loginData['password']!='' && verifyUserCredentials($loginData['username'],$loginData['password'])){
        header("Location: ./agentRegister.php");
    }
    else{
        $_SESSION['failedLogin']='failed';
    }
}

?>