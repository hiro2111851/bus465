<!-- 
    Page Name: Navbar for User

    Page Description: Navbar for logged in user

    Created By: Hiro
-->

<!--header--><div class="row" height=300>
<div class="col-md-6"><h1 class="text-left" style="font-size:70px"><strong>Butterbean Bakery</strong></h1></div>
  <div class="col-md-5">
    <?php
      if(isset($_SESSION['customer_name'])){
        echo "<p>Welcome ".$_SESSION['customer_name']."!</p>";
      };
    ?>
  </div>
  <div class="col-md-1" onclick="openCart()" align="center"><i class="fa fa-shopping-cart" style="font-size:42px"></i></div>
  </div>

<?php 
  if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != "") { 
    // Display Customer Name
    echo "
      <div class='row pb-3'>
        <div class='col-sm-4 navitem' align=center>
          <a href='#aboutus' class='text-dark'>About Us</a>
        </div>
        <div class='col-sm-4 navitem' align=center>
          <p href='#thecookies' class='text-dark'>My Orders</p>
        </div>
        <div class='col-sm-4 navitem' align=center>
          <a class='text-dark'>Log Out</a>
        </div>
      </div>
    ";
    } else {
      // Login and Create Account Button for non-user
      echo "
        <div class='row pb-3'>
          <div class='col-sm-4 navitem' align=center>
            <a href='#aboutus' class='text-dark'>About Us</a>
          </div>
          <div class='col-sm-4 navitem' align=center onclick='openCreateAccount()'>
            Create an Account
          </div>
          <div class='col-sm-4 navitem' align=center onclick='openLogin()'>
            Log In
          </div>
        </div>
      ";
    };
?> 
