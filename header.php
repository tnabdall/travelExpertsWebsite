<!DOCTYPE html>
<html>
<?php
session_start();
?>
<head>
    <title>
        Travel Experts - Links Page
    </title>
    <!-- Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="semanticUI/semantic.min.css">

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all"> -->
    <!-- Personal styling sheet -->
    <link rel="stylesheet" type="text/css" href="css/styling.css">
    <!-- Bootstrap -->
    <script src="js/jquery.min.js"></script>
    <script src="semanticUI/semantic.min.js"></script>
    
    <script src="https://kit.fontawesome.com/393c960404.js"></script>

    <script src="js/setNavActive.js"></script>
</head>
<div id="holder">
    <!-- Used holder div to fix footer to bottom
            of page without floating behaviour when window is resized.
            Without this formatting, resizing the window would make the footer appear
            fixed at the bottom when resizing the window.-->

    <body>
        <header>
            <!--Logo and welcome message-->
            <h1 id="headerRow" class = "ui header">
                <a href="index.php" class="ui image">
                    <img class="img-fluid align-self-center m-4 centered" id='logo' src="images/logo.png"
                        title="Travel Experts" alt="Travel Experts Logo">
                </a>
                <div id="headingTextDiv" class="content">
                    Travel Experts
                </div>
            </h1>
        </header>