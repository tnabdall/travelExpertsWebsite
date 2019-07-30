<?php include("pageSections/header.php") ?>

<main>
    <div class="rounded sectionBox mainContent">
            <?php
                require "classes/dbConnect.php";
                require "phpFunctions/functions.php";

                // Get all agency and agent data
                $agencies = grabAllData('agencies','travelexperts','dbAdmin','L0g1n2db!');
                $agents = grabAllData('agents','travelexperts','dbAdmin','L0g1n2db!');
    
                $counter = 1; // Counter to give each card/modal a unique id
                
                // Array to store 1. Agency header, 2.All agents within an agency
                $agencyData=[];

                // Populating headers for agencies
                foreach ($agencies as $agency){
                    $agencyData[(string) $agency['AgencyId']]['header']='
                    <section class="company-info">
                        <ul class="agency-info">
                            <!-- Company Contact Information -->
                            <h2><b>Agency Name: '.$agency['AgncyName'].'</b></h2>
                            <p class="company-info">Address: '.$agency['AgncyAddress'].'</p>
                            <p class="company-info">Address: '.$agency['AgncyPhone'].'</p>
                        </ul>
                    </section>
                        ';
                        $agencyData[(string) $agency['AgencyId']]['cardData']=[];
                }
                
                // Populating each agency with agents
                foreach ($agents as $agent)
                {
                    // Determines rating for an agent
                    $ratingMessage=' Rating pending';
                    if($agent['Rating']!=NULL){
                        $ratingMessage='Rating: <div id="rating'.$counter.'" class="ui star rating" data-rating="'.$agent['Rating'].'" data-max-rating="5"></div>';
                    }

                    // HTML formatting for agent and modal
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
                                <div class="contactButton ui button">
                                    <a class="contactButton" href="contactAgent.php">Contact Agent</a>
                                </div>

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

                    // Add agent to agency that he belongs to
                    array_push($agencyData[(string) $agent['AgencyId']]['cardData'],$currentCard);
                    
                    $counter++; //counter for each contact card and modal
                }

                // Print out agency, then all agents beginning to that agency
                foreach($agencyData as $agencyId){
                    echo "<div>".$agencyId['header']."</div>";
                    echo '<div class="ui five stackable cards">';
                    for ($i = 0; $i < count($agencyId['cardData']); $i++) 
                    {
                        echo $agencyId['cardData'][$i];
                    }
                    echo '</div>';
                }
            ?>     
    </div>
</main>
<script src="js/contact.js"></script>
<?php include ("pageSections/footer.php") ?>