<?php include("pageSections/header.php") ?>

<main>
    <div class="rounded sectionBox mainContent">

        
            
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
                , t1.`AgtMessage`
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

                $numberOfAgents = count($agents);
                $counter = 1;
                $heavenData = [];
                $hellData = [];
                
                $heavenHeader = '';
                $hellHeader = '';
                
                foreach ($agents as $agent)
                {
                    $_SESSION['agentData'][] = $agent;
                    // $agentContactData = json_encode($agent);
                    $ratingMessage=' Rating pending';
                    if($agent['Rating']!=NULL){
                        $ratingMessage='Rating: <div id="rating'.$counter.'" class="ui star rating" data-rating="'.$agent['Rating'].'" data-max-rating="5"></div>';
                    }
                    $currentCard = '
                    <div id="contactCard'.$counter.'" class="ui card">
                        <!-- MODAL '.$counter.' CODE -->
                        <div id="modal'.$counter.'" class="ui modal">
                            <div class="header">
                                Agent Contact Information
                            </div>
                            <div class="image content">
                                <div class="ui medium centered image">
                                    <img id="modalCard" src="'.$agent['Image'].'">
                                </div>
                                <div class="description">
                                    <div class="ui header">'.$agent['AgtFirstName'].' '.$agent['AgtLastName'].'</div>
                                    <!-- Agent Contact Information -->
                                    <p>Phone#: '.$agent['AgtBusPhone'].'</p>
                                    <p>Email: '.$agent['AgtEmail'].'</p>
                                    <p>'.$agent['Description'].'</p>
                                </div>
                            </div>

                            <div class="actions">
                                <div class="ui black deny button">
                                    Back
                                </div>
                                <form method="POST">
                                <div type="button" class="contactButton ui button">
                                    <a class="contactButton" href="contactAgent.php">Contact Agent</a>
                                </div>
                                </form>

                            </div>
                        </div>
                        <!-- CONTACT CARD '.$counter.' -->
                        <div class="ui centered small image imageDiv">
                            <img class="contactCardImage" id="'.$agent['AgtLastName'].'" src="'.$agent['Image'].'">
                        </div>
                        <div id="agentCardInfo" class="content">
                            <p class="header">'.$agent['AgtFirstName'].' '.$agent['AgtLastName'].'</p>
                            <div class="meta">
                                <span class="date">"'.$agent['Title'].'"</span>
                            </div>
                            <div class="description">
                            '.$agent['AgtPosition'].'
                            </div>
                        </div>
                        <div class="extra">
                            '.
                            $ratingMessage.
                            '<button id="infoButton" class="ui button right floated">Info</button>
                        </div>
                    </div>
                    ';

                    if ($agent['AgencyId'] == 1) //heaven
                    {
                        $heavenData[] = $currentCard;
                        if ($counter == $numberOfAgents or $heavenHeader == '')
                        {
                            $heavenHeader = '
                            <section class="company-info">
                                <ul class="agency-info">
                                    <!-- Company Contact Information -->
                                    <h2><b>Agency Name: '.$agent['AgncyName'].'</b></h2>
                                    <p class="company-info">Address: '.$agent['AgncyAddress'].'</p>
                                    <p class="company-info">Address: '.$agent['AgncyPhone'].'</p>
                                </ul>
                            </section>
                                ';
                        }
                    }
                    elseif ($agent['AgencyId'] == 2) //hell
                    {
                        $hellData[] = $currentCard;
                        if ($counter == $numberOfAgents or $hellHeader == '')
                        {
                            $hellHeader = '
                            <section class="company-info">
                                <ul class="agency-info">
                                    <!-- Company Contact Information -->
                                    <h2><b>Agency Name: '.$agent['AgncyName'].'</b></h2>
                                    <p class="company-info">Address: '.$agent['AgncyAddress'].'</p>
                                    <p class="company-info">Address: '.$agent['AgncyPhone'].'</p>
                                </ul>
                            </section>
                                ';
                        }
                    }
                    
                    $counter++; //counter for each contact card and modal
                    unset($_SESSION['agentData']); //if our loop gets here destroy variable so it can be built on next iteration
                }

                echo "<div>".$heavenHeader."</div>";
                echo '<div class="ui five stackable cards">';
                $length = count($heavenData);
                for ($i = 0; $i < $length; $i++) 
                {
                    echo $heavenData[$i];
                }
                echo '</div>';

                echo "<div>".$hellHeader."</div>";
                echo '<div class="ui five stackable cards">';
                $length = count($hellData);
                for ($i = 0; $i < $length; $i++) 
                {
                    echo $hellData[$i];
                }
                echo '</div>';
            ?>

        
    </div>
</main>
<script src="js/contact.js"></script>
<?php include ("pageSections/footer.php") ?>