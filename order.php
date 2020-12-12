<!-- 
    Page Name: Order Detail Page

    Page Description: Order Detail page accessed via GET 

    Created By:
-->
<?php
session_start();

include "external/db_connect.php";

$stmt = $conn->prepare(
  "SELECT status FROM orders WHERE id = ? AND customer_id = ?;"
);

$stmt->bind_param("ii", $_GET['orderid'], $_SESSION['customer_id']);

$stmt->execute();
$stmt->store_result();
$stmt->bind_result($s);

//if the order does not exist or is not the logged in user's order
if (!$stmt->num_rows > 0) {
  echo "
  <script type='text/javascript'>
    alert('The order # entered does not exist or is not your past order');
    window.location.href='index.php';
    </script>";
} else {
  while ($stmt->fetch()) {
    $status = $s;
  }
};

$stmt->close();
?>

<!DOCTYPE html>

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
    <script src="js/main.js"></script>

    <title>Order #<?php echo $_GET['orderid'];?> Detail</title>
</head>

<style>
body {
  background-color: #EADED6;
}

 div.container {
  border-style: solid;
  border-width: thick;
  border-color: #DC747D;
  background-color: #f1f1f1;
  padding-left: 30px;
  padding-top: 20px;
  padding-right: 30px;
  padding-bottom: 50px;
  text-align: center;
  font-family: "Bahnschrift";
}
</style>

<?php
// adds navbar
include "external/navbar.php";
// adds popup forms
include "external/popup_forms.php";
?>

<body>
  
<h1 class="text-left logo my-3" style="font-size:60px">Order #<?php echo $_GET['orderid'];?> Detail</h1>

 <div class="container">
 <div class="row">
    <div class="col">
        <h3 style="font-family: Vivaldi; font-weight: bold;">Order #<?php echo $_GET['orderid'];?></h3>
    </div>
    <div class="col">
        <h3 style="font-family: Vivaldi; font-weight: bold;">Status: <?php echo $status; ?></h3>
    </div> 
</div>

<?php
//retrieve order detail
$stmt = $conn->prepare(
  "SELECT p.name, DATE_FORMAT(b.delivery_date, '%W, %M %D') as batch, p.img_link, oi.price, oi.quantity
  FROM batch_items bi
    INNER JOIN batches b ON bi.batch_id = b.id
    INNER JOIN products p ON bi.product_id = p.id
      INNER JOIN order_items oi ON bi.id = oi.batch_item_id
  WHERE oi.order_id = ?;"
);

$stmt->bind_param("i", $_GET['orderid']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $batch, $img_link, $price, $quantity);

$subtotal = 0;

while ($stmt->fetch()) {?>    
<div class="container-fluid my-3">
    <div class="row">
        <div class="col-4">
            <img class="img-responsive" src="<?php echo $img_link;?>" width="170">    
        </div>
        <div class="col-8">
            <h3 style="font-family: Vivaldi; font-weight: bold;"><?php echo $name;?></h3>
            <div class="row">
                <div class="col-6">
                    <p style="text-align: left">Price:</p>
                </div>
                <div class="col-6">
                    <p style="text-align: right">$<?php echo $price;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p style="text-align: left">Quantity:</p>
                </div>
                <div class="col-6">
                    <p style="text-align: right"><?php echo $quantity;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p style="text-align: left">Batch:</p>
                </div>
                <div class="col-6">
                    <p style="text-align: right"><?php echo $batch;?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$subtotal += $price*$quantity;
}; 

$stmt->close();
?>

<h3 style="font-family: Vivaldi; font-weight: bold;">Order Summary</h3>

<div class="container-fluid">
  <div class="row">
    <div class="col" style="text-align: left">
       <label>
         Subtotal:
       </label>
    </div>
    <div class="col" style="text-align: right">
       <p>
         $<?php echo $subtotal;?>
       </p>    
    </div>
  </div>
<!--
  <div class="row">
    <div class="col" style="text-align: left">
       <label>
         Est. Shipping:
       </label>
    </div>
    <div class="col" style="text-align: right">
       <p>
         $4.95
       </p>    
    </div>
  </div>
  <div class="row">
    <div class="col" style="text-align: left">
       <label>
         Est. Taxes:
       </label>
    </div>
    <div class="col" style="text-align: right">
       <p>
         $13.66
       </p>    
    </div>
  </div>
  <div class="row">
    <div class="col" style="text-align: left">
       <label>
         Est. Total:
       </label>
    </div>
    <div class="col" style="text-align: right">
       <p>
         $154.21
       </p>    
    </div>
  </div>
-->
</div><br><br>

</div>

</body>
</html>