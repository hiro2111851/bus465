<!-- 
    Page Name: Database Connection

    Page Description: PHP file handling PHP to MySQL connection using the "dev" account

    Created By: Hiro
-->

<?php
//database account credentials
$servername = "142.58.251.72";
$dbusername = "hhattori";
$dbpassword = "dZzsbUKaJGTFF4We";

// Establish connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword);

//check database connection
if (!$conn) {
    // if it fails tell us that and the error message
    die("<div class='alert alert-danger' role='alert'>MySQL: Connection failed: " . $conn->connect_error)."</div>";
}
echo "<div class='alert alert-success' role='alert'>MySQL: Connected successfully </div>";

// Use bus465 database
mysqli_select_db($conn, "G5_bus465");
?>