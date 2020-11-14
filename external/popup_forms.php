<!-- 
    Page Name: Popup forms for index.php

    Page Description: Shopping cart, login form, and account creation form 

    Created By: Hiro
-->
<!-- Shopping Cart -->
<div class="float-right sticky-top" id="myCart">
    <div class="container" id="cartWrapper">
        <!--Back Button-->
        <button type="button" onclick="closeCart();" class="btn btn-light btn-sm mt-3">
            <!-- Back icon -->
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
            Back to Browsing
        </button>
        <!-- Title -->
        <h1 class="cart-heading my-1">Shopping Cart</h1>
        <!-- Cart Products -->
        <div class="scroll" id="cartProducts">
            <?php  
                $subtotal = 0;
                foreach ($_SESSION['shopping_cart'] as $cart_item) {?>
                    <div class="row cartItem p-3">
                        <div class="col-4">
                            <img class="img-responsive w-100 p-1" src="<?php echo $cart_item['img_link'];?>">    
                        </div>
                        <div class="col-8">
                            <h3 class="cart-subheading"><?php echo $cart_item['product_name'];?></h3>
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
                    $subtotal += $cart_item['price']*$cart_item['quantity'];    
                }?>
        </div>
        
        <!-- DIV for Order Summary section -->
        <h1 class="cart-heading">Order Summary</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col" style="text-align: left">
                    <label>Subtotal:</label>
                </div>
                <div class="col" style="text-align: right">
                    <p><?php echo "$".$subtotal;?></p>    
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align: left">
                    <label>Est. Shipping:</label>
                </div>
                <div class="col" style="text-align: right">
                    <p><?php echo "$".$shipping;?></p>    
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align: left">
                    <label>Est. Taxes:</label>
                </div>
                <div class="col" style="text-align: right">
                    <p><?php echo "$".round(($subtotal+$shipping)*$tax_rate, 2);?></p>    
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align: left">
                    <label>Est. Total:</label>
                </div>
                <div class="col" style="text-align: right">
                    <p><?php echo "$".round(($subtotal+$shipping)*(1+$tax_rate), 2);?></p>    
                </div>
            </div>
        </div>
        
        <!--bottom buttons-->
        <div class="row">
            <div class="col-6">
            </div>

            <!--Go back to shopping button-->
            <div class="col-3" align=right>
                <div class="form-group">
                    <input type="button" class="form-control" id="back" align="center" value="Shop More" onclick="INSERT THE HREF">
                </div>
            </div>

            <!--submit button-->
            <div class="col-3"align=right >
                <div class="form-group">
                    <input type="submit" class="form-control" id="submit" align="center">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Form -->
<div id="login_form" style="display:none;" class="w-50 mx-auto my-5">
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
<div id="acc_create_form" style="display:none;" class="w-75 mx-auto my-5">
    <h3>Create Account</h3>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <div class="row">
        <div class="col-6">
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
        </div>
        <div class="col-6">

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
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" name="submit_create" class="btn btn-primary mr-1">Submit</button>
        <button onclick="closeForm()" class="btn btn-danger">Back</button>
        </form>
    </div>
</div>
