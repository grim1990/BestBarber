<?php
require('index.php');

if (!isset($_SESSION['ADMIN']))
    {
        exit();
    }
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
    <div class="absolute__window">
        <div class="operation__window">
            <div class="window__frame">
                <div class="settings">
                    <h1 class="header mt-5 mb-4">
                        DODAJ USŁUGĘ
                    </h1>
                </div>
                <div class="button-corner">
                    <button class="small__button" onclick="window.location='index.php';">✕</button>
                </div>
                <form class="user__forms" action="../../scripts/price/add.php" method="post">
                    <div class="settings__fields">
                        Nazwa: <input class="input__fields" type="text" name="description" maxlength="250">
                    </div>
                    <div class="settings__fields">
                        Cena: <input class="input__fields" type="number" name="price" min="1">
                    </div>
                    <div class="settings__fields">
                        <?php if (isset($_SESSION['service-error'])) {
                            foreach ($_SESSION['service-error'] as $error) {
                                echo $error;
                                break;
                            }
                        }
                        ?>
                    </div>
                    <div class="settings__fields">
                        <div class="header mt-4">
                            <input class="button__regular" type="submit" value="Dodaj">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['service-error']) ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>