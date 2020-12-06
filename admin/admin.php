<!-- 
    Page Name: basic login HTML page

    Page Description: HTML page for login.

    Wireframe: Second Wireframe on https://balsamiq.cloud/su2bnrx/pdwe618/rAA4F, named Login

    Created By: Oliver
-->

<?php
session_start();

//handles database connection
include "../external/db_connect.php";

// check login form submission
include "../admin/admin_login.php";

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

    <title>Admin Login</title>
</head>

<body>
  <div class="outer">
    <div class="middle">
      <div class="inner">
        <h2>Butterbean Bakery</h2><p>
        <h3>Admin Login</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
          <table border="0">
            <tr bgcolor="#cccccc">
            </tr>
            <tr>
              <td>Username</td>
              <td align="center"><input type="text" name="username" size="10" maxlength="10" required/></td>
            </tr>
            <tr>
              <td>Password</td>
              <td align="center"><input type="password" name="password" size="10" maxlength="10" required/></td>
            </tr>
            <tr>
              <td colspan='1' align='center'><input type='submit' name='submit_login' class="btn btn-primary" value='Login'/></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</body>

</html>