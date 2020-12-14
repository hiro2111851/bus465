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
    $pwd_input = $_POST['password'];

    echo "<div class='alert alert-secondary' role='alert'>Login Form submitted with username: ".$username."</div>";

    $stmt = $conn->prepare(
        "SELECT id, CONCAT(first_name, ' ', last_name) as name, username, password
        FROM admins
        WHERE username = ?;");
    
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $username, $password);

    while($stmt->fetch()){
        if (password_verify($pwd_input, $password)) {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $name;
            echo "<div class='alert alert-success' role='alert'>Login Successful. Redirecting to admin main page in 5 seconds...</div>";
            // meta redirect
            echo "<meta http-equiv='refresh' content='5;URL=/hhattori/bus465/admin/my_home.php'>";
        } else {
            $_SESSION['admin_id'] = "";
            $_SESSION['admin_name'] = "";
            echo "<div class='alert alert-danger' role='alert'>Login unsuccessful: The username and password you entered did not match our records. Please try again. </div>";
        };
    }
    
    $stmt->close();     
};

// if($_GET['logout']='true') {
//     $_SESSION['admin_id'] = "";
//     $_SESSION['admin_name'] = "";
//     echo "<div class='alert alert-success' role='alert'>Logout Successful. </div>";
// };

?>