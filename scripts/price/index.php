<?php
    require_once("../../scripts/database-context/connectdb.php");

    //connect to database
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");

    //connection error
    if ($connection->connect_error) {
        die("Błąd połączenia z bazą danych: " . $connection->connect_error);
    }
    //find all services from database
    $sql = "SELECT * FROM services";
    $result = $connection->query($sql);

    if (!$result) {
        die("Wystąpił błąd podczas wykonywania zapytania: " . $connection->error);
    }

    //database connection close;
    $connection->close();
?>
