<?php
    session_start();
    require_once("../../scripts/database-context/connectdb.php");
    require('../../scripts/user/userscript.php');

    //connect to database
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");
    $errors = array();

    if(!$connection)
    {
        error_reporting(0);
        echo "Błąd połączenia z bazą danych";
    }
    else
    {
      //get data from user form
      $date = $_POST['date'];
      $hour = $_POST['hour'];
      $service_name = $_POST['service'];
      $username =  $_SESSION['user'];

      //Validation of data
      if(empty($service_name))
      {
        array_push($errors, "Musisz wybrać rodzaj usługi!");
      }

      if(count($errors) == 0)
      {
        //Finally, adding the booking to database
        unset($_SESSION['service-error']);
        $query = "INSERT INTO bookings (date, hour, service, username)
        VALUES('$date', '$hour', '$service_name', '$username')";
        mysqli_query($connection, $query);
        $_SESSION['success'] = "Zarezerwowano termin!";
        $_SESSION['date'] = $date;
        header('location: ../../view/booking/add.php?date=' . "'$date'");
        $to_email = $user['email'];
        $subject = 'Rezerwacja w salonie BestBarber';
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
                            <p style="font-size: 35px;font-weight:bold; padding-top:30px;">Dziękujemy za złożenie rezerwacji w naszym salonie</p>
                            <p style="font-size: 23px; padding:5px 30px 5px 30px;">Więcej informacji odnośnie rezerwacji uzyskasz w zakładce "Moje Konto"</p>
                            <a  href="http://bestbarber.cba.pl/login.php">
                                <button style="margin-bottom:10px ;" class="button">Zapraszamy</button>
                            </a><br>
                            <p style="font-size:11px; text-align:center; margin-bottom:3px;">Jeśli nie umawiałeś wizyty w naszym salonie,<br>mimo to dostałeś wiadomość napisz nam o tym :)</p>
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
      }
      else
      {
        $_SESSION['edit-service-error'] = $errors;
        header('Location: ../../view/booking/index.php');
      }
      $connection->close();
    }
?>
