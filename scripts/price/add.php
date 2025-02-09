<?php
    session_start();
    require_once("../../scripts/database-context/connectdb.php");

    //database connection
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    
    $errors = array();

    $description = $_POST['description'];
    $price = $_POST['price'];

    //find all services from database
    $service_query_check = "SELECT * FROM services WHERE description='$description' LIMIT 1";
    $result = mysqli_query($connection, $service_query_check);
    $service = mysqli_fetch_assoc($result);

    if ($service) { // if service exists
        if ($service['description'] === $description) {
          array_push($errors, "Usługa o podanej nazwie już istnieje!");
        }
    }

    if (empty($description)) 
    { 
      array_push($errors, "Musisz podać nazwę usługi!");
    }
    if (empty($price)) 
    { 
      array_push($errors, "Musisz podać cenę usługi!");
    }
  
    if(count($errors) == 0)
    {
      //Finally, adding new service to database
       unset($_SESSION['service-error']);
       $query = "INSERT INTO services (description, price)
               VALUES('$description', '$price')";
       mysqli_query($connection, $query);
       $_SESSION['success'] = "Dodano usługę!";
       header('location: ../../view/price/index.php');
    }
    else
    {
      $_SESSION['service-error'] = $errors;
      header('Location: ../../view/price/add.php');
    }
?>
