<!-- 
    Page Name: Add Batch

    Page Description: PHP file handling creation of batches

    SQL Injection Prevention: Done

    Created By: Hiro
-->
<?php
if(isset($_POST['submit_batch_item'])) {
    $stmt = $conn->prepare("INSERT INTO batch_items (batch_id, product_id, max_quantity, quantity_sold) VALUES (?, ?, ?, 0);");
    $stmt->bind_param("iii", $_POST['batch_id'], $_POST['product_id'], $_POST['max_quantity']);
    
    if (!$stmt->execute()) {
        echo "MySQL Error:". $conn -> error."<br>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Item added to Batch</div>";
    };

    $stmt->close();
};
?>
