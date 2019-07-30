<?php 
include("pageSections/header.php");
if(!isset($_SESSION['user_type'])){
    header("Location: index.php");
}
else{
    if($_SESSION['user_type']!='registeredCustomer'){
        header("Location: index.php");
    }
}
include("pageSections/welcomeBanner.php");

if(isset($_POST['submit'])){
    if(isset($_COOKIE['var1'])){
        $loggedInUser = $_SESSION['login_username']; //query db for users id
        $pkgId = $_POST["submit"];
        $tripType = $_COOKIE['var1'];
        // $tripType = 'L'; //currently default; set drop down to pass value
        unset($_POST["submit"]);
        unset($_COOKIE['var1']);

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

        // $query = "INSERT INTO $tableName ($columns) VALUES ($values);";
        $executeQuery=$mysqli -> query($query);
        $results = mysqli_fetch_array($executeQuery,MYSQLI_ASSOC);

        $query = 'INSERT INTO `bookings`(`BookingDate`, `CustomerId`, `TripTypeId`, `PackageId`) VALUES (CURRENT_DATE(),'.$results['CustomerId'].',"'.$bookingData['TripTypeId'].'",'.$bookingData['PackageId'].');';
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
        

        if($executeQuery){
            $email = $results['CustEmail'];
            $msg = 'Welcome Back '.$results['CustFirstName'].' '.$results['CustLastName'].',
                    
Thanks for Booking with the Travel Experts!
            
We appreciate your customer loyalty, find your booking confirmation details below.
            
Booking Info: 

Package: '.$_SESSION['pkgName'].'
Triptype: '.$tripType;
            
            // $msg = wordwrap($msg,80);
            $subject = 'Travel Booking';
            mailer ($email,$msg,$subject,'registeredBooking');
            // echo "<script type='text/javascript'>alert('Successfully booked the package.');</script>";
            unset($_SESSION['pkgName']);
            unset($_SESSION[$tripType]); 
            unset($tripType);
            // echo "<p>Successfully booked the package.</p>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Failed to book the package; no TripType was selected.');</script>";
    }
}
?>
<script src="js/indexRegistered.js"></script>
<main>
    
    <!-- Holds the images on home page and changes format depending on screen size -->
    <section class ="mainContent" id="travelImageSection">
        <!-- MODAL '.$counter.' CODE -->
        <div id="modalConfirm" class="ui modal">
            <div class="actions">
            <p id="modalMessage">Are you sure you want to book this package?</p>
            <div class="ui black deny button">Back</div>
            <div class="confirmButton ui">
                <form method="POST"><button id = "submit" class="ui button confirmButton" type="submit" value="submit" name="submit">Confirm</button></form>
            </div>
            </div>
        </div>
        
        <form method="POST">
        <div class="ui cards" id="cardCarousel">

        
        <?php
            require "phpFunctions/functions.php";
            $packages = getVacationPackages();

            try{
                foreach ($packages as $package)
                { 

                    if( strtotime($package['PkgEndDate']) < strtotime('now'))   // Don't show package since it ended
                    {
                        $packageDisplay=''; 
                    }
                    else if ( strtotime($package['PkgStartDate']) < strtotime('now') ) // Apply special bold css to already started package
                    {
                        $packageDateInfo = '
                        <div class="extra content">
                        <span class="packageWarning">
                        '.$package['PkgStartDate'].'</span> - <span>'.$package['PkgEndDate'].'
                        </span>
                        </div>

                        ';
                        $packageDisplay = '
                        <div class="item card">
                            <div class="image packageImageDiv">
                                <img class="packageImage" src="'.$package['Image'].'">

                            </div>
                            <br/>
                            
                            <div id="packageContent" class="content">
                                <div class="right floated meta orangeColour">$'.$package['PkgBasePrice'].' CAD</div>
                                <div class="header">'.$package['PkgName'].'</div> <br/>
                                <div class="meta">
                                    <div class="ui styled fluid accordion">
                                        <div class="title">
                                            <i class="dropdown icon"></i>
                                            Overview
                                        </div>
                                        
                                        <div class="content">
                                            <p class="transition">'.$package['PkgDesc'].'</p>
                                            <a href="'.$package['Partner'].'">Full Itinerary</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="packageContent" class="description">
                                <br/>
                                '.$package['Duration'].' days
                                </div>
                            </div>
                                '.$packageDateInfo.'
                                <div class="focus required field">
                                        <label id="tripTypeLabel" for="TripTypeId">Select</label>
                                        <select class="TripTypeIdRegistered" id="TripTypeId" name="TripTypeId">
                                            <option value="">Trip Type</option>
                                            <option value="B">Business</option>
                                            <option value="G">Group</option>
                                            <option value="L">Leisure</option>
                                        </select>
                                </div>
                                <button type="button" class="ui button right floated modalButton" value="'.$package['PackageId'].'&'.$package['PkgName'].'">Order</button>

                        </div>';
                    }
                    else // Apply regular css
                    {
                        $packageDateInfo = '
                        <div class="extra content">
                        <span>
                        '.$package['PkgStartDate'].' - '.$package['PkgEndDate'].'
                        </span>
                        </div>
                        ';
                        $packageDisplay = '
                        <div class="item card">
                            <div class="image packageImageDiv">
                                <img class="packageImage" src="'.$package['Image'].'">
                            </div>
                            <br/>
                            <div id="packageContent" class="content">
                                <div class="cost right floated meta">$'.$package['PkgBasePrice'].' CAD</div>
                                <div class="trip header">'.$package['PkgName'].'</div> <br/>
                                <div class="meta">
                                    <div class="ui styled fluid accordion">
                                        <div class="title">
                                            <i class="dropdown icon"></i>
                                            Overview
                                        </div>
                                        <div class="content ">
                                            <p class="dropdown transition">'.$package['PkgDesc'].'</p>
                                            <a class="itinerary" href="'.$package['Partner'].'" target="_blank">Full Itinerary</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="packageContent" class="description">
                                <br/>
                                '.$package['Duration'].' days
                                </div>
                                </div>
                                '.$packageDateInfo.'
                                <div class="focus required field">
                                    <label id="tripTypeLabel" for="TripTypeId">Select</label>
                                    <select class="TripTypeIdRegistered" id="TripTypeId" name="TripTypeId">
                                        <option value="">Trip Type</option>
                                        <option value="B">Business</option>
                                        <option value="G">Group</option>
                                        <option value="L">Leisure</option>
                                    </select>

                                </div>
                                <button type="button" class="ui button right floated modalButton" value="'.$package['PackageId'].'&'.$package['PkgName'].'">Order</button>

                        </div>';
                    }

                    echo $packageDisplay;
                }
            
            }
            catch(Exception $e){
                echo "Unable to load vacation packages at the moment";
            }
            ?>

        </div>


        <!--Section for travel images-->
        </form>
    </section>

</main>
<?php include("pageSections/footer.php")?>