<?php

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

// Inserts an associative array of colummns and values into the specified table and database
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
        // so that we can exclude the last comma for poper formatting
        if($counter==count($dataArray)-1){
            $columns.="$column";
            if(is_numeric($value) && strlen($value)<10){
                $values.="$value";
            }
            else{
                $values.="'$value'";
            }
        }
        else{
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

// Returns all rows in table as numeric array. Each row is an associative array.
function grabAllData($tableName,$dbname,$dbuser,$dbpass){
    // Attempt connecting to sql server. Stop execution if unable to connect.
    $mysqli = mysqli_connect('localhost', $dbuser , $dbpass, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        return false;
    }
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

?>