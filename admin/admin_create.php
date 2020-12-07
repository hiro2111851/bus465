<!-- 
    Page Name: basic login HTML page

    Page Description: HTML page for login.

    Created By: Oliver
-->

<?php
session_start();

// check login
include "./admin_check.php";

//handles database connection
include "../external/db_connect.php";

// check account creation form submission
include "../external/create_admin.php";

//adds a navbar
include "admin_nav.php";
?>

<!DOCTYPE html>

<html lang=en>

<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--search icon from w3school-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS -->
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
        
        .outer {
            display: table;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            }

        .middle {
            display: table-cell;
            vertical-align: middle;
            }

        .inner {
            margin-left: auto;
            margin-right: auto;
            width: 400px;
            /*whatever width you want*/
            }
    </style>

    <!-- This will link the Bootstrap css file to this HTML page allowing us to use the Bootstrap classes to style our HTML components.  -->
    <link rel="stylesheet" href="../css/bootstrap.css">

    <title>Admin Create</title>
</head>

<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-4">
      <!-- Account Creation Form -->
      <div id="acc_create_form" class="px-5 py-3">
        <h3>Create an Admin Account</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
          <button type="submit" name="submit_create" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>

</html>

