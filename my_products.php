<!-- 
    Page Name:My Products Page

    Page Description: Admin page for store owners to add and/or remove products

    Created By: Hiro
-->
<?php
session_start();

//handles database connection
include "db_connect.php";

//handles adding product and product image upload
include "add_product.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>My Products</title>
</head>

<body>
<div class="container">

<!-- Products table -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "SELECT id, name, price, CONCAT(LEFT(description, 100), '...') as short_desc, img_link FROM products;";

            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "
                    <tr>
                        <td>".$row['id']."</td>
                        <td class='w-25'><img class='w-50' src='".$row['img_link']."'></td>
                        <td>".$row['name']."</td>
                        <td>".$row['price']."</td>
                        <td>".$row['short_desc']."</td>
                    </tr>";
            };
        ?>
    </tbody>
</table>

<div class="product_form">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
<h4>Add a Product</h4>

<div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="form-group">
    <label for="price">Price</label>
    <input type="number" min="1" step="any" name="price" class="form-control" required>
</div>

<div class="form-group">
    <label for="description">Product Description</label>
    <input type="textarea" name="description" rows="5" class="form-control" required>
</div>

<p>Product Image</p>
<div class="custom-file mb-3">
    <input type="file" name="image" class="custom-file-input">
    <label class="custom-file-label" for="image">Choose image file</label>
</div>

<button type="submit" name="submit_product" class="btn btn-primary">Add Batch</button>

</form>
</div>

</div>
</body>

</html>

<?php 
// close database connection
mysqli_close($conn); 
?>