<?php

if(isset($_POST['submit'])){

    include("functions.php");
    $customerData = $_POST;
    unset($customerData["submit"]);

    $customerData['Password'] = password_hash($customerData['Password'],PASSWORD_DEFAULT);

    if($customerData['CustBusPhone']==''){
        unset($customerData['CustBusPhone']);
    }
  
    $success = insertData($customerData,'customers', 'travelexperts','dbAdmin','L0g1n2db!');
    if($success){
        echo "<p>Successfully inserted new customer into the database.</p>";
    }
    else{
        echo "<p>Failed to insert new customer into the database.</p>";
    }
    // Try to write to log
    try{   
        $logFile = fopen("logs/customerRegisterLog.txt","a");
        if(!$logFile){
            throw new Exception("Can't write to customer register log: ");
        }
        if($success){
            fwrite($logFile,"Successfully inserted new customer into the database.\n");
        }
        else{
            fwrite($logFile,"Failed to insert new customer into the database.\n");
        }
        fclose($logFile);
    }
    catch(Exception $e){
        // Try to write to super log if write to agent register log fails
        $log = fopen("logs/superErrorLog.txt","a");
        fwrite($log,$e->getMessage());
        fwrite($log,"Customer Register Log: ");
        if($success){
            fwrite($log,"Successfully inserted new customer into the database.\n");
        }
        else{
            fwrite($log,"Failed to insert new customer into the database.\n");
        }
        fclose($log);
    }
    
}
?>