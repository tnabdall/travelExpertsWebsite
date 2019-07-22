<?php include("pageSections/header.php") ?>
<script src="js/customerRegister.js"></script>
<main>
    <form class="ui form" action="http://localhost:1234/bouncer.php" method="POST">
        <fieldset>
            <div class="three fields">
                <div class="focus required field">
                    <label id='nameLabel' for="firstName">First Name</label>
                    <input type="text" id="firstName" required="required">
                </div>
                <div class="focus field">
                    <label for="middleName">Middle Name</label>
                    <input type="text" id="middleName">
                </div>
                <div class="focus required field">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" required="required">
                </div>
            </div>

            <div class="focus required field">
                <label for="streetAddress">Street address</label>
                <input type="text" id="streetAddress" required="required" placeholder="Eg. 123 Main St">
            </div>

            <div class="three fields">
                <div class="focus required field">
                    <label id='cityLabel' for="city">City</label>
                    <input type="text" id="city" placeholder="Eg. Calgary" required="required">
                </div>
                <div class="focus required field">
                    <label id="provinceLabel" for="province">Province</label>
                    <select id="province">
                        <option value="">Province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="YT">Yukon</option>
                    </select>
                </div>
                <div class="focus required field">
                    <label id='postalLabel' for="postalCode">Postal Code</label>
                    <input type="text" id="postalCode" placeholder="Eg. T1A 1A1"
                        pattern="[A-Za-z][0-9][A-Za-z][ ]?[0-9][A-Za-z][0-9]" required="required">
                </div>
            </div>
            <div class="focus required field">
                <label id='emailLabel' for="email">Email Address</label>
                <input type="email" id="email" placeholder="Eg. john.doe@gmail.com" required="required">
            </div>
            <div class="two fields">
                <div class="focus required field">
                    <label id='userLabel' for="username">Username</label>
                    <input type="text" id="username" required="required">
                </div>
                <div class="focus required field">
                    <label id='emailLabel' for="pWord">Password</label>
                    <input type="password" id="pWord" required="required">
                </div>
            </div>

            <div class="field">
                <label for="preferredDestinations">Preferred Destinations</label>
                <input type="text" class=" col-8 m-2" id="preferredDestinations" placeholder="">
            </div>
            <div class="field">
                <label for="additionalInfo">Additional Information</label>
                <textarea type="text" class=" col-8 m-2" id="additionalInfo" placeholder=""></textarea>
            </div>
            <div class="ui two buttons">
                <button id="submitButton" type="submit" value="Submit" onclick="return submitClick()"
                    class="positive ui inverted button">Submit</button>
                <button type="reset" value="Reset" class="negative ui inverted button"
                    onclick="return resetClick()">Reset</button>
            </div>
            <div class="ui success message">
                <div class="header">Form Completed</div>
                <p>You're all signed up.</p>
            </div>
        </fieldset>
    </form>
</main>
<?php include("pageSections/footer.php") ?>