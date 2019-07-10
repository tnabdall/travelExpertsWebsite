<div id="navBarHead" class="container-fluid">
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php">Register Customer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="links.php">Links</a>
        </li>
        <?php
        // Shows login or logout on menu bar depending on session variable
        if(isset($_SESSION['login_user'])){
            echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout ".$_SESSION['login_user'].  "</a></li>";
        }
        else{
            echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
        }
        ?>
    </ul>
</div>