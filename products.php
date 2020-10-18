<!-- 
    Page Name: Products Page

    Page Description: Displays all products 

    Created By: Hiro
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
    <title>Products</title>
</head>

<body>
<div class="container">

<!-- Product cards -->
<div class="row row-cols-1 row-cols-md-3">
<?php
    $sql = "SELECT id, name, price, description, img_link FROM products;";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "
            <div class='col mb-4'>
                <div class='card h-100'>
                    <img class='card-img-top' src='".$row['img_link']."'>
                    <div class='card-body'>
                        <h5 class'card-title mb-2'>".$row['name']."</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>$".$row['price']."</h6>
                        <p class='card-text'>".$row['description']."</p>
                    </div>
                    <div class='card-footer'>";

        // Generate dropdown menu for available batch
        $query = "
            SELECT b.id, DATE_FORMAT(b.delivery_date, '%W, %M %D') as batch_name, bi.max_quantity, bi.quantity_sold 
            FROM batch_items bi 
            JOIN batches b 
            ON b.id = bi.batch_id
            WHERE product_id = ".$row['id'].";";
        
        $out = mysqli_query($conn, $query);

        if (mysqli_num_rows($out)==0) {
            echo "
                <label for='batch'>Select Batch: </label>
                <select name='batch' disabled>
                <option> Product Not Available </option>
                </select>
            ";
        } else {
            echo "
                <label for='batch'>Select Batch: </label>
                <select name='batch'>
            ";

            while ($batch = mysqli_fetch_array($out, MYSQLI_ASSOC)) {
                echo "<option value='".$batch['id']."'>".$batch['batch_name']."</option>";
            };

            echo "</select>";
        };

        echo "
                    </div>
                </div>
            </div>";
    };
?>
</div>

</div>
</body>

</html>

<?php 
// close database connection
mysqli_close($conn); 
?>