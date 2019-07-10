<!--
    Document Heading
    Author: Tarik Abdalla
    Date: 6/24/2019
    Version 2
-->
<?php
include("header.php");
include("menu.php");
?>
<script src = "js/setNavActive.js"></script>
<main class="container-fluid" onload='populateDescTable()'>
    <div class="pl-4 pr-3 pt-1 pb-1 mt-3 rounded sectionBox">
        <p class="row centered">Feel free to contact our agency by phone (403-200-0000), email
            (travel@travelexperts.com), or by reaching out to any of our great agents.</p>
        <dl class="container-fluid">
            
            <dt><b>Tarik A - Head Travel Agent</b></dt>
            <dd>Phone: 403-200-0001</dd>
            <dd>Email: tarik.a@travelexperts.com</dd>

            <dt><b>John Doe - International Travel Agent</b></dt>
            <dd>Phone: 403-200-0002</dd>
            <dd>Email: john.doe@travelexperts.com</dd>

            <dt><b>Mary Jane - Domestic Travel Agent</b></dt>
            <dd>Phone: 403-200-0003</dd>
            <dd>Email: mary.jane@travelexperts.com</dd>
        </dl>
    </div>
</main>
<?php
include("footer.php");
?>