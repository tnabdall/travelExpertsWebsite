<?php
include("pageSections/header.php");
?>

<main>
    <form class="ui form" action="" method="POST">
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
            <button id="submitButton" type="submit" name = "submit" value="Submit"
                class="ui positive button" onclick="return confirm('Do you want to submit?')">Submit</button>
            <button type="reset" value="Reset" class="ui negative button" onclick="return confirm('Do you want to clear the form?')"
            >Reset</button>
        </div>
        </fieldset>
        
    </form>
</main>
<?php
include("pageSections/footer.php");
?>