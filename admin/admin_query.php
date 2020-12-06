<!-- 
    Page Name: Admin Queries

    Page Description: Queries for admin home dashboard

    Created By: Oliver
-->

<?php
//handles database connection
include "../external/db_connect.php";

//query for Dollar Value of Orders chart
$delivdate = '';
$dollaramt = '';

$sql1 = "SELECT b.delivery_date as Dates, SUM(oi.quantity*oi.price) as Dollars
FROM batches b, batch_items bi, order_items oi 
WHERE b.id = bi.batch_id AND bi.id = oi.batch_item_id
GROUP BY b.delivery_date
ORDER BY b.delivery_date ASC
LIMIT 10";

$result1 = mysqli_query($conn, $sql1);

//loop through returned data
while ($row = mysqli_fetch_array($result1)) {

    $delivdate = $delivdate . '"' . $row['Dates'].'",';
    $dollaramt = $dollaramt . '"' . $row['Dollars'].'",';
}

//trim results
$delivdate = trim($delivdate,",");
$dollaramt = trim($dollaramt,",");


//query for Quantity Fulfilled (Last 30 Days)
$prodname = '';
$maxquantity = '';
$soldquantity = '';

$sql2 = "SELECT p.name as Products, SUM(bi.max_quantity) as Maximum, SUM(bi.quantity_sold) as Sold
FROM batch_items bi, products p, batches b
WHERE bi.product_id = p.id 
AND bi.batch_id = b.id 
AND b.delivery_date >= DATE_ADD(NOW(), INTERVAL -30 DAY) 
AND b.delivery_date <= NOW()
GROUP BY p.name
ORDER BY Maximum, Products, Sold DESC";

$result2 = mysqli_query($conn, $sql2);

//loop through returned data
while ($row = mysqli_fetch_array($result2)) {

    $prodname = $prodname . '"' . $row['Products'].'",';
    $maxquantity = $maxquantity . '"' . $row['Maximum'].'",';
    $soldquantity = $soldquantity . '"' . $row['Sold'].'",';
}

//trim results
$prodname = trim($prodname,",");
$maxquantity = trim($maxquantity,",");
$soldquantity = trim($soldquantity,",");


//query for Current Batches filled
$sql3 = "SELECT b.id as 'Batch Number', p.name as 'Product', bi.max_quantity as 'Max. Quantity', bi.quantity_sold as 'Sold'
FROM batch_items bi, batches b, products p 
WHERE bi.batch_id = b.id AND bi.product_id = p.name
AND b.delivery_date >= NOW()
ORDER BY b.delivery_date DESC";

$result3 = mysqli_query($conn, $sql3);
?>

