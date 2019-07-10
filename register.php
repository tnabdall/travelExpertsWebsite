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
<script src="js/setNavActive.js"></script>
<script src="js/register.js"></script>
<main>
    <form action="http://localhost:1234/bouncer.php" method="POST">
        <fieldset class="container-fluid mt-2">
            <!--First grouping for required information-->
            <legend class="w-auto">Customer Information</legend>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='nameLabel' for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="form-group col centered">
                    <label for="middleName">Middle Name</label>
                    <input type="text" class="form-control" id="middleName" placeholder="Not required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="form-group col centered">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            </div>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label class="container-fluid" for="streetAddress">Street address</label>
                    <input type="text" class="form-control" id="streetAddress" required="required"
                        placeholder="Eg. 123 Main St" onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            </div>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='cityLabel' for="city">City</label>
                    <input type="text" class="form-control" id="city" placeholder="Eg. Calgary" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="form-group col centered">
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
                <div class="form-group col centered">
                    <label id='postalLabel' for="postalCode">Postal Code</label>
                    <input type="text" class="form-control" id="postalCode" placeholder="Eg. T1A 1A1"
                        pattern="[A-Za-z][0-9][A-Za-z][ ]?[0-9][A-Za-z][0-9]" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            </div>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='emailLabel' for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Eg. john.doe@gmail.com"
                        required="required" onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
                <div class="form-group col centered">
                    <label id='emailLabel' for="pWord">Password</label>
                    <input type="password" class="form-control" id="pWord" required="required"
                        onfocus="focusFunc(this.id)" onblur="blurFunc()">
                </div>
            </div>

        </fieldset><br />
        <fieldset class="container-fluid">
            <!--Second grouping for optional information-->
            <legend class="w-auto">Optional Information</legend>
            <div class="form-inline row">
                <label class="col-3 m-1 centered" for="preferredDestinations">Preferred Destinations</label>
                <input type="text" class="form-control col-8 m-2" id="preferredDestinations" placeholder=""
                    onfocus="focusFunc(this.id)" onblur="blurFunc()">
            </div>
            <div class="form-inline row centered">
                <label class="col-3 m-1" for="additionalInfo">Additional Information</label>
                <textarea type="text" class="form-control col-8 m-2" id="additionalInfo" placeholder=""
                    onfocus="focusFunc(this.id)" onblur="blurFunc()"></textarea>
            </div>
        </fieldset>
        <div class="container-fluid row centered">
            <button id="submitButton" type="submit" value="Submit" onclick="return submitClick()"
                class="btn btn-primary m-2 col">Submit</button>
            <button type="reset" value="Reset" class="btn btn-primary m-2 col"
                onclick="return resetClick()">Reset</button>
        </div>
    </form>
</main>
<?php
include("footer.php")
?>