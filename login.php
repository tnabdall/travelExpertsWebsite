<?php
include("header.php");
include("menu.php");
?>
<script src = "js/setNavActive.js"></script>

<main>
    <form action="" method="POST">
        <fieldset class="container-fluid mt-4">
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='usernameLabel' for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" required="required">
                </div>
            </div>
            <div class="row container-fluid">
                <div class="form-group col centered">
                    <label id='passwordLabel' for="password">Password</label>
                    <input type="password" class="form-control" id="password" name = "password" required="required">
                </div>
            </div>
            <div class="row container-fluid centered" style="justify-content: center;">
                <?php
                include("phpFunctions/loginProcess.php");
                ?>
            </div>
        </fieldset>
        <div class="container-fluid row centered">
            <button id="submitButton" type="submit" name = "submit" value="Submit"
                class="btn btn-primary m-2 col" onclick="return confirm('Do you want to submit?')">Submit</button>
            <button type="reset" value="Reset" class="btn btn-primary m-2 col" onclick="return confirm('Do you want to clear the form?')"
            >Reset</button>
        </div>
        
    </form>
</main>
<?php
include("footer.php");
?>