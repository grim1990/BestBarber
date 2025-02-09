<?php
    //render view for admin/non admin user
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        echo '<a class="nav-item text-light nav-link" href="../user/index.php">WITAJ&nbsp;'.strtoupper($_SESSION["user"]).'&nbsp!</a>';
        echo '<a class="nav-item text-light nav-link" href="../../scripts/user/logout.php">WYLOGUJ</a>';
    }
    else
    {
        echo '<a class="nav-item menu-login text-light nav-link" href="../user/login.php">LOGOWANIE</a>';
        echo '<a class="nav-item menu-login text-light nav-link" href="../user/register.php">REJESTRACJA</a>';
    }
?>