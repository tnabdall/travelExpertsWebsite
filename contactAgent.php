<!--
    Document Heading
    Author: Tarik Abdalla
    Date: 6/24/2019
    Version 2
-->
<!DOCTYPE html>
<html>

<head>
    <title>
        Travel Experts - Links Page
    </title>
    <!-- Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="semanticUI/semantic.min.css">
    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:200,300,400,500,700,800%7CCinzel+Decorative:400,700,900&display=swap" rel="stylesheet">

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all"> -->
    <!-- Personal styling sheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="semanticUI/semantic.min.js"></script>

    <script src="https://kit.fontawesome.com/393c960404.js"></script>
    <script src="js/contact.js"></script>
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
            <h1 id="headerRow" class="ui header">
                <a href="index.html" class="ui image">
                    <img class="img-fluid align-self-center m-4 centered" id='logo' src="images/logo.png"
                        title="Travel Experts" alt="Travel Experts Logo">
                </a>
                <div id="headingTextDiv" class="content">
                    Travel Experts
                </div>
            </h1>
        </header>

        <div id="navBarHead" class="ui stackable menu four item">
            <a class="item" href="index.html">Home</a>
            <a class="item" href="contact.html">Contact</a>
            <a class="item" href="register.html">Customer Registration</a>
        </div>

        <main class="container-fluid">
            <div class="pl-4 pr-3 pt-1 pb-1 mt-3 rounded sectionBox">
                
            <?php
            require "classes/dbConnect.php";
            // $conn = getDatabase();
            $db = new Database();
            $conn = $db -> getConn();
            $sql = "SELECT *
                    FROM agencies;";

            $result = $conn->query($sql);

            if ($result === false) {
                var_dump($conn->errorInfo());
             } else {
                $agencies = $result->fetchAll(PDO::FETCH_ASSOC);
             }

            echo "<table class='agencies table table-dark col-3 ml-3' align='left' border='1' cellpadding='3' cellspacing='0' border='1'>
            <thead class ='thead-light'>   
                <tr class='de-flex'>
                    <th class='col-sm-1'>Agency</th>
                    <th class='col-sm-2'>Agency Address</th>
                    <th class='col-sm-1'>Agency City</th>
                    <th class='col-sm-1'>Agency Prov</th>
                    <th class='col-sm-1'>Agency Postal</th>
                    <th class='col-sm-2'>Agency Country</th>
                    <th class='col-sm-2'>Agency Phone</th>
                    <th class='col-sm-2'>Agency Fax</th>
                </tr>
            </thead>";

            foreach ($agencies as $agency)
            {
                echo "<tr class='d-flex>";
                    echo "<td class='col-sm-1'>" . $agency['AgencyId'] . "</td>";
                    echo "<td class='col-sm-2'>" . $agency['AgncyName'] . "</td>";
                    echo "<td class='col-sm-2'>" . $agency['AgncyAddress'] . "</td>";
                    echo "<td class='col-sm-1'>" . $agency['AgncyCity'] . "</td>";
                    echo "<td class='col-sm-1'>" . $agency['AgncyProv'] . "</td>";
                    echo "<td class='col-sm-1'>" . $agency['AgncyPostal'] . "</td>";
                    echo "<td class='col-sm-2'>" . $agency['AgncyCountry'] . "</td>";
                    echo "<td class='col-sm-2'>" . $agency['AgncyPhone'] . "</td>";
                    echo "<td class='col-sm-2'>" . $agency['AgncyFax'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        ?>    
                
            </div>
        </main>
        <footer>
            <!--Contains info fixed to bottom of page-->
            <div>
                <i id="planeImg" class="fas fa-fighter-jet"
                    style="position: absolute; bottom: 0%; font-size: 50px; color: #EF6C33;"></i><br />
            </div>
            <p>&copy; Tawico 2019 </p>
        </footer>
    </body>
</div>
<script src="js/footerPlane.js"></script>

</html>