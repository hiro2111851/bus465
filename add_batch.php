<!-- 
    Page Name: Add Batch

    Page Description: PHP file handling creation of batches

    Created By: Hiro
-->
<?php
if(isset($_POST['submit_batch'])) {
    // get user input from form
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $delivery_date = $_POST['delivery_date'];

    $sql = "
    INSERT INTO batches (start_date, end_date, delivery_date)
    VALUES ('"
        .$start_date."', '"
        .$end_date."', '"
        .$delivery_date."');";
    
    if (!$conn->query($sql)) {
        echo "MySQL Error:". $conn -> error."<br>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Batch added with for delivery date: ".$delivery_date."</div>";
    };
};
?>
