<!--
    Document Heading
    Author: Tarik Abdalla
    Date: 6/24/2019
    Version 2
-->
<?php
include("header.php");
include("menu.php");
if(!isset($_SESSION['login_user'])){
    header("Location: login.php");
}
?>
<script src="js/setNavActive.js"></script>

<main>
    <form action="" method="POST">
        <fieldset class="container-fluid mt-2">
            <!--First grouping for required information-->
            <legend class="w-auto">Agent Information</legend>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='nameLabel' for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="AgtFirstName" required="required">
                </div>
                <div class="form-group col centered">
                    <label for="middleName">Middle Initial</label>
                    <input type="text" class="form-control" id="middleName" name="AgtMiddleInitial" placeholder="Not required"
                        pattern="[A-Za-z]{1}\.?">
                </div>
                <div class="form-group col centered">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="AgtLastName" required="required">
                </div>
            </div>
            
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='phoneLabel' for="phone">Business Phone </label>
                    <input type="tel" class="form-control" id="phone" name = "AgtBusPhone" placeholder="(403) 505-2121" pattern="\(\d{3}\) \d{3}[\-]\d{4}" required="required">
                </div>
                <div class="form-group col centered">
                    <label id='emailLabel' for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name = "AgtEmail" placeholder="Eg. john.doe@gmail.com"
                        required="required">
                </div>
            </div>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id="positionLabel" for="position">Agent Position</label>
                    <select id="position" name="AgtPosition" class="browser-default custom-select" required="required">
                        <option selected value="">Please select agent position</option>
                        <option value="Senior Agent">Senior Agent</option>
                        <option value="Intermediate Agent">Intermediate Agent</option>
                        <option value="Junior Agent">Junior Agent</option>
                    </select>
                </div>
                <div class="form-group col centered">
                    <label id="agencyIdLabel" for="agencyId">Agency Location</label>
                    <select id="agencyId" name="AgencyId" class="browser-default custom-select" required="required">
                        <option selected value= ''>Please select agency location</option>
                        <option value=1>1155 8th Ave SW, Calgary</option>
                        <option value=2>110 Main Street, Okotoks</option>
                    </select>
                </div>
            </div>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='usernameLabel' for="Username">Username</label>
                    <input type="text" class="form-control" id="Username" name = "Username" required="required">
                </div>
                <div class="form-group col centered">
                    <label id='passwordLabel' for="Password">Email Address</label>
                    <input type="password" class="form-control" id="Password" name = "Password" required="required">
                </div>
            </div>
            <div class="container-fluid row centered">
                <?php
                include("phpFunctions/agentRegisterSubmit.php"); // Submits form to agent table in DB
                ?>
            </div>

        </fieldset><br />
        <div class="container-fluid row centered">
            <button id="submitButton" type="submit" name = "submit" value="Submit"
                class="btn btn-primary m-2 col" onclick="return confirm('Do you want to submit?')">Submit</button>
            <button type="reset" value="Reset" class="btn btn-primary m-2 col" onclick="return confirm('Do you want to clear the form?')"
            >Reset</button>
        </div>
        
    </form>
</main>
<?php
include("footer.php")
?>