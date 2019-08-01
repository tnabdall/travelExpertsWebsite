<!-- Authors: Owiny Ayorech
Date: July 31,2019
Version: 2.5
Functionality: Orders package for logged in customer -->
<?php
if(isset($_POST['submit'])){
    if(isset($_COOKIE['tripTypeFull'])){
        $loggedInUser = $_SESSION['login_username']; //query db for users id
        $pkgId = $_POST["submit"];
        $tripType = $_COOKIE['tripType'];
        $tripTypeFull = $_COOKIE['tripTypeFull'];
        $selectedPackageId = $_COOKIE['selectedPackageId'];
         

        // $tripType = 'L'; //currently default; set drop down to pass value
        unset($_POST["submit"]);
        unset($_COOKIE['tripType']);
        unset($_COOKIE['tripTypeFull']);
        unset($_COOKIE['selectedPackageId']);

        include("phpFunctions/functions.php");

        $bookingData=array();
        $bookingData['TripTypeId'] = $tripType;
        $bookingData['PackageId']=$pkgId;
        
        $mysqli = mysqli_connect('localhost', 'dbAdmin' ,'L0g1n2db!' , 'travelexperts');

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return false;
        }

        $query = 'SELECT `CustomerId`, `CustFirstName`, `CustLastName`, `CustEmail` FROM `customers` WHERE Username = "'.$loggedInUser.'";';

        //compare submitted package id against the currently selected; used to prevent ordering wrong package
        if ($pkgId === $selectedPackageId)
        {
            // $query = "INSERT INTO $tableName ($columns) VALUES ($values);";
            try{
                $executeQuery=$mysqli -> query($query);
                $results = mysqli_fetch_array($executeQuery,MYSQLI_ASSOC);

                $query = 'INSERT INTO `bookings`(`BookingDate`, `CustomerId`, `TripTypeId`, `PackageId`) VALUES (CURRENT_DATE(),'.$results['CustomerId'].',"'.$bookingData['TripTypeId'].'",'.$bookingData['PackageId'].');';
                $executeQuery=$mysqli -> query($query);

                echo "<p class='homeMessage'>Successfully booked the package ".$_COOKIE['pkgName'].".</p>";
            }
            catch(Exception $e){
                echo "<p class='homeMessage'>Failed to book the package ".$_COOKIE['pkgName'].".</p>";
            }
            
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
            

            if($executeQuery){
                $email = $results['CustEmail'];
            $msg = 'Welcome Back '.$results['CustFirstName'].' '.$results['CustLastName'].',
                    
Thanks for Booking with the Travel Experts!
            
We appreciate your customer loyalty, find your booking confirmation details below.

Package: '.$_COOKIE['pkgName'];
                
                    // $msg = wordwrap($msg,80);
                    $subject = 'Travel Booking';
                    mailer ($email,$msg,$subject,'registeredBooking');
                    // echo "<script type='text/javascript'>alert('Successfully booked the package.');</script>";
                    unset($_COOKIE['pkgName']);
                    unset($_SESSION[$tripType]); 
                    unset($tripType);
                    // echo "<p>Successfully booked the package.</p>";
                }
        }
        else//if they tried to order a package that was not selected alert
        {
            echo "<script type='text/javascript'>alert('You are trying to book from a package that was not selected');</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Failed to book the package; no TripType was selected.');</script>";
    }


}
?>