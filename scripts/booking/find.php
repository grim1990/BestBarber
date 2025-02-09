<?php
    session_start();
    require_once("../../scripts/database-context/connectdb.php");

    //connect database
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    
    $errors = array();

    $id = $_GET["id"];

    //find all existing booking terms from database
    $booking_query_check = "SELECT * FROM bookings WHERE id='$id' ";
    $result = mysqli_query($connection, $booking_query_check);
    $booking = mysqli_fetch_assoc($result);
    $_SESSION['date'] = $booking['date'];
    $_SESSION['hour'] = $booking['hour'];
    $_SESSION['service'] = $booking['service'];

    //get service description for booking change by admin to use in admin input
    $service_upload_query = "SELECT description from services";
    $result_service = mysqli_query($connection, $service_upload_query);

    $connection->close();
?>
