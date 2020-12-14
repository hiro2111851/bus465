<!--
    Page Name: Shipping Address

    Page Description: For the customer to input their shipping address

    Created By:
-->
<?php

session_start();
//handles database connection
include "external/db_connect.php";

//form handler
include "external/form_handler.php";
?>

<!doctype html>
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
    <!-- JS script for checkout -->
    <script src="js/checkout.js"></script>

    <title>Butterbean Bakery Shipping Address</title>
</head>

<style>
body {
  background-color: #EADED6;
}

#shipping {
    border-style: solid;
    border-width: thick;
    border-color: #DC747D;
    background-color: #f1f1f1;
    margin-left: 2%;
    margin-right: 42%;
}

</style>

<?php
// adds navbar
include "external/navbar.php";
// adds popup forms
include "external/popup_forms.php";
?>

<body>

<div class="main py-3 px-3 mt-3" id="shipping">
    <h3 class='logo mb-3'>
    Shipping Information:
    </h3>
    <?php
    // check if user is logged in for an option to used saved address info
        if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != "") {
        echo "
        <div class='form-check'>
            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' Method='POST'>
            <input class='form-check-input' name='fill_address' type='checkbox' onchange='fillAddress(this.checked);'>
            <label class='form-check-label' for='fill_address'>Use Saved Customer/Address Information on your Account</label>
            </form>
        </div>";
        } else {
            echo "
            <div class='alert alert-primary' role='alert'>
                <strong>Login/Create an Account</strong> to Save your Customer/Address Information
            </div>";
        }
    ?>
    <form class="form-inline" action="orderconfirmation.php" method="POST" id="checkout_form">
    
     <!-- Guest or Logged in -->
    <input type="hidden" name="guest" value="
    <?php if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != "") {
        echo '0';
    } else {
        echo '1';
    }?>">

    <!-- First Row -->
    <h3 class='my-3'>Customer Information</h3>
    <div class="row w-100 mb-2">
        <!--first name field-->
        <div class="col-6 form-group">
            <label class='col-4' for="first_name">First Name:</label>
            <input type="text" class="form-control col-8" id="first_name"  name="first_name" required>
        </div>
        <!--last name field-->
        <div class="col-6 form-group">
            <label class='col-4' for="last_name">Last Name:</label>
            <input type="text" class="form-control col-8" id="last_name" name="last_name" required>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row w-100 mb-2">
        <!-- Email field-->
        <div class="col-6 form-group">
            <label class='col-4' for="email">Email:</label>
            <input type="text" class="form-control col-8" id="email" name="email" required>
        </div>
        <!-- Phone field-->
        <div class="col-6 form-group">
            <label class='col-4' for="phone">Phone:</label>
            <input type="text" class="form-control col-8" id="phone" name="phone" required>
        </div>
    </div>

    <!-- Third Row -->
    <h3 class='my-3'>Address Information</h3>
    <div class="row w-100 mb-2">
        <!-- Street Address field-->
        <div class="col-6 form-group">
            <label class='col-4' for="street_1">Street Address:</label>
            <input type="text" class="form-control col-8" id="street_1" name="street_1" required>
        </div>
        <!-- apt/unit field-->
        <div class="col-6 form-group">
            <label class='col-4' for="street_2">Unit #/Apt:</label>
            <input type="text" class="form-control col-8" id="street_2" name="street_2">
        </div>
    </div>

    <!-- Fourth Row -->
    <div class="row w-100 mb-2">
        <!-- City field-->
        <div class="col-6 form-group">
            <label class='col-4' for="city">City:</label>
            <input type="text" class="form-control col-8" id="city" name="city" required>
        </div>
        <!-- Province field-->
        <div class="col-6 form-group">
            <label class='col-4' for="state">Province/State:</label>
            <input type="text" class="form-control col-8" id="state" name="state" required>
        </div>
    </div>

    <!-- Fifth Row -->
    <div class="row w-100 mb-2">
        <!-- Postal Code field-->
        <div class="col-6 form-group">
            <label class='col-4' for="zip_code">Postal Code:</label>
            <input type="text" class="form-control col-8" id="zip_code" name="zip_code" required>
        </div>
        <!-- Country field-->
        <div class="col-6 form-group">
            <label class='col-4' for="country">Country:</label>
            <input type="text" class="form-control col-8" id="country" name="country" required>
        </div>
    </div>

    <!-- Sixth Row -->
    <div class="row w-100">
        <input class='w-75 mx-auto btn btn-primary mt-2' type='submit' name='submit_checkout' value='Checkout'>
    </div>

    </form>

</div>
    </body>
  </html>
