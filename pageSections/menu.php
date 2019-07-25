<div id="desktopNavBar" class="ui stackable menu five item">
    <a class="item" href="index.php"><i class='home icon'></i> Home</a>
    <a class="item" href="contact.php"><i class='address card icon'></i> Contact</a>
    <a class="item" href="customerRegister.php"> <i class='user plus icon'></i> Create Profile</a>
    <?php
    // Shows login or logout on menu bar depending on session variable
    if(isset($_SESSION['login_user'])){
        echo "<a class='item' href='phpFunctions/logout.php'><i class='sign out icon' ></i> Logout ".$_SESSION['login_user'].  "</a>";
    }
    else{
        echo '<a class="item" href="login.php"><i class="sign in icon" ></i> Login</a>';
    }
    ?>
</div>
<div id="mobileNavBar">
    <div id="menuButton" class="ui inverted top attached demo menu">
        <a class="item">
            <i class="sidebar icon"></i>
            Menu
        </a>
    </div>
    <div class="ui bottom attached segment pushable">
        <div id="sidebar" class="ui inverted labeled icon left inline vertical sidebar menu" style="">
            <a class="item" href="index.php"><i class='home icon'></i> Home</a>
            <a class="item" href="contact.php"><i class='address card icon'></i> Contact</a>
            <a class="item" href="customerRegister.php"> <i class='user plus icon'></i> Create Profile</a>
            <?php
    // Shows login or logout on menu bar depending on session variable
    if(isset($_SESSION['login_user'])){
        echo "<a class='item' href='phpFunctions/logout.php'><i class='sign out icon' ></i> Logout ".$_SESSION['login_user'].  "</a>";
    }
    else{
        echo '<a class="item" href="login.php"><i class="sign in icon" ></i> Login</a>';
    }
    ?>
        </div>
    </div>
</div>