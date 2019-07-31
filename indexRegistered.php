<!-- Authors: Owiny Ayorech
Date: July 31,2019
Version: 2.5
Functionality: Shows vacation packages. Order button books package for registered customer. -->
<?php 
include("pageSections/header.php");
// Redirects if you are not a registered customer. Done by Tarik.
if(!isset($_SESSION['user_type'])){
    header("Location: index.php");
}
else{
    if($_SESSION['user_type']!='registeredCustomer'){
        header("Location: index.php");
    }
}

// On page load, if cookie is set, delete it
if(isset($_COOKIE['tripTypeFull'])){
    setcookie('tripType', '', 1);
    setcookie('tripTypeFull', '', 1);
}
include("pageSections/menu.php");
include("pageSections/welcomeBanner.php");
include("phpFunctions/indexRegisteredSubmit.php");

?>
<script src="js/indexRegistered.js"></script>
<main>
    <!-- Holds the carousel on home page and changes format depending on screen size -->
    <section class="mainContent" id="travelImageSection">
        <!-- MODAL '.$counter.' CODE -->
        <div id="modalConfirm" class="ui modal">
            <div class="actions">
                <p id="modalMessage">Are you sure you want to book this package?</p>
                <div class="ui black deny button">Back</div>
                <div class="confirmButton ui">
                    <form method="POST"><button id="submit" class="ui button confirmButton" type="submit" value="submit"
                            name="submit">Confirm</button></form>
                </div>
            </div>
        </div>

        <form method="POST">
            <!-- Everything is within a form so that all submit buttons will run their js function (which allows php to pull the right session variables) -->
            <div class="ui cards" id="cardCarousel">


                <?php
                    include_once("phpFunctions/functions.php");

                    // Grab vacation packages
                    $packages = getVacationPackages();

                    try{
                        // For each package, display on page depending on start and end date of package
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
                                        <div class="cost right floated meta orangeColour">$'.$package['PkgBasePrice'].' CAD</div>
                                        <div class="trip header">'.$package['PkgName'].'</div> <br/>
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
                                                    <option class="selectedTripType" value="">Trip Type</option>
                                                    <option class="selectedTripType" value="B">Business</option>
                                                    <option class="selectedTripType" value="G">Group</option>
                                                    <option class="selectedTripType" value="L">Leisure</option>
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
                                                <option class="selectedTripType" value="">Trip Type</option>
                                                <option class="selectedTripType" value="B">Business</option>
                                                <option class="selectedTripType" value="G">Group</option>
                                                <option class="selectedTripType" value="L">Leisure</option>
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