<!-- 
    Page Name: Create Admin Account

    Page Description: PHP file handling Admin Creation

    Created By: Hiro
    Adapted By: Oliver
-->

<?php
if(isset($_POST['submit_create'])) {
    // get user form input
    $username = $_POST['username'];
    $pwd_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    echo "<div class='alert alert-secondary' role='alert'>Create Account Form submitted with username: ".$username."</div>";

    $sql = "
    INSERT INTO admins (username, password, first_name, last_name)
    VALUES ('"
        .$username."', '"
        .$pwd_hash."', '"
        .$first_name."', '"
        .$last_name."');";

    if (!$conn->query($sql)) {
        echo "<div class='alert alert-danger' role='alert'> MySQL Error:". $conn -> error."</div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Account created successfully.</div>";
    };
};
?>