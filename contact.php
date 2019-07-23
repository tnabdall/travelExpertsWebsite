<?php include("pageSections/header.php") ?>
<script src="js/contact.js"></script>
<main>
    <div class="rounded sectionBox">

        <div class="ui five stackable cards">
            
            <?php
                require "classes/dbConnect.php";
                // $conn = getDatabase();
                $db = new Database();
                $conn = $db -> getConn();
                $sql = "SELECT t1.`AgencyId`
                , t1.`AgtFirstName`
                , t1.`AgtLastName`
                , t1.`AgtBusPhone`
                , t1.`AgtEmail`
                , t1.`AgtPosition`
                , t1.`Rating`
                , t1.`Description`
                , t1.`Title`
                , t1.`Image`
                , t2.`AgncyName`
                , t2.`AgncyAddress`
                , t2.`AgncyProv`
                , t2.`AgncyPhone`
                FROM agents t1
                JOIN agencies t2
                ON t2.`AgencyId` = t1.`AgencyId`
                WHERE 1";

                $result = $conn->query($sql);

                if ($result === false) {
                    var_dump($conn->errorInfo());
                } else {
                    $agents = $result->fetchAll(PDO::FETCH_ASSOC);
                }

                
                $counter = 1;
                
                foreach ($agents as $agent)
                {
                    // echo '
                    // <section class="company-info">
                    //     <ul class="agency-info">
                    //         <!-- Company Contact Information -->
                    //         <h2><b>Agency Name: Classical Travel</b></h2>
                    //         <p>Address: 123 Love Street, Heaven</p>
                    //     </ul>
                    // </section>
                    //     '
                    
                    echo '
                    <div id="contactCard'.$counter.'" class="ui card">
                        <!-- MODAL CODE -->
                        <div id="modal'.$counter.'" class="ui modal test">
                            <div class="header">
                                Agent Contact Information
                            </div>
                            <div class="image content">
                                <div class="ui small centered image">
                                    <img src="'.$agent['Image'].'">
                                </div>
                                <div class="description">
                                    <div class="ui header">'.$agent['AgtFirstName'].'" "'.$agent['AgtLastName'].'</div>
                                    <!-- Agent Contact Information -->
                                    <p>Phone#: '.$agent['AgtBusPhone'].'</p>
                                    <p>Email: '.$agent['AgtEmail'].'</p>
                                </div>
                            </div>

                            <div class="actions">
                                <div class="ui black deny button">
                                    Back
                                </div>
                                <div class="ui positive right labeled icon button">
                                    <a href="contactAgent.php">Contact Agent</a>
                                </div>

                            </div>
                        </div>
                        <!-- CONTACT CARD 1 -->
                        <div class="ui centered small image">
                            <img id="'.$agent['AgtLastName'].'" src="'.$agent['Image'].'">
                        </div>
                        <div class="content">
                            <a class="header">'.$agent['AgtFirstName'].'" "'.$agent['AgtLastName'].'</a>
                            <div class="meta">
                                <span class="date">'.$agent['AgtPosition'].'</span>
                            </div>
                            <div class="description">
                            '.$agent['Description'].'
                            </div>
                        </div>
                        <div class="extra">
                            Rating:
                            <div id="rating'.$counter.'" class="ui star rating"></div>
                        </div>
                    </div>
                    ';

                    $counter++; //counter for each contact card and modal
                }
            ?>

        </div>
    </div>
</main>
<?php include ("pageSections/footer.php") ?>