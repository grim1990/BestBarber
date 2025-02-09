<?php

    session_start();
    require_once("../../scripts/database-context/connectdb.php");

    //database connection
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    
    $errors = array();

    //get data for placeholder
    $id=$_POST['id'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
 
    //find user from database 
    $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    //data validation
    if ($user) { // if user exists
        if ($user['email'] === $email) {
          array_push($errors, "Podany email jest już w bazie!");
        }
    }

    if (empty($email)) 
    { 
      array_push($errors, "Email jest wymagany");
    }
    if (empty($password_1)) 
    { 
      array_push($errors, "Hasło jest wymagane");
    }
    if ($password_1 != $password_2) 
    {
      array_push($errors, "Hasła nie są ze sobą zgodne");
    }
  
    if(count($errors) == 0)
    {
      //Finally, register user if there are no errors in the form
       unset($_SESSION['register-error']);
       $password = md5($password_1);//encrypt the password before saving in the database

       $query = "UPDATE user SET email = '$email', password = '$password' WHERE id='$id'";
       mysqli_query($connection, $query);
       $_SESSION['success'] = "Zmieniono dane konta!";
       header('location: logout.php');
    }
    else
    {
      $_SESSION['register-error'] = $errors;
      header('Location: ../../view/user/edit.php');
    }
    $connection->close();           
?>
