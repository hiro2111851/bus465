<?php
if(isset($_POST['submit_login'])) {
    // get user form input
    $email = $_POST['email'];
    $pwd_input = $_POST['password'];

    echo "<div class='alert alert-secondary' role='alert'>Login Form submitted with email: ".$email."</div>";

    $sql = "
    SELECT id, email, password
    FROM customers
    WHERE email = '".$email."';";

    $result = mysqli_query($conn, $sql);
    
    if ($result -> num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($pwd_input, $row['password'])) {
            $_SESSION['customer_id'] = $row['id'];
            echo "<div class='alert alert-success' role='alert'>Login Successful. </div>";
        } else {
            $_SESSION['customer_id'] = "";
            echo "<div class='alert alert-danger' role='alert'>Login unsuccessful: The email and password you entered did not match our records. Please try again. </div>";
        };
    } else {
        $_SESSION['customer_id'] = "";
        echo "<div class='alert alert-danger' role='alert'> Login unsuccessful: Account does not exist with email: ".$email."</div>";
    };  
};
?>