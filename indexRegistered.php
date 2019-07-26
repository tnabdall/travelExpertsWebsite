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
        // $length = count($_POST);
        // echo "<script type='text/javascript'>alert('".$length."');</script>";
        // exit();
        $loggedInUser = $_SESSION['login_username']; //query db for users id
        $pkgId = $_POST["submit"];
        $tripType = $_COOKIE['var1'];
        // $tripType = 'L'; //currently default; set drop down to pass value

        include("phpFunctions/functions.php");

        $bookingData=array();
        $bookingData['TripTypeId'] = $tripType;
        $bookingData['PackageId']=$pkgId;
        
        $mysqli = mysqli_connect('localhost', 'dbAdmin' ,'L0g1n2db!' , 'travelexperts');

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return false;
        }

        $query = 'SELECT `CustomerId` FROM `customers` WHERE Username = "'.$loggedInUser.'";';

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
            echo "<script type='text/javascript'>alert('Successfully booked the package.');</script>";
            // echo "<p>Successfully booked the package.</p>";
        }
        else{
            echo "<script type='text/javascript'>alert('Failed to book the package.');</script>";
            // echo "<p>Failed to book the package.</p>";
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
                <div id = "submitCancel" class="ui black deny button modalCancel">
                    Cancel
                </div>
                <div class="confirmButton ui button">
                <form method="POST"><button id = "submit" type="submit" value="submit" name="submit">Confirm</button></form>
                </div>
            </div>
        </div>
        
        <form method="POST">
        <div class="ui cards" id="cardCarousel">

        
        <?php
            require "classes/dbConnect.php";
            // $conn = getDatabase();
            $db = new Database();
            $conn = $db -> getConn();

            $sql = 'SELECT `PackageId`, `PkgName`, `Image`, `Partner`, DATE_FORMAT(`PkgStartDate`, "%Y/%m/%d") AS PkgStartDate, DATE_FORMAT(`PkgEndDate`, "%Y/%m/%d") AS PkgEndDate, `PkgDesc`, DATEDIFF(PkgEndDate,PkgStartDate) AS "Duration", `PkgBasePrice` FROM `packages` WHERE 1;';



            $result = $conn->query($sql);

            if ($result === false) {
                var_dump($conn->errorInfo());
             } else {
                $packages = $result->fetchAll(PDO::FETCH_ASSOC);
             }

             foreach ($packages as $package)
             { 
                // $bookingTripName.$counter = $package['PkgName'];
                // $bookingTripId.$counter = $package['PkgName'];
                if( strtotime($package['PkgEndDate']) < strtotime('now'))   //package starts now or later and package ends now or later
                {
                    $packageDisplay=''; 
                }
                else if ( strtotime($package['PkgStartDate']) < strtotime('now') ) //dont apply CSS
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
                else //apply CSS
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
            ?>

        </div>


        <!--Section for travel images-->
        </form>
    </section>

</main>
<?php include("pageSections/footer.php")?>