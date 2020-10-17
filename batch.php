<!-- 
    Page Name: Batch Detail Page

    Page Description: Displays detail within batch. 
    This page will be accessed from a http GET request with a batch_id in the URL.


    Created By: Hiro
-->
<?php
session_start();

$batch_id = $_GET['batch_id'];

//handles database connection
include "db_connect.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title></title>
</head>

<body>

<div class="container">

<!-- List of existing batches -->
<h3> Items in Batch </h3>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Batch Quantity</th>
            <th scope="col">Quantity Ordered</th>
        </tr>
    </thead>
    <tbody>

<!-- Loop through sql query to generate table content (batches) -->
<?php
$sql = "
    SELECT p.name, b.max_quantity, b.quantity_sold
    FROM batch_items b
    INNER JOIN products p
    ON b.product_id = p.id
    WHERE b.batch_id = ".$batch_id.
    " ORDER BY b.max_quantity DESC;
    ";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo 
        "<tr scope='row'> 
            <td>".$row['name']."</td>
            <td>".$row['max_quantity']."</td>
            <td>".$row['quantity_sold']."</td>
        </tr>";
};
?>

    </tbody>
</table>

</div>
</body>

</html>