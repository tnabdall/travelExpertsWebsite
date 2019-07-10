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


<main class="container-fluid">
    <section class="pl-4 pr-4 pt-1 pb-1 mt-3 rounded sectionBox">
        <?php
            include("variables.php");
            // Code to autopopoulate table of links
            $tableCode = "<table class = 'table'><thead><tr><th scope = 'col'>Website</th><th scope = 'col'>Page Link</th></tr></thead><tbody>";

            foreach($urlLinks as $url=>$description){
                $tableCode.="<tr><td>$description</td><td><a target='_blank' href = '$url'>$url</a></tr>";

            }
            $tableCode .= "</tbody></table>";
            echo $tableCode;
        ?>
    </section>
</main>

<?php
include("footer.php");
?>