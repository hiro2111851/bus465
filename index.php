<!-- 
    Page Name: Home Page

    Page Description: 

        Home page for our project

    Created By: Hiro
-->

<?php
// handles database connection
include "db_connect.php";

// check account creation form submission
include "create_account.php";

// check login form submission
include "login.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Home Page</title>
</head>

<body>

<!-- Container for body content -->
<div class="container">


<!-- Account Creation Form -->
<div id="acc_create_form">

<h2>HELLO</h2>


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

</form>
</div>

<!-- Login Form -->

<div id="login_form">
    
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

</form>
</div>

</div>

</body>

</html>

<?php 
// close database connection
mysqli_close($conn); 
?>