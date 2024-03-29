<!-- Authors: Nicolas Tambellini
Date: July 31,2019
Version: 2.5
Functionality: Add Vacation Package Form -->

<?php
// Redirects to login page if not logged in as an agent. Done by Tarik
include("pageSections/header.php");
if(!isset($_SESSION['user_type'])){
    header("Location: login.php");
}
else{
    if($_SESSION['user_type']!='agent'){
        header("Location: login.php");
    }
}
include("pageSections/menu.php");
?>
<script src="js/packageRegister.js"></script>
<main>
    <form id="vacationForm" class="ui form mainContent" action="" method="POST" enctype="multipart/form-data">
        <fieldset>
        <?php
        include("phpFunctions/vacationPackageSubmit.php"); // Submits form to packages table in DB
        ?>
            <div class="three fields">
                <div class="required field">
                    <label id='pkgNameLabel' for="PkgName">Package Name</label>
                    <input type="text" id="PkgName" name="PkgName" required="required">
                </div>
                <div class="required field">
                    <label for="Partner">Partner URL</label>
                    <input type="text" id="Partner" name="Partner">
                </div>
                <div id="checkBoxDiv" class="ui checkbox field">
                    <input type="checkbox" id="AirfairInclusion" name="AirfairInclusion" value=1>
                    <label id="checkBoxLabel">Airfare Included?</label>
                </div>
            </div>

            <div class="three fields">
                <div class="required field">
                    <label id='startDateLabel' for="PkgStartDate">Package Start Date </label>
                    <input type="date" id="PkgStartDate" name="PkgStartDate"required="required">
                </div>
                <div class="required field">
                    <label id='endDateLabel' for="PkgEndDate">Package End Date </label>
                    <input type="date" id="PkgEndDate" name="PkgEndDate"required="required">
                </div>
                <div class="required field">
                    <label id='basePriceLabel' for="PkgBasePrice">Package Base Price</label>
                    <input type="text" id="PkgBasePrice" name="PkgBasePrice"required="required">
                </div>
            </div>
            <div class = "required field">
                <label id='descriptionLabel' for="PkgDesc">Package Description</label>
                <input type="text" id="PkgDesc" name="PkgDesc" required="required">
            </div>
            <div class="required field">
                <label id='imageLabel' for="Image">Package Photo</label>
                <input type="file" id="Image" name="Image" accept="image/*" required="required">
            </div>            
            <div class="centered">
                
            </div>
            <div class="ui two buttons">
                <button id="submitButton" type="submit" name="submit" value="Submit" class="positive ui button"
                    onclick="return submitClick()">Submit</button>
                <button type="reset" value="Reset" class="ui negative button"
                    onclick="return confirm('Do you want to clear the form?')">Reset</button>
            </div>
        </fieldset>
    </form>
</main>
<?php
include("pageSections/footer.php")
?>