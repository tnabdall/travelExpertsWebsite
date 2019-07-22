<?php
include("functions.php");

$agentData = array('AgtFirstName'=>'Tarik','AgtLastName'=>'Abdalla','AgtBusPhone'=>'(403) 200-0001','AgtEmail'=>'tarik.a@travelexperts.com','AgtPosition'=>'Head Agent','AgencyId'=>1);


$success = insertData($agentData,'agents', 'travelexperts','root','');
if($success){
    echo "Successfully inserted data into the table.";
}
else{
    echo "Failed to insert data into the table.";
}

?>