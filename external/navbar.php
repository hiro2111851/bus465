<!-- 
    Page Name: Navbar for User

    Page Description: Navbar for logged in user

    Created By: Hiro
-->

<!--header--><div class="row" height=300>
<div class="col-md-6"><h1 class="text-left" style="font-size:70px"><strong>Butterbean Bakery</strong></h1></div>
  <div class="col-md-5">
    <?php
      if(isset($_SESSION['customer_name'])&&$_SESSION['customer_name']!=""){
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
          <button href='#aboutus' class='btn text-dark w-100'>About Us</button>
        </div>
        <div class='col-sm-4 navitem' align=center>
          <button class='btn w-100'>My Orders</button>
        </div>
        <div class='col-sm-4 navitem' align=center>
          <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST'>
            <button type='submit' name='submit_logout' class='btn w-100'>Log Out</button>
          </form>
        </div>
      </div>
    ";
    } else {
      // Login and Create Account Button for non-user
      echo "
        <div class='row pb-3'>
          <div class='col-sm-4 navitem' align=center>
          <button href='#aboutus' class='btn text-dark w-100'>About Us</button>
          </div>
          <div class='col-sm-4 navitem' align=center>
            <button class='btn w-100' onclick='openCreateAccount()'>Create an Account</button>
          </div>
          <div class='col-sm-4 navitem' align=center>
            <button class='btn w-100' onclick='openLogin()'>Log In</button>
          </div>
        </div>
      ";
    };
?> 
