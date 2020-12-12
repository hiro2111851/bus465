<!-- 
    Page Name: Create Admin Account

    Page Description: PHP file handling Admin Creation

    Created By: Hiro
    Adapted By: Oliver
-->

<?php
if(isset($_POST['submit_create'])) {
    // get user form input
    $pwd_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    echo "<div class='alert alert-secondary' role='alert'>Create Account Form submitted with username: ".$username."</div>";

    $stmt = $conn->prepare(
        "INSERT INTO admins (username, password, first_name, last_name)
        VALUES (?, ?, ?, ?);");
    
    $stmt->bind_param("ssss", $_POST['username'], $pwd_hash, $_POST['first_name'], $_POST['last_name']);

    if (!$stmt->execute()) {
        echo "<div class='alert alert-danger' role='alert'> MySQL Error:". $stmt -> error."</div>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Account created successfully.</div>";
    };

    $stmt->close();
};
?>