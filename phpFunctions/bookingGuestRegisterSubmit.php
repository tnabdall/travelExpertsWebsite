<!-- Authors: Nicolas Tambellini
Date: July 31,2019
Version: 2.5
Functionality: Adds new customer and booking to DB -->
<?php
if(isset($_POST['submit'])){
    include("phpFunctions/functions.php");

    // Grabs trip type
    $tripType=$_POST['TripTypeId'];
    unset($_POST["TripTypeId"]);

    // Pulls customer data into array and delete submit value
    $customerData = $_POST;
    unset($customerData["submit"]);

    // Encrypt password
    $customerData['Password'] = password_hash($customerData['Password'],PASSWORD_DEFAULT);

    if($customerData['CustBusPhone']==''){
        unset($customerData['CustBusPhone']);
    }

    // Inserts customer data
    $success = insertData($customerData,'customers', 'travelexperts','dbAdmin','L0g1n2db!');

    // If unsuccessful, exit program. We do not want to try booking package.
    if ($success == false) {
        echo "<p>Customer was not successfully submitted into db.</p>";
    }
     else{ // Customer was successfully inserted
        // Creates booking array
        $bookingData=array();
        $bookingData['TripTypeId'] = $tripType;
        $bookingData['PackageId']=$_SESSION['pkgId'];
        
        $mysqli = mysqli_connect('localhost', 'dbAdmin' ,'L0g1n2db!' , 'travelexperts');

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return false;
        }

        // Grabs customer id using newly inserted customer's username
        $query = 'SELECT `CustomerId` FROM `customers` WHERE Username = "'.$_POST['Username'].'";';
        $executeQuery=$mysqli -> query($query);
        $results = mysqli_fetch_array($executeQuery,MYSQLI_ASSOC);
        
        // Insert new booking
        $query = 'INSERT INTO `bookings`(`BookingDate`, `CustomerId`, `TripTypeId`, `PackageId`) VALUES (CURRENT_DATE(),'.$results['CustomerId'].',"'.$bookingData['TripTypeId'].'",'.$bookingData['PackageId'].');';
        $executeQuery=$mysqli -> query($query);

        if($executeQuery ){
            echo "<p>Successfully registered as a customer and booked your package! Enjoy your trip!</p>";
        }
        else{
            echo "<p>Failed to register. Please contact us.</p>";
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
        
        // If everything ran correctly, send a confirmation email
        if($executeQuery){
            $email = $customerData['CustEmail'];
            
            $msg = 'Hi '.$customerData['CustFirstName'].' '.$customerData['CustLastName'].
            ',
            
    Thanks for Booking with the Travel Experts!

    You have now been registered as a customer and your booking is confirmed. 

    Package: '.$_SESSION['pkgName'].'
            
    An account has been created for your next visit to our site.

    Your Username is: '.$customerData['Username'].'
    
    We appreciate your business, Thank you for using Travel Experts.';

            $subject = 'Travel Booking and Registration';
            mailer ($email,$msg,$subject,'newCustomerBooking');
            unset($tripType);
        }
    }
}
?>