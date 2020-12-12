<?php 
// handles database connection
include "db_connect.php";

// retrieve batch and product ID via GET 
$batch = $_GET['batch'];

$stmt = $conn->prepare("SELECT max_quantity-quantity_sold as qty FROM batch_items WHERE id = ?");
$stmt->bind_param("i", $_GET['batch']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($quantity);

while ($stmt->fetch()) {
    echo $quantity;
}

$stmt->close();

