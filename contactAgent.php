<?php include("pageSections/header.php") ?>

<?php

include("pageSections/welcomeBanner.php");

if(isset($_POST['submit']))
{
    foreach ($_POST['submit'] as $agentData)
    {
        echo $agentData;
    }

}
else
{
    echo 'Not passing the data yet!';
}

?>

<script src="js/contact.js"></script>
<?php include ("pageSections/footer.php") ?>