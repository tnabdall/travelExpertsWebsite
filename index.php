<?php 
include("pageSections/header.php");
include("pageSections/welcomeBanner.php");
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=='registeredCustomer'){
        header("Location: indexRegistered.php");
    }
}
if(isset($_POST['submit'])){
    $pkgInfo=explode("&",$_POST['submit']);
    $_SESSION["pkgName"]=$pkgInfo[0];
    $_SESSION["pkgId"]=$pkgInfo[1];
    echo "<script type='text/javascript'>alert('".$_SESSION["pkgId"]."');</script>";
    header("Location: bookingGuestForm.php");
    exit();
}
?>
<script src="js/index.js"></script>
<main>

    <!-- Holds the images on home page and changes format depending on screen size -->
    <section class="mainContent" id="travelImageSection">
        <form method="POST">
            <div class="ui cards" id="cardCarousel">


                <?php
                require "phpFunctions/functions.php";
            try{           
                $packages = getVacationPackages();

                foreach ($packages as $package)
                { 
                    // $bookingTripName.$counter = $package['PkgName'];
                    // $bookingTripId.$counter = $package['PkgName'];
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

                    echo $packageDisplay;
                }
            }
            catch(Exception $e){
                echo "Unable to load vacation packages page at the moment.";
            }
            ?>

            </div>


            <!--Section for travel images-->
        </form>
    </section>

</main>
<?php include("pageSections/footer.php")?>