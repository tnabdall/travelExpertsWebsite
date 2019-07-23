<?php
include("pageSections/header.php");
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
            <!-- If failure to login, echo message goes here -->
                <?php
                include("phpFunctions/loginProcess.php");
                ?>
            </div>
        
            <div class="ui two buttons">
                <button id="submitButton" type="submit" value="Submit" onclick="return submitClick()"
                    class="positive ui inverted button">Submit</button>
                <button type="reset" value="Reset" class="negative ui inverted button"
                    onclick="return resetClick()">Reset</button>
            </div>
        </fieldset>
        
    </form>
</main>
<?php
include("pageSections/footer.php");
?>