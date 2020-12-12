<!-- 
    Page Name: Create Account

    Page Description: PHP file handling Account Creation

    Created By: Hiro
-->

<?php
if(isset($_POST['submit_create'])) {
    // get user form input
    $pwd_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    echo "<div class='alert alert-secondary' role='alert'>Create Account Form submitted with email: ".$_POST['email']."</div>";

    $stmt = $conn->prepare(
        "INSERT INTO customers(guest, email, password, dob, first_name, last_name, phone, street_1, street_2, city, state, zip_code, country)
        VALUES ('0', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    $stmt->bind_param("ssssssssssss"
        , $_POST['email']
        , $pwd_hash
        , $_POST['dob']
        , $_POST['first_name']
        , $_POST['last_name']
        , $_POST['phone']
        , $_POST['street_1']
        , $_POST['street_2']
        , $_POST['city']
        , $_POST['state']
        , $_POST['zip_code']
        , $_POST['country']);


    if (!$stmt->execute()) {
        echo "<div class='alert alert-danger' role='alert'> MySQL Error:". $stmt -> error."</div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Account created successfully.</div>";
    };

    $stmt->close();
};
?>