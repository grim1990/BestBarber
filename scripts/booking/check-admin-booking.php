<?php
//pagination script
require_once("../../scripts/database-context/connectdb.php");

/* get page number
$page = 1; /* default is page 1 */
if(isset($_GET['page']) && $_GET['page'] !== "")
{
    $page_no = $_GET['page'];
}
else
{
    $page_no = 1;
}

$date =  date("Y-m-d");

$username = $_SESSION['user'];
//database connection
$connection = new mysqli($host, $db_user, $db_password, $db_name);
//PL charset
mysqli_set_charset($connection, "utf8mb4");

//limit records
$total_records_per_page = 5;

//page offset for LIMIT query
$offset = ($page_no -1) * $total_records_per_page;

//get previous page
$previous_page = $page_no - 1;

//get the next page
$next_page = $page_no + 1;

//get the total count of records
$result_count = mysqli_query($connection, "SELECT COUNT(*) as total_records from bookings");

//total records
$records = mysqli_fetch_array($result_count);

//store total_records to a variable
$total_records = $records['total_records']; 

//get total pages
$total_no_of_pages = ceil($total_records/$total_records_per_page);

$query = "SELECT * FROM bookings WHERE date >= '$date' ORDER BY date ASC, hour ASC LIMIT $offset , $total_records_per_page";
$result = mysqli_query($connection, $query);
//fetch all booking terms to array

        if ($result = $connection->query($query))
        {
            while ($row = $result->fetch_assoc())
            {
                $id = $row["id"];
                $date = $row["date"];
                $hour = $row["hour"];
                $service = $row["service"];
                $username1 = $row["username"];
                
                //display data in booking panel in administrator mode
                echo
                '<tr>
                    <td>'.$date.'</td>
                    <td>'.$hour.'</td>
                    <td class="mobile-table">'.$service.'</td>
                    <td class="mobile-table">'.$username1.'</td>
                    <td>'."<a href=../../scripts/booking/delete.php?id=" . $row['id'] . ">🗑</a>".'</td>
                    <td>'."<a href=edit.php?id=" . $row['id'] . ">🖉</a>".'</td>
                </tr>';
            }
            mysqli_close($connection);
            $result->free();
        }
        else
        {
            echo '<tr> Brak wizyt </tr>';
        }
?>