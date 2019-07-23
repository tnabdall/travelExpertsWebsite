<?php

/**
* Database
*
* A connection to the database
*/
class Database
{
   /**
    * Get the database connection
    *
    * @return PDO object Connection to the database server
    */
   public function getConn()
   {
       $servername = "localhost";
       $dbname = "travelexperts";
       $username = "dbAdmin";
       $password = "L0g1n2db!";

       $dsn = 'mysql:host=' . $servername . ';dbname=' . $dbname . ';charset=utf8';

       return new PDO($dsn, $username, $password);
   }
}