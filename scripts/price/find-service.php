<?php
    session_start();
    require_once("../../scripts/database-context/connectdb.php");

    //database connection
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    
    $errors = array();

    $id = $_GET["id"];

    //find service with id
    $service_query_check = "SELECT * FROM services WHERE id='$id' LIMIT 1";
    $result = mysqli_query($connection, $service_query_check);
    $service = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $service['description'];
    $_SESSION['price'] = $service['price'];
    $connection->close();           
?>
