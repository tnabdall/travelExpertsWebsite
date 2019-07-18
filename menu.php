<div id="navBarHead" class="ui stackable menu five item">


    <a class="item" href="index.php">Home</a>


    <a class="item" href="contact.php">Contact</a>


    <a class="item" href="register.php">Register Customer</a>


    <a class="item" href="links.php">Links</a>

    <?php
    // Shows login or logout on menu bar depending on session variable
    if(isset($_SESSION['login_user'])){
        echo "<a class='item' href='logout.php'>Logout ".$_SESSION['login_user'].  "</a>";
    }
    else{
        echo '<a class="item" href="login.php">Login</a>';
    }
    ?>

</div>