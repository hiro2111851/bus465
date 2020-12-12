<!-- 
    Page Name: Create Account

    Page Description: PHP file handling Account Creation

    Created By: Hiro
-->

<?php
if(isset($_POST['submit_create'])) {
    //check for unique email
    $stmt = $conn->prepare(
        "SELECT COUNT(*) FROM customers WHERE email = ?;"
    );

    $stmt->bind_param("s", $_POST['email']);

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($c);

    while ($stmt->fetch()) {
        $count = $c;
    };

    if($count > 0) {
        echo "<div class='alert alert-secondary' role='alert'>User account with email: ".$_POST['email']." already exists </div>";
    } else {
        //check password length
        if (strlen($_POST['password']) < 8) {
            // this should never occur unless user somehow bypasses javascript form validation for minimum length of password field
            echo "<div class='alert alert-secondary' role='alert'> Password must be at least 8 characters long </div>";
        } else {
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
        }
    }
};
?>