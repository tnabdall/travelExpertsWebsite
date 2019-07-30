<?php

// Authors: Tarik Abdalla
// Date: July 31,2019
// Version: 2.5
// Functionality: Logs in customer or agent to DB using PDO for better security
function verifyUserCredentials($user,$pass){
    $dsn = "mysql:host=localhost;dbname=travelexperts";
    $dbUser='dbAdmin';
    $dbPasswd='L0g1n2db!';
    $pdo = new PDO($dsn, $dbUser, $dbPasswd);
    $results = $pdo ->prepare("SELECT Password from agents where Username = ?;");
    $results->execute([$user]);
    $number_of_rows = $results->rowCount();
    if($number_of_rows==0){
        echo "here";
        $pdo = new PDO($dsn, $dbUser, $dbPasswd);
        $results = $pdo ->prepare("SELECT Password from customers where Username = ?;");
        $results->execute([$user]);
        $number_of_rows = $results->rowCount();
        if($number_of_rows==0){
            $pdo=null;
            return false;
        }
        else{
            $hashedPass = $results -> fetch();
            $pdo = null;

            // Grab first name to personalize user experience
            $pdo = new PDO($dsn, $dbUser, $dbPasswd);
            $results = $pdo ->prepare("SELECT CustFirstName from customers where Username = ?;");
            $results->execute([$user]);
            $firstName = $results ->fetch();
            // Stores first name as session variable
            $_SESSION['login_user'] = $firstName[0];
            $_SESSION['user_type']='registeredCustomer';
            $_SESSION['login_username'] = $user;

            $pdo=null;
            return password_verify($pass,$hashedPass[0]);
        }
    }
    else{
        
        $hashedPass = $results -> fetch();
        $pdo = null;

        // Grab first name to personalize user experience
        $pdo = new PDO($dsn, $dbUser, $dbPasswd);
        $results = $pdo ->prepare("SELECT AgtFirstName from agents where Username = ?;");
        $results->execute([$user]);
        $firstName = $results ->fetch();
        // Stores first name as session variable
        $_SESSION['login_user'] = $firstName[0];
        $_SESSION['user_type']='agent';
        $_SESSION['login_username'] = $user;

        $pdo=null;
        return password_verify($pass,$hashedPass[0]);
    }
}

// Authors: Nicolas Tambellini
// Date: July 31,2019
// Version: 2.5
// Functionality: Inserts an associative array of colummns and values into the specified table and database
function insertData($dataArray, $tableName, $dbname, $dbuser, $dbpass){
    // Attempt connecting to sql server. Stop execution if unable to connect.
    $mysqli = mysqli_connect('localhost', $dbuser , $dbpass, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        return false;
    }
    
    // Build columns and values strings for sql statement from array
    $columns='';
    $values='';
    $counter=0;
    foreach ($dataArray as $column=>$value){
        // Check if counter is equal to array length,
        // so that we can exclude the last comma for proper formatting
        if($counter==count($dataArray)-1){ // For last element
            $columns.="$column";
            if(is_numeric($value) && strlen($value)<10){
                $values.="$value";
            }
            else{
                $values.="'$value'";
            }
        }
        else{ // For any element but last
            $columns.="$column,";
            if(is_numeric($value) && strlen($value)<10){
                $values.="$value,";
            }
            else{
                $values.="'$value',";
            }
        }
        $counter+=1;
    }
    
    // Execute insert query
    $query = "INSERT INTO $tableName ($columns) VALUES ($values);";
    $executeQuery=$mysqli -> query($query);
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
    return $executeQuery;
}

// Authors: Owiny Ayorech
// Date: July 31,2019
// Version: 2.5
// Functionality: Sends an email to the user
function mailer ($emailAddress,$emailMessage,$emailSubject,$type) {
    if ($type === 'newCustomer')
    {
        $notificationSuccess = "<p>Congratulations, you have been successfully added as a customer.</p><br><p>A confirmation email will be sent to you.</p>";
        $notificationFailure =  "<p>A confirmation email was not able to be sent to you. Please contact us.</p>";
    }
    else if ($type === 'newCustomerBooking')
    {
        $notificationSuccess = "<p>Congratulations, you have been successfully added as a customer.</p><br><p>A booking has been made,a confirmation email will be sent to you.</p>";
        $notificationFailure =  "<p>A confirmation email was not able to be sent to you. Please contact us.</p>";
    }
    else if ($type === 'registeredBooking')
    {
        $notificationSuccess = "<script type='text/javascript'>alert('Successfully booked the package.');</script>";
        $notificationFailure =  "<script type='text/javascript'>alert('Failed to send confirmation email. Please contact us.');</script>";
    }
    else if ($type === 'agentContact')
    {
        $notificationSuccess = "<p>Your message has been sent to the agent</p><br><p>You will receive a confirmation email</p>";
        $notificationFailure =  "<p>Your message was not sent to the agent. Please call the agency.</p>";
    }
    
    try{
        $email=$emailAddress;

        // Sanitize E-mail Address
        $email =filter_var($email, FILTER_SANITIZE_EMAIL);
        // Validate E-mail Address
        $email= filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email)
        {
            echo "Invalid Sender's Email - No Message will be sent";
        }
        else
        {
            $email2 = "cprg210.travelexperts@gmail.com";
            $headers = 'From:'. $email2 . "rn"; // Sender's Email
            $headers .= 'Cc:'. $email2 . "rn"; // Carbon copy to Sender
        
            // Send Mail By PHP Mail Function
            $to = $email;
            $subject = $emailSubject;
            $message = $emailMessage;
            
            $success = @mail($to, $subject, $message, $headers);
            
            if ($success)
            {
                echo $notificationSuccess;
            } 
            else 
            {
                echo $notificationFailure;
            }
        }
    }
    catch(Exception $e){
        // Do nothing
    }

    try{   
        $logFile = fopen("logs/EmailLog.txt","a");
        if(!$logFile){
            throw new Exception("Can't write to email log: ");
        }
        if($success){
            fwrite($logFile,"Successfully sent email.\n");
        }
        else{
            fwrite($logFile,"Failed to send email.\n");
        }
        fclose($logFile);
    }
    catch(Exception $e){
        // Try to write to super log if write to agent register log fails
        $log = fopen("logs/superErrorLog.txt","a");
        fwrite($log,$e->getMessage());
        fwrite($log,"Email Log: ");
        if($success){
            fwrite($log,"Successfully sent email.\n");
        }
        else{
            fwrite($log,"Failed to send email.\n");
        }
        fclose($log);
    }
}

// Authors: Owiny Ayorech
// Date: July 31,2019
// Version: 2.5
// Functionality: Grabs all data from a specified table in db
function grabAllData($tableName,$dbname,$dbuser,$dbpass){
    // Attempt connecting to sql server. Stop execution if unable to connect.
    $mysqli = mysqli_connect('localhost', $dbuser , $dbpass, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        return false;
    }
    // Executes query
    $query = "SELECT * FROM $tableName;";
    $executeQuery=$mysqli -> query($query);
    try{   
        $logFile = fopen("logs/query_Log.txt","a");
        if($executeQuery){
            fwrite($logFile,"Successfully executed the query $query.\n");
        }
        else{
            fwrite($logFile,"Failed to execute the query $query.\n");
        }
        fclose($logFile);
        $result = array();
        while($row=mysqli_fetch_array($executeQuery,MYSQLI_ASSOC)){
            array_push($result,$row);
        }
    
        mysqli_close($mysqli);
        return $result;
    }
    catch(Exception $e){
        return false;
    }
    
}

// Authors: Tarik Abdalla
// Date: July 31,2019
// Version: 2.5
// Functionality: Grabs all vacation packages and format/calculate a few columns from table data
function getVacationPackages(){
    require "classes/dbConnect.php";
    try{
        $db = new Database();
        $conn = $db -> getConn();

        // Selects all needed info for package and calculates duration from difference between start and end dates
        $sql = 'SELECT `PackageId`, `PkgName`, `Image`, `Partner`, DATE_FORMAT(`PkgStartDate`, "%Y/%m/%d") AS PkgStartDate, DATE_FORMAT(`PkgEndDate`, "%Y/%m/%d") AS PkgEndDate, `PkgDesc`, DATEDIFF(PkgEndDate,PkgStartDate) AS "Duration", `PkgBasePrice` FROM `packages` WHERE 1;';
        $result = $conn->query($sql);

        if ($result === false) {
            // Show error info if fails
            var_dump($conn->errorInfo());
        } 
        else {
            // Grab all packagaes into an associative array
            $packages = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $packages;
    }
    catch(Exception $e){
        throw(new Exception("Could not retrieve vacation packages from db"));
    }
}

?>