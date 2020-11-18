<?php 
session_start();
// handles database connection
include "db_connect.php";


$sql = "SELECT first_name, last_name, email, phone, street_1, street_2, city, state, zip_code, country
        FROM customers 
        WHERE id = ".$_SESSION['customer_id'].";";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_row($result);

echo $row[0]."_".$row[1]."_".$row[2]."_".$row[3]."_".$row[4]."_".$row[5]."_".$row[6]."_".$row[7]."_".$row[8]."_".$row[9];
