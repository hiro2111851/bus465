<!-- 
    Page Name: Add Batch

    Page Description: PHP file handling creation of batches

    SQL Injection Prevention: Done

    Created By: Hiro
-->
<?php
if(isset($_POST['submit_batch'])) {
    $stmt = $conn->prepare("INSERT INTO batches (start_date, end_date, delivery_date) VALUES (?, ?, ?);");
    $stmt->bind_param("sss", $_POST['start_date'], $_POST['end_date'], $_POST['delivery_date']);
    
    if (!$stmt->execute()) {
        echo "MySQL Error:". $conn -> error."<br>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Batch added with for delivery date: ".$delivery_date."</div>";
    };

    $stmt->close();
};
?>
