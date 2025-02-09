<?php
    //checking available terms in database
    require_once("../../scripts/database-context/connectdb.php");
    //database connection
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    
    $errors = array();

    if(isset($_POST['date']))
    {
        $date = $_POST['date'];
    }
    else
    {
        $date = $_SESSION['date'];
    }
    
    //find all booking terms from database
    $service_query_check = "SELECT * FROM services";
    $service = mysqli_query($connection, $service_query_check);
    $services = [];
    while($row = mysqli_fetch_array($service))
    {
        $services[] = $row;
    }

    // form validation
    $sql = "SELECT * FROM bookings WHERE date='$date'";
    $result = $connection->query($sql);
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        $rows[] = $row;
    }

    //available terms - all options
    $hours_pattern = array('10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'); 
    $hours = array('10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'); 

    //find available terms
    foreach($rows as $x)
    {
        foreach($hours as $hour)
        {
            if (($key = array_search($x['hour'], $hours)) !== false) {
                $hours[$key] = 0;
            }
        }
    }
    
    $connection->close();           
?>
