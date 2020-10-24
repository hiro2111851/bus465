<!-- 
    Page Name: Navbar for User

    Page Description: Navbar for logged in user

    Created By: Hiro
-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <a class="navbar-brand mr-auto" href="#">Store ABC </a>

    <!-- <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul> -->
        <?php 
          if(!isset($_SESSION['customer_id']) || !$_SESSION['customer_id'] == "") { 
            // Display Customer Name
            echo "<p class='nav-item mb-0 mr-3 text-light'> Welcome <strong>".$_SESSION['customer_name']."</strong>!</p>";

            echo "
            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST' class='m-2 my-sm-0'>
              <button type='submit' name='submit_logout' class='btn btn-outline-warning'>
              <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-door-closed' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                <path fill-rule='evenodd' d='M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z'/>
                <path d='M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z'/>
              </svg>
              Logout
              </button>
            </form>
            ";
            
            // Link to My Orders Page
            echo "
              <a href='' class='btn btn-outline-primary m-2 my-sm-0'>
              <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-person-lines-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                <path fill-rule='evenodd' d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm2 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z'/>
              </svg>
              My Orders
              </a>";

            } else {
              // Login and Create Account Button for non-user
              echo "
                <button class='btn btn-outline-success m-2 my-sm-0' onclick='openLogin()'>
                  <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-person-circle' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                    <path d='M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z'/>
                    <path fill-rule='evenodd' d='M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/>
                    <path fill-rule='evenodd' d='M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z'/>
                  </svg>
                  Login
                </button>
                <button class='btn btn-outline-success m-2 my-sm-0' onclick='openCreateAccount()'>
                <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-person-plus-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                  <path fill-rule='evenodd' d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z'/>
                </svg>
                Create Account
              </button>";
            };
          if(isset($_SESSION['shopping_cart'])) {
            //display shopping cart button if shopping cart has item
            echo "
              <button class='btn btn-outline-success m-2 my-sm-0' onclick='openCart()'>
                <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-cart4' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                  <path fill-rule='evenodd' d='M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z'/>
                </svg>
                Shopping Cart
              </button>";
          } else {
            //disable shopping cart button when empty
            echo "
            <button class='btn btn-outline-secondary m-2 my-sm-0' disabled>
              <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-cart4' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                <path fill-rule='evenodd' d='M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z'/>
              </svg>
            Cart Empty
            </button>";
          };?> 
  </div>
</nav>

