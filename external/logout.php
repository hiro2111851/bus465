<?php
if(isset($_POST['submit_logout'])) {
    $_SESSION['customer_id'] = "";
    $_SESSION['customer_name'] = "";
    echo "<div class='alert alert-success' role='alert'>Logout Successful. </div>";
};
?>