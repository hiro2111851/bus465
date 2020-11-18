<!-- 
    Page Name: Review Order Page

    Page Description: To summarize customer order and place it 

    Created By:
-->
<?php
session_start();

include "external/db_connect.php";

// If checkout form submitted
if(isset($_POST['submit_checkout'])) {
    //check if guest checkout
    if($_POST['guest'] == 1) {
        //create guest customer record
        $sql = "INSERT INTO customers (guest, email, first_name, last_name, phone, street_1, street_2, city, state, zip_code, country)
                VALUES ('1', '"
                .$_POST['email']."', '"
                .$_POST['first_name']."', '"
                .$_POST['last_name']."', '"
                .$_POST['phone']."', '"
                .$_POST['street_1']."', '"
                .$_POST['street_2']."', '"
                .$_POST['city']."', '"
                .$_POST['state']."', '"
                .$_POST['zip_code']."', '"
                .$_POST['country']."');";
        
        mysqli_query($conn, $sql);

        $customer = mysqli_insert_id($conn);        
    } else {
        // take customer id from login session
        $customer = $_SESSION['customer_id'];
    }
    // retrieve current date
    $tz = "America/Vancouver";
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz));
    $dt->setTimestamp($timestamp);
    $date = $dt->format('Y-m-d');

    // create order record
    $sql = "INSERT INTO orders (customer_id, email, date, status, street_1, street_2, city, state, zip_code, country)
            VALUES ('".$customer."', '"
            .$_POST['email']."', '"
            .$date."', 
            'Pending Payment', '"
            .$_POST['street_1']."', '"
            .$_POST['street_2']."', '"
            .$_POST['city']."', '"
            .$_POST['state']."', '"
            .$_POST['zip_code']."', '"
            .$_POST['country']."');";
    
    mysqli_query($conn, $sql);
    
    $order = mysqli_insert_id($conn);

    // variable for order total
    $total = 0;

    // create order_items record
    foreach($_SESSION['shopping_cart'] as $cartitem) {
        $sql = "INSERT INTO order_items (order_id, batch_item_id, quantity, price)
                VALUES ('".$order."', '"
                .$cartitem['batch_item_id']."', '"
                .$cartitem['quantity']."', '"
                .$cartitem['price']."');";    
        
        mysqli_query($conn, $sql);

        // add amount to total
        $total += $cartitem['quantity']*$cartitem['price'];

        // subtract available quantity
        $sql = "UPDATE batch_items
                SET quantity_sold = quantity_sold+".$cartitem['quantity']."
                WHERE id = ".$cartitem['batch_item_id'].";";
        
        mysqli_query($conn, $sql);            
    };
}
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
    <script src="js/popup.js"></script>

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