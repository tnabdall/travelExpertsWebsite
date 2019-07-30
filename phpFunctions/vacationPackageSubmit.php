<!-- Authors: Nicolas Tambellini
Date: July 31,2019
Version: 2.5
Functionality: Adds new vacation package -->
<?php

if(isset($_POST['submit']) && isset($_FILES['Image'])){

    $dbUser = 'dbAdmin';
    $dbPass = 'L0g1n2db!';

    // Ensure that the user can only submit if they have logged in to access this page
    if(!isset($_SESSION['login_user'])){
        echo "<p>You do not have access. Please go to the login page.</p>";
        exit(); // Gets rid of submit and reset buttons.
    }

    include("functions.php");

    // Grabs form data and removes submit value
    $packageData = $_POST;
    unset($packageData["submit"]);

    // Put image file path in vacation data and move from temp folder to cards folder
    $name = basename($_FILES["Image"]["name"]);
    $packageData['Image'] = "images/Package_Pics/$name";
    move_uploaded_file($_FILES['Image']['tmp_name'],$packageData['Image']);

    // Sets airfair inclusion to 0 if checkbox isnt set
    if($packageData['AirfairInclusion']!='1'){
        $packageData['AirfairInclusion']=0;
    }
    
    // Insert into table
    $success = insertData($packageData,'packages', 'travelexperts',$dbUser,$dbPass);
    if($success){
        echo "<p>Successfully inserted new package into the database.</p>";
    }
    else{
        echo "<p>Failed to insert new package into the database.</p>";
    }
    // Try to write to log
    try{    
        $logFile = fopen("logs/packageLog.txt","a");
        if(!$logFile){
            throw new Exception("Can't write to package register log: ");
        }
        if($success){
            fwrite($logFile,"Successfully inserted new package into the database.\n");
        }
        else{
            fwrite($logFile,"Failed to insert new package into the database.\n");
        }
        fclose($logFile);
    }
    catch(Exception $e){
        // Try to write to super log if write to agent register log fails
        $log = fopen("logs/superErrorLog.txt","a");
        fwrite($log,$e->getMessage());
        fwrite($log,"Package Register Log: ");
        if($success){
            fwrite($log,"Successfully inserted new package into the database.\n");
        }
        else{
            fwrite($log,"Failed to insert new package into the database.\n");
        }
        fclose($log);
    }
    
}
?>