<!-- Authors: Owiny Ayorech
Date: July 31,2019
Version: 2.5
Functionality: Shows vacation packages. Order button links to register page since this is an unregistered customer. -->
<?php
include("pageSections/header.php");
// Redirects if user is logged in. Done by Tarik.
if(isset($_SESSION['user_type'])){
   header("Location: index.php");
}
include("phpFunctions/loginProcess.php");
include("pageSections/menu.php");
?>
<main>
    <form id='loginForm' class="ui form mainContent" action="" method="POST">
        <fieldset >
                <div class="required field">
                    <label id='usernameLabel' for="username">User Name</label>
                    <input type="text" id="username" name="username" required="required">
                </div>
                <div class="required field">
                    <label id='passwordLabel' for="password">Password</label>
                    <input type="password" id="password" name = "password" required="required">
                </div>

            <div style="justify-content: center;">
            <!-- If failure to login, echo message -->
                <?php
                    if(isset($_SESSION['failedLogin'])){
                        echo "<p>Failed to login. Please check username and password.</p>";
                        unset($_SESSION['failedLogin']);
                    }
                ?>
            </div>
        
            <div class="ui two buttons">
                <button id="submitButton" type="submit" value="Submit" name="submitButton" onclick="return submitClick()"
                    class="positive ui button">Submit</button>
                <button type="reset" value="Reset" class="negative ui button"
                    onclick="return resetClick()">Reset</button>
            </div>
        </fieldset>
        
    </form>
</main>
<?php
include("pageSections/footer.php");
?>