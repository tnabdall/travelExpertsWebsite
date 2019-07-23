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
            $sql = "SELECT `AgtFirstName`, `AgtLastName`, `AgtBusPhone`, `AgtEmail`, `AgtPosition`, `AgencyId`, `Rating`, `Description`, `Title`, `Image`  FROM `agents` WHERE 1;";

            $result = $conn->query($sql);

            if ($result === false) {
                var_dump($conn->errorInfo());
             } else {
                $agents = $result->fetchAll(PDO::FETCH_ASSOC);
             }

            foreach ($agents as $agent)
            {
                echo "<div class='ui centered small image'>
                <img id='" . $agent['AgtLastName']. "' src='" . $agent['Image'] . "'>
                </div>
                <div class='content'>
                <a class='header'>" . $agent['AgtFirstName'] . $agent['AgtLastName'] . "</a>
                <div class='meta'>
                <span class='date'>" . $agent['AgtPosition'] . "</span>
                </div>
                <div class='description'>" . $agent['Description'] . "</div>
                </div>
                <div class='extra'>
                Rating:
                <div id='rating1' class='ui star rating'></div>
                </div>
                </div>";
            }    
        ?>
        </div>
    </div>
</main>
<?php include ("pageSections/footer.php") ?>