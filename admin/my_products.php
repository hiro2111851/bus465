<!-- 
    Page Name:My Products Page

    Page Description: Admin page for store owners to add and/or remove products

    Created By: Hiro
-->
<?php
session_start();

// check login
include "./admin_check.php";

//handles database connection
include "../external/db_connect.php";

//handles adding product and product image upload
include "../external/add_product.php";

//handles removing products
include "../external/remove_product.php";

//adds a navbar
include "admin_nav.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
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
            <th colspan="2" scope="col">Description</th>
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
                        <td class='w-25'><img class='w-50' src='../".$row['img_link']."'></td>
                        <td>".$row['name']."</td>
                        <td>".$row['price']."</td>
                        <td>".$row['short_desc']."</td>
                        <td>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST'>
                                <input type='hidden' name='product_id' value='".$row['id']."'>
                                <input type='hidden' name='name' value='".$row['name']."'>
                                <input type='hidden' name='img_link' value='".$row['img_link']."'>
                                <button type='submit' name='remove_product' class='btn btn-danger'>Remove</button>
                            </form>
                        </td>
                    </tr>";
            };
        ?>
    </tbody>
</table>

<div class="product_form">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
<h4>Add a Product</h4>

<div class="form-row">
    <div class="form-group col-7">
        <label for="name">Product Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group col">
        <label for="price">Price</label>
        <input type="number" min="1" step="any" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="image">Product Image</label><br>
        <input type="file" name="image" id="image">
    </div>
</div>

    <div class="form-group">
        <label for="description">Product Description</label>
        <textarea name="description" rows="5" class="form-control" required></textarea>
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