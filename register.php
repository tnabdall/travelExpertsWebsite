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
<script src="js/register.js"></script>
<main>
    <form class = "ui form" action="http://localhost:1234/bouncer.php" method="POST">
        <fieldset>
            <div class="three fields">
                <div class="required field">
                    <label id='nameLabel' for="firstName">First Name</label>
                    <input type="text"  id="firstName" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="required field">
                    <label for="middleName">Middle Name</label>
                    <input type="text"  id="middleName" placeholder="Not required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="required field">
                    <label for="lastName">Last Name</label>
                    <input type="text"  id="lastName" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            </div>
            
                <div class="required field">
                    <label class="container-fluid" for="streetAddress">Street address</label>
                    <input type="text"  id="streetAddress" required="required"
                        placeholder="Eg. 123 Main St" onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            
            <div class="three fields">
                <div class="required field">
                    <label id='cityLabel' for="city">City</label>
                    <input type="text"  id="city" placeholder="Eg. Calgary" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="required field">
                    <label id="provinceLabel" for="province">Province</label>
                    <select id="province" class="browser-default custom-select">
                        <option selected value="AB">Alberta</option>
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
                <div class="required field">
                    <label id='postalLabel' for="postalCode">Postal Code</label>
                    <input type="text"  id="postalCode" placeholder="Eg. T1A 1A1"
                        pattern="[A-Za-z][0-9][A-Za-z][ ]?[0-9][A-Za-z][0-9]" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    <label id='emailLabel' for="email">Email Address</label>
                    <input type="email"  id="email" placeholder="Eg. john.doe@gmail.com"
                        required="required" onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="required field">
                    <label id='emailLabel' for="pWord">Password</label>
                    <input type="password"  id="pWord" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            </div>

            <div class="field">
                <label class="col-3 m-1 centered" for="preferredDestinations">Preferred Destinations</label>
                <input type="text" class=" col-8 m-2" id="preferredDestinations" placeholder=""
                    onfocus="focusFunc(this.id)" onblur="blurFunc()">
            </div>
            <div class="field">
                <label class="col-3 m-1" for="additionalInfo">Additional Information</label>
                <textarea type="text" class=" col-8 m-2" id="additionalInfo" placeholder=""
                    onfocus="focusFunc(this.id)" onblur="blurFunc()"></textarea>
            </div>
        <div class="ui two buttons">
            <button id="submitButton" type="submit" value="Submit" onclick="return submitClick()"
                class="positive ui button">Submit</button>
            <button type="reset" value="Reset" class="negative ui button"
                onclick="return resetClick()">Reset</button>
        </div>
    </fieldset>
    </form>
</main>
<?php
include("footer.php")
?>