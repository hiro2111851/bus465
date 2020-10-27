<!-- 
    Page Name: Mainpage

    Page Description: The Mainpage of the website; has the products, 

    Created By: Abbey
-->
<!doctype html>

<?php
session_start();
// session_destroy();

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

?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--search icon from w3school-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS written by Abbey -->
    <style>
        .navitem {
          border-style: groove;
          box-sizing: border-box;
          padding: 10px;
          border: 0.5px solid grey;
          background: #D3DEE5;
        }

        body {
          background-color: #EADED6;
        }

        h1 {
          font-size: 84pt;
          font-family: "Vivaldi";
        }

        .col-md-6, .col-md-1, .col-md-5{
          padding: 20pt;
          margin: auto;
        }

        form.example input[type=text] {
          padding: 10px;
          font-size: 17px;
          border: 1px solid grey;
          float: left;
          width: 80%;
          background: #f1f1f1;
          }

        form.example button {
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
    </style>

    <!-- JS script for pop-up forms -->
    <script>
        function openCart() {
            document.getElementById("myCart").style.width ="40%";
            document.getElementById("main").style.marginRight = "40%";
            document.getElementById("login_form").style.display = "none";
            document.getElementById("acc_create_form").style.display = "none";
        }

        function closeCart() {
            document.getElementById("myCart").style.width ="0";
            document.getElementById("main").style.marginRight = "0";  
        }

        function openLogin() {
            document.getElementById("login_form").style.display = "block";
            document.getElementById("acc_create_form").style.display = "none";
        }

        function openCreateAccount() {
            document.getElementById("login_form").style.display = "none";
            document.getElementById("acc_create_form").style.display = "block";
        }

        function closeForm() {
            document.getElementById("login_form").style.display = "none";
            document.getElementById("acc_create_form").style.display = "none";
        }
    </script>

    <title>Butterbean Bakery</title>
  </head>


  <body>

<?php
// adds a navbar
include "external/navbar.php";
?>

<!-- Shopping Cart -->
<div id="myCart" class="h-100 float-right sticky-top" style="width:0; overflow:hidden;">
    <div id="wrapper" class="border p-5">
        <!-- This div wraps the shopping cart section -->
        <div id="cart" class="pb-3 border-bottom border-dark">
            <!-- Heading for Shopping Cart -->
            <h2 class="text-center mb-3">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-left float-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="closeCart()">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                Shopping Cart
            </h2>

            <!-- DIV for the section where the items added to the cart is displayed -->
            <div id="products" class="px-5 scroll" style="height: 20em; overflow-y: scroll;">
                <?php
                    $subtotal = 0;
                    foreach ($_SESSION['shopping_cart'] as $cart_item) {?>
                        <div class="row p-2">
                            <div class="col-3">
                                <img src="<?php echo $cart_item['img_link'];?>" class="img-thumbnail">
                            </div>
                            <div class="col-9">
                                <h6><?php echo $cart_item['product_name'];?></h6>
                                    <div class="row">
                                        <div class="col-2">
                                            <p>Price:</label>
                                        </div>
                                        <div class="col-4">
                                            <p><?php echo "$".$cart_item['price'];?></p>
                                        </div>
                                        <div class="col-2">
                                            <p>Qty:</label>
                                        </div>
                                        <div class="col-4">
                                            <p><?php echo $cart_item['quantity'];?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-4">Batch:</p>
                                        <p class="col-sm-8 text-right"><?php echo $cart_item['batch_date'];?></p>
                                    </div>
                            </div>                
                        </div>
                    <?php
                        $subtotal += $cart_item['price'];    
                    }
                ?>
            </div>
        </div>
        <!-- DIV for Order Summary section -->
        <div id="order-summary" class="py-3 border-bottom border-dark">
            <h2 class="text-center"> Order Summary </h2>
                <div class="row">
                    <p class="col-sm-4">Subtotal: </p>
                    <p class="col-sm-8 text-right"> <?php echo "$".$subtotal;?></p>
                </div>
                <!-- Not Real Amount -->
                <div class="row">
                    <p class="col-sm-4">Est. Shipping: </p>
                    <p class="col-sm-8 text-right"> <?php echo "$".$shipping;?></p>
                </div>
                <div class="row">
                    <p class="col-sm-4">Est. Taxes: </p>
                    <p class="col-sm-8 text-right"> <?php echo "$".round(($subtotal+$shipping)*$tax_rate, 2);?></p>
                </div>
                <div class="row">
                    <p class="col-sm-4">Estimated Total: </p>
                    <p class="col-sm-8 text-right"> <?php echo "$".round(($subtotal+$shipping)*(1+$tax_rate), 2);?></p>
                </div>
        </div>
        <!-- This div holds the 2 buttons Continue Shopping and Checkout -->
        <div id="buttons py-3 border-bottom border-dark">
            <div class="row m-3">
                <div class="col mx-2">
                    <button type="button" class="col btn btn-secondary btn-lg">Continue Shopping</button>
                </div>
                <div class="col mx-2">
                    <button type="button" class="col btn btn-secondary btn-lg">Checkout</button>
                </div>
            </div> 
        </div>
    </div>
</div>

<!-- Login Form -->
<div id="login_form" style="display:none;" class="px-5 -y-3">
    <h3>Account Login</h3>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="submit_login" class="btn btn-primary">Submit</button>
    <button onclick="closeForm()" class="btn btn-danger">Back</button>
    </form>
</div>

<!-- Account Creation Form -->
<div id="acc_create_form" style="display:none;" class="px-5 py-3">
    <h3>Create Account</h3>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" required>
    </div>
    <button type="submit" name="submit_create" class="btn btn-primary">Submit</button>
    <button onclick="closeForm()" class="btn btn-danger">Back</button>
    </form>
</div>

<!-- Product cards -->
<div class='my-5' id='products'>
<?php
    $sql = "SELECT id, name, price, description, img_link FROM products;";
    $result = mysqli_query($conn, $sql);

    $counter = 0;

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($counter%2 == 0){
            echo "<div class='row'>";
        };

        $counter++;

        echo "
            <div class='col-sm-6 px-5'>
            <div class='container' align='center'>
                <img class='w-50' src='".$row['img_link']."' alt='Chocolate Chip Cookies'>
                <h5 class='my-3'>".$row['name']." </h5>
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
            SELECT bi.id, DATE_FORMAT(b.delivery_date, '%W, %M %D') as batch_name, bi.max_quantity, bi.quantity_sold
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
                <label for='submit'> Price: $".$row['price']."/unit</label>
                <button class='my-3' type='submit' name='add_to_cart' disabled>Add to Cart</button>
                </form>
                </div>
                </div>
            ";
        } else {
            echo "
                <label for='batch'>Select Batch: </label>
                <select name='batch'>
            ";

            while ($batch = mysqli_fetch_array($out, MYSQLI_ASSOC)) {
                echo "<option value='".$batch['id']."/".$batch['batch_name']."'>".$batch['batch_name']."</option>";
            };
            
            echo "
                </select>
                <br>
                <label for='submit'> Price: $".$row['price']."/unit</label>
                <button class='my-3' type='submit' name='add_to_cart'>Add to Cart</button>
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


  </body>
</html>