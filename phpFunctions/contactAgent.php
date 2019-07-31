<!-- Authors: Owiny Ayorech
Date: July 31,2019
Version: 2.5
Functionality: Populate contacts from DB into card format -->
<?php
if(isset($_POST['submit'])){
    if(isset($_COOKIE['varAgent']))
    {
        include_once("phpFunctions/functions.php");
        $agentsData = $_COOKIE['varAgent']; //agent id
        $email = $_COOKIE['emailAgent'];
    
        $mysqli = mysqli_connect('localhost', 'dbAdmin' ,'L0g1n2db!' , 'travelexperts');

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return false;
        }

        $query = "SELECT `AgtFirstName`, `AgtLastName`, `AgtMessage` FROM `agents` WHERE `AgentId` = ".$agentsData;
        $executeQuery=$mysqli -> query($query);
        
        $result = mysqli_fetch_array($executeQuery,MYSQLI_ASSOC);

        try{   
            $logFile = fopen("logs/query_Log.txt","a");
            if($executeQuery){
                fwrite($logFile,"Successfully executed the query $query.\n");
            }
            else{
                fwrite($logFile,"Failed to execute the query $query.\n");
            }
            fclose($logFile);
        }
        catch(Exception $e){
            
        }
        mysqli_close($mysqli);
        


        if($executeQuery)
        {
        $msg = 'Thanks For contacting '.$result['AgtFirstName'].' '.$result['AgtLastName'].',
                            
        '.$result['AgtMessage'];
                    
        $subject = 'Contact Agent';
        mailer ($email,$msg,$subject,'agentContact');
        unset($_COOKIE['varAgent']);
        unset($_COOKIE['emailAgent']);
        }
        // header("Location: ../contact.php");
    }
    else
    {
        // header("Location: ../contact.php");
    }
}

?>
