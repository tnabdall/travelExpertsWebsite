<!-- Authors: Nicolas Tambellini
Date: July 31,2019
Version: 2.5
Functionality: Adds new customer to DB -->
<?php

if(isset($_POST['submit'])){

    include("functions.php");

    // Grabs all data from form and deletes submit value
    $customerData = $_POST;
    unset($customerData["submit"]);

    // Encrypts password
    $customerData['Password'] = password_hash($customerData['Password'],PASSWORD_DEFAULT);

    // Removes business phone if empty
    if($customerData['CustBusPhone']==''){
        unset($customerData['CustBusPhone']);
    }
  
    // Inserts customer to DB
    $success = insertData($customerData,'customers', 'travelexperts','dbAdmin','L0g1n2db!');
    if($success){

        echo "<p>You are successfully registered with Travel Experts.</p>";

        $email = $customerData['CustEmail'];
        $msg = 'Hi '.$customerData['CustFirstName'].' '.$customerData['CustLastName'].',
        
Thanks for Registering with the Travel Experts!
        
You have now been registered as a new customer.
An account has been created for your next visit to our site,
        
Your Username is: '.$customerData['Username'];
           
        // $msg = wordwrap($msg,80);
        $subject = 'New Customer Registration';
        try{
            mailer ($email,$msg,$subject,'newCustomer');
        }
        catch(Exception $e){
            // Do nothing
        }
    }
    else{
        echo "<p>You were not able to be successfully registered. Try a different username or email.</p>";
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