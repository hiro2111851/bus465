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
    $sql = "SELECT id, name, price, description FROM products;";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "
            <div class='col mb-4'>
                <div class='card h-100'>
                    <img class='card-img-top' src='img/placeholder.png'>
                    <div class='card-body'>
                        <h5 class'card-title'>".$row['name']."</h5>
                        <p class='card-text'>".$row['description']."</p>
                    </div>
                    <div class='card-footer'>
                    $".$row['price'].
                    "</div>
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