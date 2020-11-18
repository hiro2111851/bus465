<!--
    Page Name: Shipping Address

    Page Description: For the customer to input their shipping address

    Created By:
-->
<?php
session_start();
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
    <script src="js/popup.js"></script>
    <!-- JS script for checkout -->
    <script src="js/checkout.js"></script>

    <title>Butterbean Bakery Shipping Address</title>
</head>

<style>
body {
  background-color: #EADED6;
}
</style>

<?php
// adds navbar
include "external/navbar.php";
// adds popup forms
include "external/popup_forms.php";
?>

<body>

<div class="container my-5" id="shipping">
    <h3 class='logo'>
    Shipping Information:
    </h3>
    <?php
    // check if user is logged in for an option to used saved address info
        if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != "") {
        echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' Method='POST'>
        <input name='fill_address' type='checkbox' onchange='fillAddress(this.checked);'>
        <label for='fill_address'>Use Saved Customer/Address Information on your Account</label>
        </form>";
        };
    ?>
    <form class="form-inline" action="/action_page.php" id="checkout_form">

    <!-- First Row -->
    <h3>Customer Information</h3>
    <div class="row w-100 mb-2">
        <!--first name field-->
        <div class="col-6 form-group">
            <label class='col-4' for="first_name">First Name:</label>
            <input type="text" class="form-control col-8" id="first_name"  name="first_name">
        </div>
        <!--last name field-->
        <div class="col-6 form-group">
            <label class='col-4' for="last_name">Last Name:</label>
            <input type="text" class="form-control col-8" id="last_name" name="last_name">
        </div>
    </div>

    <!-- Second Row -->
    <div class="row w-100 mb-2">
        <!-- Email field-->
        <div class="col-6 form-group">
            <label class='col-4' for="email">Email:</label>
            <input type="text" class="form-control col-8" id="email" name="email">
        </div>
        <!-- Phone field-->
        <div class="col-6 form-group">
            <label class='col-4' for="phone">Phone:</label>
            <input type="text" class="form-control col-8" id="phone" name="phone">
        </div>
    </div>

    <!-- Third Row -->
    <h3>Address Information</h3>
    <div class="row w-100 mb-2">
        <!-- Street Address field-->
        <div class="col-6 form-group">
            <label class='col-4' for="street_1">Street Address:</label>
            <input type="text" class="form-control col-8" id="street_1" name="street_1">
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
            <input type="text" class="form-control col-8" id="city" name="city">
        </div>
        <!-- Province field-->
        <div class="col-6 form-group">
            <label class='col-4' for="state">Province/State:</label>
            <input type="text" class="form-control col-8" id="state" name="state">
        </div>
    </div>

    <!-- Fifth Row -->
    <div class="row w-100 mb-2">
        <!-- Postal Code field-->
        <div class="col-6 form-group">
            <label class='col-4' for="zip_code">Postal Code:</label>
            <input type="text" class="form-control col-8" id="zip_code" name="zip_code">
        </div>
        <!-- Country field-->
        <div class="col-6 form-group">
            <label class='col-4' for="country">Country:</label>
            <input type="text" class="form-control col-8" id="country" name="country">
        </div>
    </div>

    </form>

</div>
    </body>
  </html>
