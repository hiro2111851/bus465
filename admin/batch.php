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
include "../external/db_connect.php";

//form handler
include "../external/form_handler.php";

//adds a navbar
include "admin_nav.php"
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Batch Detail: <?php echo $batch_id; ?></title>
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
$stmt = $conn->prepare(
    "SELECT p.name, b.max_quantity, b.quantity_sold
    FROM batch_items b
    INNER JOIN products p
    ON b.product_id = p.id
    WHERE b.batch_id = ?
    ORDER BY b.max_quantity DESC;"
);

$stmt->bind_param("i", $batch_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name ,$max_quantity, $quantity_sold);

while ($stmt->fetch()){
    echo 
        "<tr scope='row'> 
            <td>".$name."</td>
            <td>".$max_quantity."</td>
            <td>".$quantity_sold."</td>
        </tr>";
};

$stmt->close();
?>

    </tbody>
</table>

<!-- Form to add batch item to batch -->
<div class="batch_item_form container mt-5">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?batch_id=".$batch_id;?>" method="POST">
    <div class="form-row">

        <div class="col">
            <label for="product">Product</label>
        </div>

        <div class="col">
            <select name="product_id" class="custom-select">>
                <?php
                // populate dropdown list based on active products
                    $sql = "
                        SELECT id, name
                        FROM products
                        WHERE active = 1;
                        ";

                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    };
                ?>
            </select>
        </div>

        <div class="col">
            <label for="max_quantity">Max Quantity</label>
        </div>

        <div class="col">
            <input type="number" min="0" max="99" name="max_quantity" class="form-control" required>
        </div>

        <!-- Hidden Input -->
        <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">

        <div class="col">
            <button type="submit" name="submit_batch_item" class="btn btn-primary">Add Batch Item</button>
        </div>

    </div>
</form>
</div>

</div>
</body>

</html>

<?php 
// close database connection
mysqli_close($conn); 
?>