<?php
require('../../scripts/user/userscript.php');
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestBarber</title>
    <link rel="stylesheet" href="../../styles/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<div class="menu__top">
        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <div class="left__menu">
                        <a href="../home/index.php"><img class="logo" src="../../img/logo2biel.png" alt="BestBarber logo barber Poznań"></a>
                        <a class="nav-item nav-link" href="../home/about.php">O NAS</a>
                        <a class="nav-item nav-link" href="../price/index.php">CENNIK</a>
                        <a class="nav-item nav-link" href="../home/contact.php">KONTAKT</a>
                        <a class="nav-item nav-link" href="../review/index.php">OPINIE</a>
                        <?php include '../../scripts/view-model/check-admin-script.php'; ?>
                    </div>
                    <div class="right__menu">
                        <?php include '../../scripts/view-model/check-login-script.php'; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- mobile version -->
    <div class="menu__top__mobile">
        <div class="menu__container">
            <a href="../home/index.php"><img class="logo" src="../../img/logo2biel.png" alt="BestBarber logo barber Poznań"></a>
            <nav class="navbar navbar-dark m-4">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="menu__collapse">
                    <?php include '../../scripts/view-model/menu-collapse-script.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="subpage__content">
        <div class="content__frame">
            <h1 class="header">
                PANEL UŻYTKOWNIKA
            </h1>
            <div class="holder">
                <div class="half__side">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="4">Dane konta:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Login:</td>
                                <td class="table__end__simple"><?php echo $user['login']; ?></td>
                            </tr>
                            <tr>
                                <td>e-mail:</td>
                                <td class="table__end__simple"><?php echo $user['email']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
                        <a href="../../scripts/user/edit.php">
                            <div class="button__field__xxl">
                                <p1 class="button__text__table p-1">Zmień dane konta</p1>
                            </div>
                        </a>
                    <?php } ?>
                    <?php if (!isset($_SESSION['ADMIN'])) { ?>
                    <h1 class="header mt-5">
                        ZBLIŻAJACE SIĘ WIZYTY
                    </h1>
                    <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4">Twoje rezerwacje:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include '../../scripts/booking/check-user-booking.php'; ?>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
                <div class="half__side">
                    <img class="price" src="../../img/14.png" alt="Zdjęcie narzędzi barbeera">
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <img class="logo__footer" src="../../img/logo1biel.png" alt="BestBarber logo barber Poznań">
        <div class="footer__text">
            Copyright©2022 BestBarber
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>