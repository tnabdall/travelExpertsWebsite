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
        $icon = 'coffee icon';
    }
    else{
        $greeting="Good Evening";
        $icon = 'beer icon';
    }
}
else{
    if($hour>=5 && $hour!=12){
        $greeting="Good Evening";
        $icon = 'beer icon';
    }
    else{
        $greeting="Good Afternoon";
        $icon = 'utensils icon';
    }
}
// Removes leading 0 in hour
if($time[0]=="0"){
    $time=substr($time,1,strlen($time));
}
$bannerCode = "<div id = 'welcomeBanner'>
<h4>$greeting!</h4>
<i class='$icon' ></i>
</div>";
 echo $bannerCode;
?>