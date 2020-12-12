<?php
//database account credentials
$servername = "localhost";
$dbusername = "dev";
$dbpassword = "nno09VWFlZeSz1Uf";

// Establish connection
$conn = new mysqli($servername, $dbusername, $dbpassword);

//check database connection
// if ($conn->connect_error) {
//     // if it fails tell us that and the error message
//     die("<div class='alert alert-danger' role='alert'>MySQL: Connection failed: " . $conn->connect_error)."</div>";
//   }
//   echo "<div class='alert alert-success' role='alert'>MySQL: Connected successfully </div>";

// Use bus465 database
mysqli_select_db($conn, "bus465");
?>