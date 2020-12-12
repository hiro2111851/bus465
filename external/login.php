<!-- 
    Page Name: Account Login

    Page Description: PHP file handling Account login

    Created By: Hiro
-->
<?php
if(isset($_POST['submit_login'])) {
    // get user form input
    echo "<div class='alert alert-secondary' role='alert'>Login Form submitted with email: ".$_POST['email']."</div>";

    $stmt = $conn->prepare(
        "SELECT id, CONCAT(first_name, ' ', last_name) as name, email, password
        FROM customers
        WHERE email = ?;");
    
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $email, $password);
    
    while($stmt->fetch()) {
        if (password_verify($_POST['password'], $password)) {
            $_SESSION['customer_id'] = $id;
            $_SESSION['customer_name'] = $name;
            echo "<div class='alert alert-success' role='alert'>Login Successful. Welcome ".$name."! </div>";
        } else {
            $_SESSION['customer_id'] = "";
            $_SESSION['customer_name'] = "";
            echo "<div class='alert alert-danger' role='alert'>Login unsuccessful: The email and password you entered did not match our records. Please try again. </div>";
        };
    };
    
    $stmt->close();
};

?>