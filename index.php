<?php 
include("pageSections/header.php");
include("pageSections/welcomeBanner.php");
?>
<script src="js/index.js"></script>
<main>
    
    <!-- Holds the images on home page and changes format depending on screen size -->
    <section class = "mainContent" id="travelImageSection">

        <div class="ui cards" id="cardCarousel">

        <?php
            require "classes/dbConnect.php";
            // $conn = getDatabase();
            $db = new Database();
            $conn = $db -> getConn();
            $sql = 'SELECT `PkgName`, `Image`, `Partner`, DATE_FORMAT(`PkgStartDate`, "%Y/%m/%d") AS PkgStartDate, DATE_FORMAT(`PkgEndDate`, "%Y/%m/%d") AS PkgEndDate, `PkgDesc`, `Duration`, `PkgBasePrice` FROM `packages` WHERE 1;';

            $result = $conn->query($sql);

            if ($result === false) {
                var_dump($conn->errorInfo());
             } else {
                $packages = $result->fetchAll(PDO::FETCH_ASSOC);
             }

             foreach ($packages as $package)
             { 
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
                        
                        <div id="packageContent" class="content">
                            <div class="right floated meta orangeColour">$'.$package['PkgBasePrice'].' CAD</div>
                            <div class="header">'.$package['PkgName'].'</div>
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
                            '.$package['Duration'].'
                            </div>
                        </div>
                            '.$packageDateInfo.'
                            <button class="ui button right floated">Info</button>
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
                        
                        <div id="packageContent" class="content">
                            <div class="cost right floated meta">$'.$package['PkgBasePrice'].' CAD</div>
                            <div class="trip header">'.$package['PkgName'].'</div>
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
                            '.$package['Duration'].'
                            </div>
                        </div>
                            '.$packageDateInfo.'
                            <button class="ui button right floated">Order</button>
                    </div>';
                }

                echo $packageDisplay;
            }
            ?>

        </div>


        <!--Section for travel images-->
    </section>

</main>
<?php include("pageSections/footer.php")?>