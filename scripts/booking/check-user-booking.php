<?php
    #adding view and editing booking data as user
    require_once("../../scripts/database-context/connectdb.php");
    $username = $_SESSION['user'];

    //database connection
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    //PL charset
    mysqli_set_charset($connection, "utf8mb4");

    //find all booking terms in database
    $query = "SELECT * FROM bookings WHERE username='$username' ORDER BY date ASC, hour DESC";
    $today = date('Y-m-d', time());

        if ($result = $connection->query($query))
        {
            $iterator = 0;
            while ($row = $result->fetch_assoc())
            {
                $id = $row["id"];
                $date = $row["date"];
                $hour = $row["hour"];
                $service = $row["service"];
                $iterator ++;
                
                //if date is not older than today
                if($date >= $today)
                {
                    echo
                    '<tr>
                        <td>'.$date.'</td>
                        <td>'.$hour.'</td>
                        <td>'.$service.'</td>
                        <td>'."<a href=../../scripts/booking/delete.php?id=" . $row['id'] . ">Odwołaj wizytę 🗑</a>".'</td>
                    </tr>';
                }
                else
                {
                    //not show result
                }
            }
            $result->free();

            //if user hasn't any booking terms 
            if($iterator == 0)
            {
                echo
                '<tr>
                    <td>'. "Brak zbliżającyh się wizyt" .'</td>
                </tr>';
            }
        }
        else
        {
            echo
            '<tr>
                <td>'. "Brak umówionych wizyt" .'</td>
            </tr>';
        }
?>