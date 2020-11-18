<!-- 
    Page Name: Mainpage

    Page Description: The Mainpage of the website; has the products, 

    Created By: Abbey
-->
<!doctype html>

<?php
session_start();
//session_destroy();

// Need to track and adjust tax rates elsewhere
$tax_rate = 0.12;
$shipping = 4.95;

//handles database connection
include "external/db_connect.php";

//handles add-to-cart
include "external/add_to_cart.php";

// check account creation form submission
include "external/create_account.php";

// check login form submission
include "external/login.php";

// check logout button
include "external/logout.php";

?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- CSS written by Abbey -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!--search icon from w3school-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- JS script for pop-up forms -->
    <script src="js/popup.js"></script>

    <title>Butterbean Bakery</title>
  </head>


<body style="background-color: #EADED6;">

<?php
// adds a navbar
include "external/navbar.php";
// adds popup forms
include "external/popup_forms.php";
?>

<div id="main">

<!-- Product cards -->
<div class='my-5' id='products'>
<?php
    $sql = "SELECT id, name, price, description, img_link FROM products;";
    $result = mysqli_query($conn, $sql);

    $counter = 0;

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($counter%2 == 0){
            echo "<div class='row w-100'>";
        };

        $counter++;

        echo "
            <div class='col-6 px-5'>
            <div class='container' align='center'>
                <img class='w-50' src='".$row['img_link']."' alt='Chocolate Chip Cookies'>
                <h5 class='my-3 product-heading'>".$row['name']." </h5>
                <p>".$row['description']." </p>
                <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST'>
                    <input type='hidden' name='product_name' value='".$row['name']."'>
                    <input type='hidden' name='price' value='".$row['price']."'>
                    <input type='hidden' name='img_link' value='".$row['img_link']."'>
                    <label for='quantity'>Quantity:</label>
                    <input type='number' min='1' max='10' name='quantity' required>
            ";

        // Generate dropdown menu for available batch
        $query = "
            SELECT bi.id, DATE_FORMAT(b.delivery_date, '%W, %M %D') as batch_name
            FROM batch_items bi 
            JOIN batches b 
            ON b.id = bi.batch_id
            WHERE product_id = ".$row['id']."
            AND bi.max_quantity-bi.quantity_sold > 0
            AND b.start_date <= CURDATE()
            AND b.end_date >= CURDATE();";
        
        $out = mysqli_query($conn, $query);


        if (mysqli_num_rows($out)==0) {
            echo "
                <label for='batch'>Batch: </label>
                <select name='batch' disabled>
                <option> Product Not Available </option>
                </select>
                <br>
                <p> Price: $".$row['price']."/unit</p>
                </form>
                </div>
                </div>
            ";
        } else {
            echo "
                <label for='batch'>Select Batch: </label>
                <select name='batch' onchange='batchQuantity(this.value)'>
                    <option id='".$row['id']."_default' selected='selected' value='0'> Select Batch </option>
            ";
            
            // create assoc array to store batch-quantity pairs
            $qty_array = array();

            while ($batch = mysqli_fetch_array($out, MYSQLI_ASSOC)) {
                //batch dropdown
                echo "<option value='".$row['id']."_".$batch['id']."_".$batch['batch_name']."'>".$batch['batch_name']."</option>";
            };
            
            echo "
                </select>
                <br>
                <p> Price: $".$row['price']."/unit</p>
                <p> Quantity Available in Batch: <span class='badge badge-secondary' id='qty_".$row['id']."'>-</span> </p>
                </form>
                </div>
                </div>
            ";
        };

        if($counter%2==0){
            echo "</div>";
        }

    };
?>

</div>

<button type="button" id="btn1" disabled>Test</button>
<button type="button" onclick="enableButton();">Enable Button Above</button>

</body>
</html>