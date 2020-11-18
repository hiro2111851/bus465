<!-- 
    Page Name: Create Account

    Page Description: PHP file handling Account Creation

    Created By: Hiro
-->

<?php
if(isset($_POST['submit_create'])) {
    // get user form input
    $email = $_POST['email'];
    $pwd_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];

    echo "<div class='alert alert-secondary' role='alert'>Create Account Form submitted with email: ".$email."</div>";

    $sql = "
    INSERT INTO customers (guest, email, password, dob, first_name, last_name, phone)
    VALUES ('0', '"
        .$email."', '"
        .$pwd_hash."', '"
        .$dob."', '"
        .$first_name."', '"
        .$last_name."', '"
        .$phone."');";

    if (!$conn->query($sql)) {
        echo "<div class='alert alert-danger' role='alert'> MySQL Error:". $conn -> error."</div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Account created successfully.</div>";
    };
};
?>