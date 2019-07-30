<!--
Authors: Owiny Ayorech
Date: July 31,2019
Version: 2.5
Functionality: Connect to database
-->

<?php

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