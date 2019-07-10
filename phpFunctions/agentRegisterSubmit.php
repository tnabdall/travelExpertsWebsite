<?php

if(isset($_POST['submit'])){

    // Ensure that the user can only submit if they have logged in to access this page
    
    if(!isset($_SESSION['login_user'])){
        echo "<p>You do not have access. Please go to the login page.</p>";
        exit(); // Gets rid of submit and reset buttons.
    }

    include("functions.php");
    $agentData = $_POST;
    unset($agentData["submit"]);


    // Allows us to pass null value for middle initial if left blank
    if($agentData['AgtMiddleInitial']==''){
        unset($agentData['AgtMiddleInitial']);
    }

    $agentData['Password'] = password_hash($agentData['Password'],PASSWORD_DEFAULT);
    
  
    $success = insertData($agentData,'agents', 'travelexperts','root','');
    if($success){
        echo "<p>Successfully inserted new agent into the database.</p>";
    }
    else{
        echo "<p>Failed to insert new agent into the database.</p>";
    }
    // Try to write to log
    try{   
        $logFile = fopen("logs/agentRegisterLog.txt","a");
        if(!$logFile){
            throw new Exception("Can't write to agent register log: ");
        }
        if($success){
            fwrite($logFile,"Successfully inserted new agent into the database.\n");
        }
        else{
            fwrite($logFile,"Failed to insert new agent into the database.\n");
        }
        fclose($logFile);
    }
    catch(Exception $e){
        // Try to write to super log if write to agent register log fails
        $log = fopen("logs/superErrorLog.txt","a");
        fwrite($log,$e->getMessage());
        fwrite("Agent Register Log: ");
        if($success){
            fwrite($log,"Successfully inserted new agent into the database.\n");
        }
        else{
            fwrite($log,"Failed to insert new agent into the database.\n");
        }
        fclose($log);
    }
    
}
?>