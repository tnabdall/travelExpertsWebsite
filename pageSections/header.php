<!-- Authors: Tarik Abdalla
Date: July 31,2019
Version: 2.5
Functionality: Page header -->

<!-- Start session for whole website -->
<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Travel Experts
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Semantic UI and Slick reference -->
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="semanticUI/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:200,300,400,500,700,800%7CCinzel+Decorative:400,700,900&display=swap"
        rel="stylesheet">

    <!-- Personal styling sheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Jquery, Slick, and Semantic UI -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script src="semanticUI/semantic.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>

    <!-- Sticky and shrinking header functionality -->
    <script src="js/header.js"></script>
    <!-- Sets the active page in the nav bar and formats as desktop or mobile menu-->
    <script src="js/menu.js"></script>
</head>
<div id="holder">
    <!-- Used holder div to fix footer to bottom
            of page without floating behaviour when window is resized.
            Without this formatting, resizing the window would make the footer appear
            fixed at the bottom when resizing the window.-->

    <body>
        <header>
            <!--Logo and welcome message-->
            <h1 id="headerRow" class="ui center aligned header">
                <a href="index.php" class="ui image">
                    <img class="img-fluid align-self-center m-4 centered" id='logo' src="images/logo.png"
                        title="Travel Experts" alt="Travel Experts Logo">
                </a>
                <div id="headingTextDiv" class="content">
                    Travel Experts
                </div>
            </h1>
            
       
        