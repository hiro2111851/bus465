<!-- 
    Page Name: Admin Payment Confirm Page

    Page Description: Displays the payments to be confirmed

    Created By: Oliver
-->

<?php
session_start();

// check login
include "./admin_check.php";

//handles database connection
include "../external/db_connect.php";

//adds a navbar
include "admin_nav.php";

// Form handler
    //if the e-transfer form submit button is pressed
    if(isset($_POST['submit_payment'])) {
        // check order total
        $sql = "
            SELECT SUM(quantity*price)
            FROM order_items
            WHERE order_id = ".$_POST['order'].";";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        $order_amount = $row[0];

        //if order total = e-transfer amount submitted
        if($order_amount == $_POST['amount']) {
            //create payment record 
            $sql = "
                INSERT INTO payments (order_id, sender_email, amount, date) 
                VALUES ('".$_POST['order']."', '".$_POST['sender_email']."', '".$_POST['amount']."', NOW());";

            mysqli_query($conn, $sql);
            
            //retrieve the payment id just created
            $payment = mysqli_insert_id($conn);

            // mark order as paid
            $sql = "
            UPDATE orders
            SET status = 'Payment Received'
            WHERE id = ".$_POST['order'].";";

            mysqli_query($conn, $sql);

            echo "<p>Payment Record ID: ".$payment." created. Order ID: ".$_POST['order']." marked as Payment Received </p>";
        } else {
            echo "<p>Payment amount does not match order amount</p>";
        };
    };
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="../css/bootstrap.css">
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
            <th scope="col">Order Date</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>

<!-- Loop through sql query to generate table content (payments) -->
    <?php
    $sql = "
        SELECT CONCAT(c.first_name,' ',c.last_name) AS 'name', o.id, o.date, SUM(oi.quantity*oi.price) as 'amount', o.status
        FROM orders o
        INNER JOIN order_items oi
        ON o.id = oi.order_id
        INNER JOIN customers c
        ON o.customer_id = c.id
        GROUP BY o.id
        ORDER BY o.status DESC, o.date;
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

<h3>E-Transfer</h3>

<!-- Form sends it to itself -->
<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' METHOD='POST'>
    <label for='order'>Select Order</label>
    <select name='order'>
        <?php 
        $sql = "SELECT o.id, CONCAT(c.first_name, ' ', c.last_name) as customer_name
                FROM orders o
                JOIN customers c
                ON o.customer_id = c.id
                WHERE o.status = 'Pending Payment';";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
            echo "<option value='".$row['id']."'>Order ID:".$row['id']." for ".$row['customer_name']."</option>";
        };
        ?>
        
    </select>

    <label for='amount'>Amount</label>
    <input type='number' step=".01" name='amount' required>

    <label for='amount'>Sender Email</label>
    <input type='text' name='sender_email' required>

    <button type='submit' name='submit_payment'>Mark Payment</button>
</form>
</body>

</html>

