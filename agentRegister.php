<!-- Authors: Nicolas Tambellini
Date: July 31,2019
Version: 2.5
Functionality: Add Vacation Package Form -->

<?php
include("pageSections/header.php");
// Redirects to login page if not logged in as an agent. Done by Tarik
if(!isset($_SESSION['user_type'])){
    header("Location: login.php");
}
else{
    if($_SESSION['user_type']!='agent'){
        header("Location: login.php");
    }
}
?>
<script src="js/agentRegister.js"></script>
<main>
    <form id="agentForm" class="ui form mainContent" action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <div class="three fields">
                <div class="required field">
                    <label id='nameLabel' for="firstName">First Name</label>
                    <input type="text" id="firstName" name="AgtFirstName" required="required">
                </div>
                <div class="field">
                    <label for="middleName">Middle Initial</label>
                    <input type="text" id="middleName" name="AgtMiddleInitial" placeholder="Not required"
                        pattern="[A-Za-z]{1}\.?">
                </div>
                <div class="required field">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="AgtLastName" required="required">
                </div>
            </div>

            <div class="two fields">
                <div class="required field">
                    <label id='phoneLabel' for="phone">Business Phone </label>
                    <input type="tel" id="phone" name="AgtBusPhone" placeholder="(403) 505-2121"
                        pattern="\(\d{3}\) \d{3}[\-]\d{4}" required="required">
                </div>
                <div class="required field">
                    <label id='emailLabel' for="email">Email Address</label>
                    <input type="email" id="email" name="AgtEmail" placeholder="Eg. john.doe@gmail.com"
                        required="required">
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    <label id="positionLabel" for="position">Agent Position</label>
                    <select id="position" name="AgtPosition" class="browser-default custom-select" required="required">
                        <option selected value="">Please select agent position</option>
                        <option value="Senior Agent">Senior Agent</option>
                        <option value="Intermediate Agent">Intermediate Agent</option>
                        <option value="Junior Agent">Junior Agent</option>
                    </select>
                </div>
                <div class="required field">
                    <label id="agencyIdLabel" for="agencyId">Agency Location</label>
                    <select id="agencyId" name="AgencyId" class="browser-default custom-select" required="required">
                        <option selected value=''>Please select agency location</option>
                        <option value=1>Classical Travel</option>
                        <option value=2>Rock and Roll Travel</option>
                    </select>
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    <label id='usernameLabel' for="Username">Username</label>
                    <input type="text" id="Username" name="Username" required="required">
                </div>
                <div class="required field">
                    <label id='passwordLabel' for="Password">Password</label>
                    <input type="password" id="Password" name="Password" required="required">
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    <label id='titleLabel' for="Title">Personal Title</label>
                    <input type="text" id="Title" name="Title" required="required">
                </div>
                <div class="required field">
                    <label id='imageLabel' for="Image">Profile Photo</label>
                    <input type="file" id="Image" name="Image" accept="image/*" required="required">
                </div>
            </div>
            <div class = "required field">
                <label id='descriptionLabel' for="Description">Favourite Quote</label>
                <input type="text" id="Description" name="Description" required="required">
            </div>
            <div class="centered">
                <?php
                include("phpFunctions/agentRegisterSubmit.php"); // Submits form to agent table in DB
                ?>
            </div>


            <div class="ui two buttons">
                <button id="submitButton" type="submit" name="submit" value="Submit" class="positive ui inverted button"
                    onclick="return submitClick()">Submit</button>
                <button type="reset" value="Reset" class="ui negative inverted button"
                    onclick="return confirm('Do you want to clear the form?')">Reset</button>
            </div>
            <div id="successMessage" class="ui success message">
                <div class="header">Form Completed</div>
                <p>You're all signed up.</p>
            </div>
        </fieldset>
    </form>
</main>
<?php
include("pageSections/footer.php")
?>