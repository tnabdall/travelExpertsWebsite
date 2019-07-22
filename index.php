<?php include("pageSections/header.php")?>
<!-- Welcome banner -->
<?php
// Creates a welcome banner
 // Tries to get user timezone
$ip     = $_SERVER['REMOTE_ADDR']; // means we got user's IP address 
$json   = file_get_contents( 'http://ip-api.com/json/' . $ip); // this one service we gonna use to obtain timezone by IP
// maybe it's good to add some checks (if/else you've got an answer and if json could be decoded, etc.)
$ipData = json_decode( $json, true);
 // Sets timezone
if (array_key_exists('timezone', $ipData)) {
    $tz = new DateTimeZone( $ipData['timezone']);
    $now = new DateTime( 'now', $tz); // DateTime object corellated to user's timezone
    date_default_timezone_set(tz.name());
} else {
    date_default_timezone_set("America/Edmonton");
}
 $time = date("h:i a");
$greeting= '';
$icon='';
$is_am = (strpos($time,"pm")===FALSE);
$hour = intval(substr($time,0,2));
// Determine greeting and weather icon based on am_pm and hour
if ($is_am){
    if($hour>=5 && $hour!=12){
        $greeting="Good Morning";
        $icon = 'fas fa-sun';
    }
    else{
        $greeting="Good Evening";
        $icon = 'fas fa-moon';
    }
}
else{
    if($hour>=5 && $hour!=12){
        $greeting="Good Evening";
        $icon = 'fas fa-moon';
    }
    else{
        $greeting="Good Afternoon";
        $icon = 'fas fa-cloud-sun';
    }
}
// Removes leading 0 in hour
if($time[0]=="0"){
    $time=substr($time,1,strlen($time));
}
$bannerCode = "<div id = 'welcomeBanner' class = 'container-fluid w-100 pt-2 pb-2' style='background-color:#a8dadc; text-align: center; '>
<h4 class = 'pr-2' style='font-size:26px; color: #E63946; display:inline'>$greeting!</h4>
<i class='$icon pr-2' style='font-size:30px; color: #E63946;'></i>
<h4 style='font-size:26px; color: #E63946; display:inline'>The time is $time</h4>
</div>";
 echo $bannerCode;
?>
<script src="js/index.js"></script>
<main>
    <!-- Holds the images on home page and changes format depending on screen size -->
    <section id="travelImageSection">

        <div class="ui cards" id="cardCarousel">

            <div class="item card">
                <div class="image">
                    <img src="images/colloseum.jpg">
                </div>

                <div class="content">
                    <div class="right floated meta">$699</div>
                    <div class="header">Rome</div>
                    <div class="meta">
                        <div class="ui styled fluid accordion">
                            <div class="title">
                                <i class="dropdown icon"></i>
                                Overview
                            </div>
                            <div class="content">
                                <p class="transition">Tour Italy for 10 days</p>
                                <a href="https://www.tourradar.com/t/83000#p=2_">Full Itinerary</a>
                            </div>
                        </div>
                    </div>
                    <div class="description">
                        Colosseum
                    </div>
                </div>

                <div class="extra content">
                    <span>
                        August 7th, 2019 - August 17th, 2019
                    </span>
                </div>
            </div>

            <div class="item card">
                <div class="image">
                    <img src="images/colloseum.jpg">
                </div>
                <div class="content">
                    <div class="header">Molly</div>
                    <div class="meta">
                        <span class="date">Coworker</span>
                    </div>
                    <div class="description">
                        Molly is a personal assistant living in Paris.
                    </div>
                </div>
                <div class="extra content">
                    <span class="right floated">
                        Joined in 2011
                    </span>
                    <span>
                        <i class="user icon"></i>
                        35 Friends
                    </span>
                </div>
            </div>
            <div class="item card">
                <div class="image">
                    <img src="/images/avatar2/large/elyse.png">
                </div>
                <div class="content">
                    <div class="header">Elyse</div>
                    <div class="meta">
                        <a>Coworker</a>
                    </div>
                    <div class="description">
                        Elyse is a copywriter working in New York.
                    </div>
                </div>
                <div class="extra content">
                    <span class="right floated">
                        Joined in 2014
                    </span>
                    <span>
                        <i class="user icon"></i>
                        151 Friends
                    </span>
                </div>
            </div>
            <div class="item card">
                <div class="image">
                    <img src="/images/avatar2/large/elyse.png">
                </div>
                <div class="content">
                    <div class="header">Elyse</div>
                    <div class="meta">
                        <a>Coworker</a>
                    </div>
                    <div class="description">
                        Elyse is a copywriter working in New York.
                    </div>
                </div>
                <div class="extra content">
                    <span class="right floated">
                        Joined in 2014
                    </span>
                    <span>
                        <i class="user icon"></i>
                        151 Friends
                    </span>
                </div>
            </div>
            <div class="item card">
                <div class="image">
                    <img src="/images/avatar2/large/elyse.png">
                </div>
                <div class="content">
                    <div class="header">Elyse</div>
                    <div class="meta">
                        <a>Coworker</a>
                    </div>
                    <div class="description">
                        Elyse is a copywriter working in New York.
                    </div>
                </div>
                <div class="extra content">
                    <span class="right floated">
                        Joined in 2014
                    </span>
                    <span>
                        <i class="user icon"></i>
                        151 Friends
                    </span>
                </div>
            </div>
        </div>


        <!--Section for travel images-->
    </section>

</main>
<?php include("pageSections/footer.php")?>