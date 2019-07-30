<!-- Authors: Tarik Abdalla
Date: July 31,2019
Version: 2.5
Functionality: Shows vacation packages. Order button links to register page since this is an unregistered customer. -->
<?php 
include("pageSections/header.php");
// Redirects to registered index page if customer is registered
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=='registeredCustomer'){
        header("Location: indexRegistered.php");
    }
}
if(isset($_POST['submit'])){
    // Pulls package info from form
    $pkgInfo=explode("&",$_POST['submit']);
    // Sets pkg variables (name and id) in message
    $_SESSION["pkgName"]=$pkgInfo[0];
    $_SESSION["pkgId"]=$pkgInfo[1];
    // Takes you to booking/registration form
    header("Location: bookingGuestForm.php");
    exit();
}
include("pageSections/welcomeBanner.php");
?>
<script src="js/index.js"></script>
<main>

    <!-- Holds the carousel on home page and changes format depending on screen size -->
    <section class="mainContent" id="travelImageSection">
        <form method="POST">
            <!-- Everything is within a form so that all submit buttons will run their js function (which allows php to pull the right session varaibles) -->
            <div class="ui cards" id="cardCarousel">
                <?php
                require "phpFunctions/functions.php";
                try{           
                    // Grab vacation packages
                    $packages = getVacationPackages();

                    // For each package, display on page depending on start and end date of package
                    foreach ($packages as $package)
                    { 
                        if( strtotime($package['PkgEndDate']) < strtotime('now'))   // don't display package if end date has already passed
                        {
                            $packageDisplay=''; 
                        }
                        else if ( strtotime($package['PkgStartDate']) < strtotime('now') ) // Apply red bold CSS if package hasnt started
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

                                    <button type="submit" name="submit" class="ui button right floated" value="'.$package['PkgName'].'&'.$package['PackageId'].'">Order</button>

                            </div>';
                        }
                        else // Apply regular CSS for package that has not started
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

                                    <button type="submit" name="submit" class="ui button right floated" value="'.$package['PkgName'].'&'.$package['PackageId'].'">Order</button>

                            </div>';
                        }

                        echo $packageDisplay; // Print package to page
                    }
                }
                catch(Exception $e){
                    echo "Unable to load vacation packages page at the moment.";
                }
            ?>

            </div>
        </form>
    </section>

</main>
<?php include("pageSections/footer.php")?>