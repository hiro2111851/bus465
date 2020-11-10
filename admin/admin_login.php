<!-- 
    Page Name: Account Login

    Page Description: PHP file handling Account login

    Created By: Hiro
    Adapted By: Oliver
-->

<?php
//handles database connection
include "../external/db_connect.php";

if(isset($_POST['submit_login'])) {
    // get user form input
    $username = $_POST['username'];
    $pwd_input = $_POST['password'];

    echo "<div class='alert alert-secondary' role='alert'>Login Form submitted with username: ".$username."</div>";

    $sql = "
    SELECT id, CONCAT(first_name, ' ', last_name) as name, username, password
    FROM admins
    WHERE username = '".$username."';";

    $result = mysqli_query($conn, $sql);
    
    if ($result -> num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($pwd_input, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            echo "<div class='alert alert-success' role='alert'>Login Successful. Redirecting to admin main page in 5 seconds...</div>";
            // meta redirect (apparently should use a 301 redirect, may change later)
            echo "<meta http-equiv='refresh' content='5;URL=/bus465/admin/my_batches.php'>";
        } else {
            $_SESSION['admin_id'] = "";
            $_SESSION['admin_name'] = "";
            echo "<div class='alert alert-danger' role='alert'>Login unsuccessful: The username and password you entered did not match our records. Please try again. </div>";
        };
    } else {
        $_SESSION['admin_id'] = "";
        $_SESSION['admin_name'] = "";
        echo "<div class='alert alert-danger' role='alert'> Login unsuccessful: Account does not exist with username: ".$username."</div>";
    };  
};

// if($_GET['logout']='true') {
//     $_SESSION['admin_id'] = "";
//     $_SESSION['admin_name'] = "";
//     echo "<div class='alert alert-success' role='alert'>Logout Successful. </div>";
// };

?>