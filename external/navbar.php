<!-- 
    Page Name: Navbar for User

    Page Description: Navbar for logged in user

    Created By: Hiro
-->

<!--header-->
<div id="navbar" style="background-color: #EADED6;">
<div class="row py-4">
  <div class="col">
      <h1 class="logo"><a href='index.php' style="color:inherit; text-decoration:inherit;">&nbsp;&nbsp;Butterbean Bakery</a></h1>
  </div>

  <?php //if logged in
  if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != "") { ?>
  <!-- Search Order Bar -->
  <div class="col" style="margin: auto;">
    <form class="search" action="order.php" method="GET" style="margin:auto;max-width:600px">
      <input type="text" placeholder="Search Order by Order #.." name="orderid">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>

  <?php //if not logged in
  } else { ?>
  <div class="col" style="margin: auto;">
    <form class="search" action="order.php" method="GET" style="margin:auto;max-width:600px">
      <input type="text" placeholder="You must login to view your orders" name="orderid" disabled>
      <button type="submit" disabled><i class="fa fa-search"></i></button>
    </form>
  </div>
  <?php }; ?>


  <div class="col-2">
      <?php if (empty($_SESSION['shopping_cart'])) {
        echo "
          <button type='button' class='btn btn-lg h-100' onclick='openCart();' disabled>
            <i class='fa fa-shopping-cart mr-2' style='font-size:36px'></i> Cart Empty
          </button>";
      } else {
        echo "
          <button type='button' class='btn btn-lg h-100' onclick='openCart();'>
            <i class='fa fa-shopping-cart mr-2' style='font-size:36px'></i> View Cart
          </button>";
      };?>
  </div>
</div>

<?php 
  if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != "") { 
    // Display Customer Name
    echo "
      <div class='row'>
        <div class='col-4 navitem'>
          <button href='#aboutus' class='btn text-dark w-100'>About Us</button>
        </div>
        <div class='col-4 navitem'>
          <button class='btn w-100'>My Orders</button>
        </div>
        <div class='col-4 navitem'>
          <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST'>
            <button type='submit' name='submit_logout' class='btn w-100'>Log Out</button>
          </form>
        </div>
      </div>
    ";
    } else {
      // Login and Create Account Button for non-user
      echo "
        <div class='row'>
          <div class='col-sm-4 navitem'>
          <button href='#aboutus' class='btn text-dark w-100'>About Us</button>
          </div>
          <div class='col-sm-4 navitem'>
            <button class='btn w-100' onclick='openCreateAccount()'>Create an Account</button>
          </div>
          <div class='col-sm-4 navitem'>
            <button class='btn w-100' onclick='openLogin()'>Log In</button>
          </div>
        </div>
      ";
    };
?> 
</div>
