<?php 
// handles database connection
include "db_connect.php";

$stmt = $conn->prepare("SELECT max_quantity-quantity_sold as qty FROM batch_items WHERE id = ?"); //prepare statement
$stmt->bind_param("i", $_GET['batch']); //bind parameter
$stmt->execute(); //execute
$stmt->store_result(); //store query result
$stmt->bind_result($quantity); //bind query result to variable
$stmt->fetch(); //fetch query result
echo $quantity; //echo variable
$stmt->close(); //close statement
?>
