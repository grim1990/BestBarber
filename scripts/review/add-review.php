<?php

    session_start();
    require_once("../../scripts/database-context/connectdb.php");

    //database connection
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    
    $errors = array();

    $name = $_SESSION['user'];
    $rating = $_POST['rating'];
    $content = $_POST['content'];

    if(!$connection)
    {
        error_reporting(0);
        echo "Błąd połączenia z bazą danych";
    }
    else
    {
      //find user name of review from database in case when user added review in past 
      $user_check_query = "SELECT name FROM reviews WHERE name='$name' LIMIT 1";
      $result = mysqli_query($connection, $user_check_query);
      $user = mysqli_fetch_assoc($result);
  
      if ($user['name'] === $name) {
        array_push($errors, "Użytkownik o podanej nazwie dodał już opinię!");
      }

      if (empty($rating)) 
      { 
        array_push($errors, "Musisz podać ocenę!");
      }
      if (empty($rating)) 
      { 
        array_push($errors, "Musisz podać treść opinii");
      }
    
      if(count($errors) == 0)
      {
        //Finally, add review
         unset($_SESSION['add-review-error']);
         $query = "INSERT INTO reviews (name, content, rating)
                 VALUES('$name', '$content', '$rating')";
         mysqli_query($connection, $query);
         $_SESSION['success'] = "Dodano opinię!";
         header('location: ../../view/review/index.php');
      }
      else
      {
        $_SESSION['add-review-error'] = $errors;
        header('Location: ../../view/review/add.php');
      }
    }