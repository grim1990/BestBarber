<?php
    //render menu for admin/non admin user
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        echo '<a class="nav-item text-light nav-link" href="../user/index.php">WITAJ '.strtoupper($_SESSION["user"]).' !</a>
              <a class="nav-item text-light nav-link" href="../../scripts/user/logout.php">WYLOGUJ</a>';
    }
    else
    {
        echo '<a class="nav-item text-light nav-link" href="../user/login.php">LOGOWANIE</a>
              <a class="nav-item text-light nav-link" href="../user/register.php">REJESTRACJA</a>';
    }
        echo '<a class="nav-item nav-link" href="../home/about.php">O NAS</a>
              <a class="nav-item nav-link" href="../price/index.php">CENNIK</a>
              <a class="nav-item nav-link" href="../home/contact.php">KONTAKT</a>
              <a class="nav-item nav-link" href="../review/index.php">OPINIE</a>';

    if (isset($_SESSION['ADMIN']) && $_SESSION['ADMIN'] == true)
    {
        echo '<a class="nav-item nav-link" href="../booking/index.php">KALENDARZ&nbsp;WIZYT</a>';
    }
    else
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<a class="nav-item nav-link" href="../booking/index.php">UMÓW&nbsp;SIĘ&nbsp;NA&nbsp;WIZYTĘ</a>';
        }
        else
        {
            echo '<a class="nav-item nav-link" href="../user/login.php">UMÓW&nbsp;SIĘ&nbsp;NA&nbsp;WIZYTĘ</a>';
        }
    }
?>