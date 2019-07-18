<!--
    Document Heading
    Author: Tarik Abdalla
    Date: 6/24/2019
    Version 2
-->
<?php
include("header.php");
include("menu.php");
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

<main class="container-fluid">
    <!-- Holds the images on home page and changes format depending on screen size -->
    <section id="travelImageSection" class="ui grid">
        <!--Section for travel images-->

    </section>
    <section id="linkSection" class="container-fluid mt-3 p-1 ml-1 mr-1 justify-center-around">
        <!--Section to hold links to other pages-->
        <div class="ui grid two columns centered">
            <a href="contact.php" class="column">
                <img class="small-image img-fluid" src="images/contact.png" alt="Contact Us" title="Contact Us">
            </a>
            <a href="register.php" class="column">
                <img class="small-image img-fluid" src="images/register.png" alt="Register" title="Register">
            </a>
        </div>
    </section>
    <div id="timezoneValue" visibility="hidden"></div>
</main>
<?php
include("footer.php");
?>