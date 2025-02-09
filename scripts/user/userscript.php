<?php
    session_start();
    require_once("../../scripts/database-context/connectdb.php");
    //connect to database
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");

    //connection error
    if ($connection->connect_error) {
        die("Błąd połączenia z bazą danych: " . $connection->connect_error);
    }

    //find username to create user-panel info about user
    $username =  $_SESSION['user'];
    $sql = "SELECT * FROM user WHERE login='$username' LIMIT 1";
    $result = $connection->query($sql);
    $user = mysqli_fetch_assoc($result);
    $datenow= date("Y-m-d");
    
    if (!$result) {
        die("Wystąpił błąd podczas wykonywania zapytania: " . $connection->error);
    }

    //database connection close;
    $connection->close();
?>
