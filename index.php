<?php 
include("pageSections/header.php");
include("pageSections/welcomeBanner.php");
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
    <section class = "mainContent" id="travelImageSection">
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

                            <button type="submit" name="submit" class="ui olive basic button right floated" value="'.$package['PkgName'].'&'.$package['PackageId'].'">Order</button>

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

                            <button type="submit" name="submit" class="ui button right floated" value="'.$package['PkgName'].'&'.$package['PackageId'].'">Order</button>

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