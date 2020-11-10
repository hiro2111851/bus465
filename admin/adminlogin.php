<!-- 
    Page Name: Account Login

    Page Description: PHP file handling Account login

    Created By: Oliver
-->


<html>
<head>

<!-- JS Script for redirect -->
<script>
        function redirect() {
            location.replace("/bus465/admin/payment.php")
        }
    </script>

<title>Login Response</title>
</head>
<body>
<h1>Login Response</h1>

<?php
echo "<p>Attempted login at ".date('H:i, jS F Y')."</p>";
?>

<?php
// Gathering the post data
	$username = $_POST['username'];
	$password = $_POST['password'];

if ($username == "Admin" and $password == "Temp") {
    echo "<p> Successfully logged in! </p>";
    header("Location: /bus465/admin/my_products.php");
}	else {
	echo "<p> Sorry, the username or password is incorrect. </p>";
}
?>

</body>
</html>

<?php
/*
if(isset($_POST['submit_login'])) {
    // get user form input
    $email = $_POST['email'];
    $pwd_input = $_POST['password'];

    echo "<div class='alert alert-secondary' role='alert'>Login Form submitted with email: ".$email."</div>";

    $sql = "
    SELECT id, CONCAT(first_name, ' ', last_name) as name, email, password
    FROM customers
    WHERE email = '".$email."';";

    $result = mysqli_query($conn, $sql);
    
    if ($result -> num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($pwd_input, $row['password'])) {
            $_SESSION['customer_id'] = $row['id'];
            $_SESSION['customer_name'] = $row['name'];
            echo "<div class='alert alert-success' role='alert'>Login Successful. </div>";
        } else {
            $_SESSION['customer_id'] = "";
            $_SESSION['customer_name'] = "";
            echo "<div class='alert alert-danger' role='alert'>Login unsuccessful: The email and password you entered did not match our records. Please try again. </div>";
        };
    } else {
        $_SESSION['customer_id'] = "";
        $_SESSION['customer_name'] = "";
        echo "<div class='alert alert-danger' role='alert'> Login unsuccessful: Account does not exist with email: ".$email."</div>";
    };  
};

// if($_GET['logout']='true') {
//     $_SESSION['customer_id'] = "";
//     $_SESSION['customer_name'] = "";
//     echo "<div class='alert alert-success' role='alert'>Logout Successful. </div>";
// };

*/
?>