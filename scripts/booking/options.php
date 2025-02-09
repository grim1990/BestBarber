<?php

require_once("../../scripts/database-context/connectdb.php");

//database connection
$connection = new mysqli($host,$db_user,$db_password,$db_name);    
//PL charset
mysqli_set_charset($connection, "utf8mb4");

//find all names of services in database to use in dropdown list in user form
$service_upload_query = "SELECT description from services";
$result = mysqli_query($connection, $service_upload_query);
$errors = array();
$date= $_POST['date'];

//find all booking terms in database 
$booking_upload_query = "SELECT * FROM bookings where date='$date'";
$result_bookings = mysqli_query($connection, $booking_upload_query);
header('location: ../../view/booking/index.php');

$connection->close();
?>
