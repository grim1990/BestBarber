<?php

    session_start();
    require_once("../../scripts/database-context/connectdb.php");
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        header('Location: ../register.php');
        exit();
    }

    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    $errors = array();

    $username = $_POST['login'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    //find all user to check if user exist in database
    $user_check_query = "SELECT * FROM user WHERE login='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    

    if (empty($username)) 
    { 
      array_push($errors, "Musisz podać login użytkownika!");
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
    //form validation
    if ($user!=null) { // if user exists
        if ($user['login'] === $username) {
          array_push($errors, "Użytkownik o podanej nazwie już istnieje!");
        }

        if ($user['email'] === $email) {
          array_push($errors, "Podany email jest już w bazie!");
        }
    }

    if(count($errors) == 0)
    {
      //Finally, register user if there are no errors in the form
       unset($_SESSION['register-error']);
       $password = md5($password_1);//encrypt the password before saving in the database

       $query = "INSERT INTO user (login, email, password)
               VALUES('$username', '$email', '$password')";
       mysqli_query($connection, $query);
       $_SESSION['login'] = $username;
       $_SESSION['success'] = "Zalogowano!";
       $_SESSION['login'] = $username;
       $_SESSION['success'] = "Zalogowano!";
       header('location: ../index.php');
       $to_email = $email;
       $subject = 'Rejestracja konta w salonie BestBarber';
       // $message = "Jest to mail o rezerwacji dnia {$date} o godzinie {$hour} {$service_name}";
       $htmlContent = ' 
       <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
       <html lang="en">
       <head>
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
           <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
           <meta name="viewport" content="width=device-width,initial-scale=1.0">
           
           <style type="text/css">
               body{
 
                   margin: 0;
                   padding: 0;
               }
               a{
                 text-decoration:none
               }
               table{
 
                   border-spacing: 0;
               }
               td{
                   padding: 0;
               }
               img{
 
                   border: 0;
               }
               .top{
                 background-color:#29231e;
                 padding:10px;
                 text-align:center;
               }
               .bot{
                 background-color:#29231e;
                 padding:10px;
                 text-align:left;
                 width:50%;
 
               }
               .wrapper{
                   width: 100%;
                   table-layout: fixed;
                   background-color:bisque;
                   padding: 5px 10px 5px 10px;
 
               }
               .outer{
                   margin: 0 auto;
                   width: 100%;
                   max-width: 600px;
                   border-spacing: 0;
                   background-color: #edcfb2;
               }
               .button{
                   text-align: center;
                   font-size: 140%;
                   background-color: #29231e;
                   color: #edcfb2 !important;
                   cursor: pointer;
                   padding:10px;
               }
               @media screen and (max-width:600px){
                 img.top{
                         width:200px !important;
                         max-width: 200px !important;
                         } 
                 img.bot{
                         width:60px !important;
                         max-width: 60px !important;
                 }
 
               }
               @media screen and (max-width:400px){
                 img.top{
                         width:200px !important;
                         max-width: 200px !important;
                         } 
                 img.bot{
                         width:60px !important;
                         max-width: 60px !important;
                 }
               }
 
           </style>
       </head>
       
       <body> 
           <center class="wrapper">
               
               <table class="outer" align="center">
                   <tr>
                       <td>
                           <table width="100%" style="border-spacing: 0;">
                               <tr>
                                   <td class="top">
                                       <a style="color:#edcfb2;" href="http://bestbarber.cba.pl"><img src="http://www.bestbarber.cba.pl/img/logo1biel.png" 
                                           width="180" alt="BestBarber logo"></a>
                                           
                                   </td>
                               </tr>
                           </table>
 
                       </td>
 
 
                   </tr>
                   <tr>
                       <td style="text-align:center;">
                           <p style="font-size: 35px;font-weight:bold; padding-top:20px;">Dziękujemy za założenie konta</p>
                           <p style="font-size: 23px; padding:5px 20px 5px 30px;">Swojej pierwszej rezerwacji możesz dokonać wybierając "Umów wizyte"</p>
                           <a  href="http://bestbarber.cba.pl/login.php">
                               <button style="margin-bottom:10px ;" class="button">Zapraszamy</button>
                           </a><br>
                           <p style="font-size:11px; text-align:center; margin-bottom:3px;">Jeśli nie powinienes dostać tego maila napisz nam o tym :)</p>
                           <a href="mailto:BestBarber@gmail.com"/>
                             <button class="button" style="font-size:10px; margin-bottom:10px;  padding: 3px;">Napisz wiadomość</button>
                       
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <table width="100%" style="border-spacing: 0;">
                               <tr >
                                   <td class="bot">
                                       <a href="http://bestbarber.cba.pl"><img src="http://bestbarber.cba.pl/img/logo2biel.png" 
                                           width="60" alt="BestBarber logo"></a>
                                           
                                   </td>
                                   
                                   <td style="background-color:#29231e;text-align:right; width:50%">
                                       <pre style="padding:3px 3px 3px 3px ; color:#edcfb2; font-size:10px;">
                                           BestBarber
                                           ul.Ratajczaka 21
                                           Poznań 61-051
                                           nr 111 222 333
                                       </pre>
                                           
                                   </td>
                               </tr>
                               
                           </table>
 
                       </td>
 
 
                   </tr>
                   
               </table>
               
           </center>
           
           
           
       </body> 
 
       </html>'; 
       $headers = 'From: bestbarber@bestbarber.cba.pl';
       $headers .= "  MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
       mail($to_email,$subject,$htmlContent,$headers);
       header('location: ../../view/home/index.php');
    }
    else
    {
      $_SESSION['register-error'] = $errors;
      header('Location: ../../view/user/register.php');
    }
?>
