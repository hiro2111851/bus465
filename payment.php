<!-- 
    Page Name: Admin Payment Confirm Page

    Page Description: Displays the payments to be confirmed

    Created By: Oliver
-->

<?php
session_start();

//handles database connection
include "db_connect.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Payment Confirmations</title>
</head>

<body>
<div class="container">

<!-- List of payments -->
<h3> Payments </h3>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Order ID</th>
            <th scope="col">Delivery Date</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>

<!-- Loop through sql query to generate table content (payments) -->
    <?php
    $sql = "
        SELECT CONCAT(c.first_name,' ',c.last_name) AS 'Name', o.id, o.date, SUM(oi.quantity*oi.price) as 'Order Total', o.status
        FROM orders o
        INNER JOIN order_items oi
        ON o.id = oi.order_id
        INNER JOIN customers c
        ON o.customer_id = c.id
        GROUP BY o.id
        ORDER BY o.date;
        ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "
            <tr>
                <td>".$row['name']."</td>
                <td>".$row['id']."</td>
                <td>".$row['date']."</td>
                <td>".$row['amount']."</td>
                <td>".$row['status']."</td>
            </tr>";
    };
?>
    </tbody>
</table>

</body>

</html>

