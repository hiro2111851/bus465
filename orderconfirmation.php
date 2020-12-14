<!-- 
    Page Name: Review Order Page

    Page Description: To summarize customer order and place it 

    Created By:
-->
<?php
session_start();

//handles database connection
include "external/db_connect.php";

//form handler
include "external/form_handler.php";
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

    <title>Butterbean Bakery Order Confirmation</title>
</head>

<style>
  #aboutus, #thecookies, #login {
  border-style: groove;
  box-sizing: border-box;
  padding: 10px;
  border: 0.5px solid grey;
  background: #D3DEE5;
}


h1 {
  font-size: 84pt;
  font-family: "Vivaldi";
}

.col-md-6, .col-md-1, .col-md-5 {
  padding: 15pt;
  margin: auto;
}

form.search input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
  }
  
form.search button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #DC747D;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
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
  
<div class="container" align="center">
    <h1>
Thank you for your order!
    </h1><hr><br>
<p>Order #<?php echo $order;?></p> 

<p class='alert alert-danger mb-3'>Please e-transfer $<?php echo $total;?> to cookielover@gmail.com with your order # above in your e-transfer message section.</p>

<div id='order_summary' class="w-75 mx-auto">
<h3 align=left>Order Summary: </h3>
<?php
foreach ($_SESSION['shopping_cart'] as $cart_item) {?>
    <div class="row p-3">
        <div class="col-4">
            <img class="img-responsive p-1 w-75" src="<?php echo $cart_item['img_link'];?>">    
        </div>
        <div class="col-8">
            <h3 align=left style="font-size: 24px;"><?php echo $cart_item['product_name'];?></h3>
            <!-- Price -->
            <div class="row">
                <div class="col-4">
                    <p>
                        Price:
                        <br>Quantity:
                        <br>Batch:
                    </p>
                </div>
                <div class="col-8">
                    <p style="text-align: right">
                        <?php echo "$".$cart_item['price'];?>
                        <br><?php echo $cart_item['quantity'];?>
                        <br><?php echo $cart_item['batch_date'];?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php 
}
echo "<p align=right class='p-3'>Order Total: <strong>$".$total."</strong></p>";

//clear cart
unset($_SESSION['shopping_cart']);
?>
</div>

<div class="row" align="center">
    <!--Go back to shopping button-->
    <div class="col">
        <form action="index.php">
            <input type="submit" class="btn btn-outline-dark w-75 mx-auto" value="Return to Home">
        </form>
    </div>
    <!--View Orders-->
    <div class="col" >

        <form>
            <input type="submit" class="btn btn-outline-dark w-75 mx-auto" value="View My Orders">
        </form>
    </div>
</div>

</div>
</body>
</html>