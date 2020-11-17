<!-- 
    Page Name: PHP file for Batch Quantity Query

    Page Description:

    Created By: Hiro
-->

<?php 
// handles database connection
include "db_connect.php";

// retrieve batch and product ID via GET 
$batch = $_GET['batch'];

$sql = "SELECT max_quantity-quantity_sold as qty 
        FROM batch_items 
        WHERE id = ".$batch;

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_row($result);

echo $row[0];

