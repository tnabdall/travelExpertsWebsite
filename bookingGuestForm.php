<!-- Authors: Nicolas Tambellini
Date: July 31,2019
Version: 2.5
Functionality: Form to add new customer and booking to DB -->
<?php
include("pageSections/header.php");
// Redirects to index if customer is already logged in. Done by Tarik.
if(isset($_SESSION['user_type'])){
    header("Location: index.php");
}
?>

<script src="js/bookingGuestRegister.js"></script>
<main>
    <form class="ui form mainContent" action="" method="POST">
        <fieldset>
        <?php
        // Adds php functionality to modify db with form
            include("phpFunctions/bookingGuestRegisterSubmit.php");
        ?>
            <div class = "two fields">
                
                <div class = "field">
                    <p id="bookingName" class="bookingName">
                        Travel Booking for: 
                        <?php 
                            echo $_SESSION['pkgName'];
                        ?>
                        <br>
                    </p>
                </div>
                <div class="focus required field">
                    <label id="tripTypeLabel" for="TripTypeId">Trip Type</label>
                    <select id="TripTypeId" name="TripTypeId">
                        <option value="">Trip Type</option>
                        <option value="B">Business</option>
                        <option value="G">Group</option>
                        <option value="L">Leisure</option>
                    </select>
                </div>
            </div>
            <div class="two fields">
                <div class="focus required field">
                    <label id='nameLabel' for="CustFirstName">First Name</label>
                    <input type="text" id="CustFirstName" name="CustFirstName" required="required">
                </div>
                <div class="focus required field">
                    <label for="CustLastName">Last Name</label>
                    <input type="text" id="CustLastName" name="CustLastName" required="required">
                </div>
            </div>

            <div class="focus required field">
                <label for="CustAddress">Street address</label>
                <input type="text" id="CustAddress" name="CustAddress" required="required" placeholder="Eg. 123 Main St">
            </div>

            <div class="four fields">
                <div class="focus required field">
                    <label id='cityLabel' for="CustCity">City</label>
                    <input type="text" id="CustCity" name="CustCity" placeholder="Eg. Calgary" required="required">
                </div>
                <div class="focus required field">
                    <label id="provinceLabel" for="CustProv">Province/State</label>
                    <select id="CustProv" name = "CustProv">
                        <option id = "blankSelectProvince" value="">Please choose your country first</option>
                        <optgroup id ="provinces" label = "Provinces">
                            <option class = "canProv" value="AB">Alberta</option>
                            <option class = "canProv" value="BC">British Columbia</option>
                            <option class = "canProv" value="MB">Manitoba</option>
                            <option class = "canProv" value="NB">New Brunswick</option>
                            <option class = "canProv" value="NL">Newfoundland and Labrador</option>
                            <option class = "canProv" value="NS">Nova Scotia</option>
                            <option class = "canProv" value="NT">Northwest Territories</option>
                            <option class = "canProv" value="NU">Nunavut</option>
                            <option class = "canProv" value="ON">Ontario</option>
                            <option class = "canProv" value="PE">Prince Edward Island</option>
                            <option class = "canProv" value="QC">Quebec</option>
                            <option class = "canProv" value="SK">Saskatchewan</option>
                            <option class = "canProv" value="YT">Yukon</option>
                        </optgroup>
                            <optgroup id="states" label = "States">
                            <option class = "usState" value="AL">Alabama</option>
                            <option class = "usState" value="AK">Alaska</option>
                            <option class = "usState" value="AZ">Arizona</option>
                            <option class = "usState" value="AR">Arkansas</option>
                            <option class = "usState" value="CA">California</option>
                            <option class = "usState" value="CO">Colorado</option>
                            <option class = "usState" value="CT">Connecticut</option>
                            <option class = "usState" value="DE">Delaware</option>
                            <option class = "usState" value="DC">District Of Columbia</option>
                            <option class = "usState" value="FL">Florida</option>
                            <option class = "usState" value="GA">Georgia</option>
                            <option class = "usState" value="HI">Hawaii</option>
                            <option class = "usState" value="ID">Idaho</option>
                            <option class = "usState" value="IL">Illinois</option>
                            <option class = "usState" value="IN">Indiana</option>
                            <option class = "usState" value="IA">Iowa</option>
                            <option class = "usState" value="KS">Kansas</option>
                            <option class = "usState" value="KY">Kentucky</option>
                            <option class = "usState" value="LA">Louisiana</option>
                            <option class = "usState" value="ME">Maine</option>
                            <option class = "usState" value="MD">Maryland</option>
                            <option class = "usState" value="MA">Massachusetts</option>
                            <option class = "usState" value="MI">Michigan</option>
                            <option class = "usState" value="MN">Minnesota</option>
                            <option class = "usState" value="MS">Mississippi</option>
                            <option class = "usState" value="MO">Missouri</option>
                            <option class = "usState" value="MT">Montana</option>
                            <option class = "usState" value="NE">Nebraska</option>
                            <option class = "usState" value="NV">Nevada</option>
                            <option class = "usState" value="NH">New Hampshire</option>
                            <option class = "usState" value="NJ">New Jersey</option>
                            <option class = "usState" value="NM">New Mexico</option>
                            <option class = "usState" value="NY">New York</option>
                            <option class = "usState" value="NC">North Carolina</option>
                            <option class = "usState" value="ND">North Dakota</option>
                            <option class = "usState" value="OH">Ohio</option>
                            <option class = "usState" value="OK">Oklahoma</option>
                            <option class = "usState" value="OR">Oregon</option>
                            <option class = "usState" value="PA">Pennsylvania</option>
                            <option class = "usState" value="RI">Rhode Island</option>
                            <option class = "usState" value="SC">South Carolina</option>
                            <option class = "usState" value="SD">South Dakota</option>
                            <option class = "usState" value="TN">Tennessee</option>
                            <option class = "usState" value="TX">Texas</option>
                            <option class = "usState" value="UT">Utah</option>
                            <option class = "usState" value="VT">Vermont</option>
                            <option class = "usState" value="VA">Virginia</option>
                            <option class = "usState" value="WA">Washington</option>
                            <option class = "usState" value="WV">West Virginia</option>
                            <option class = "usState" value="WI">Wisconsin</option>
                            <option class = "usState" value="WY">Wyoming</option>
                        </optgroup>
                    </select>
                </div>
                <div class="focus required field">
                    <label id='postalLabel' for="CustPostal">Postal/Zip Code</label>
                    <input type="text" id="CustPostal" name="CustPostal" placeholder="Eg. T1A 1A1 or 90210" required="required">
                </div>
                <div class="focus required field">
                    <label id="countryLabel" for="CustCountry">Country</label>
                    <select id="CustCountry" name="CustCountry">
                        <option value="">Country</option>
                        <option value="Canada">Canada</option>
                        <option value="USA">USA</option>
                    </select>
                </div>
            </div>
            <div class = "two fields">
                <div class="focus required field">
                    <label id='personalPhoneLabel' for="CustHomePhone">Home Phone</label>
                    <input type="text" id="CustHomePhone" name="CustHomePhone" required="required">
                </div>
                <div class="focus field">
                    <label id="businessPhoneLabel" for="CustBusPhone">Work Phone</label>
                    <input type="text" id="CustBusPhone" name ="CustBusPhone">
                </div>
            </div>
            <div class="focus required field">
                <label id='emailLabel' for="CustEmail">Email Address</label>
                <input type="email" id="CustEmail" name="CustEmail" placeholder="Eg. john.doe@gmail.com" required="required">
            </div>
            <div class="two fields">
                <div class="focus required field">
                    <label id='userLabel' for="Username">Username</label>
                    <input type="text" id="Username" name="Username" required="required">
                </div>
                <div class="focus required field">
                    <label id='emailLabel' for="Password">Password</label>
                    <input type="password" id="Password" name="Password" required="required">
                </div>
            </div>
            <div class="ui two buttons">
                <button id="submitButton" type="submit" value="Submit" name="submit" onclick="return confirm('Would you like to submit?')"
                    class="positive ui button">Submit</button>
                <button type="reset" value="Reset" class="negative ui button"
                    onclick="return resetClick()">Reset</button>
            </div>
        </fieldset>
    </form>
</main>
<?php include("pageSections/footer.php") ?>