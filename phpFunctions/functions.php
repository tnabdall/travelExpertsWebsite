<?php

// Ensures the entered password hashed matches that in the db for the specified user
function verifyUserCredentials($user,$pass){
    $dsn = "mysql:host=localhost;dbname=travelexperts";
    $dbUser='root';
    $dbPasswd='';
    $pdo = new PDO($dsn, $dbUser, $dbPasswd);
    $results = $pdo ->prepare("SELECT Password from agents where Username = ?;");
    $results->execute([$user]);
    if($results==false){
        $pdo = null;
        return false;
    }
    else{
        $hashedPass = $results -> fetch();
        $pdo = null;
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
            if(is_numeric($value)){
                $values.="$value";
            }
            else{
                $values.="'$value'";
            }
        }
        else{
            $columns.="$column,";
            if(is_numeric($value)){
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



?>