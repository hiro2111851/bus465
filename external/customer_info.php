<?php 
session_start();
// handles database connection
include "db_connect.php";

$stmt = $conn->prepare(
        "SELECT first_name, last_name, email, phone, street_1, street_2, city, state, zip_code, country
        FROM customers 
        WHERE id = ?;");

$stmt->bind_param("i", $_SESSION['customer_id']);

$stmt->execute();
$stmt->store_result();
$stmt->bind_result($fname, $lname, $email, $phone, $st1, $st2, $city, $state, $zip, $country);

while ($stmt->fetch()){
        echo $fname."_".$lname."_".$email."_".$phone."_".$st1."_".$st2."_".$city."_".$state."_".$zip."_".$country;
};

$stmt->close();

