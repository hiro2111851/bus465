<!-- 
    Page Name: Add Batch

    Page Description: PHP file handling creation of batches

    SQL Injection Prevention: Done

    Created By: Hiro
-->
<?php
if(isset($_POST['submit_batch_item'])) {
    // check if batch_item with same product id and batch id exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM batch_items WHERE product_id = ? AND batch_id = ?;");
    $stmt->bind_param("ii", $_POST['product_id'], $_POST['batch_id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($c);

    while ($stmt->fetch()) {
        $count = $c;
    };

    $stmt->close();

    // check how many matching batch_item exists
    if ($count > 0) {
        // batch item already exists so quantity is increased
        $stmt = $conn->prepare("UPDATE batch_items SET max_quantity = max_quantity + ? WHERE product_id = ? AND batch_id = ?;");
        $stmt->bind_param("iii", $_POST['max_quantity'], $_POST['product_id'], $_POST['batch_id']);
        $stmt->execute();
        
        echo "<div class='alert alert-danger' role='alert'>Duplicate Batch Item Exists: Quantity of ".$_POST['max_quantity']." was added to existing batch item</div>";

        $stmt->close();
    } else {
        // if no batch item with same product id and batch id exists, create it
        $stmt = $conn->prepare("INSERT INTO batch_items (batch_id, product_id, max_quantity, quantity_sold) VALUES (?, ?, ?, 0);");
        $stmt->bind_param("iii", $_POST['batch_id'], $_POST['product_id'], $_POST['max_quantity']);
        
        if (!$stmt->execute()) {
            echo "MySQL Error:". $conn -> error."<br>";
        } else {
            echo "<div class='alert alert-success' role='alert'>Item added to Batch</div>";
        };

        $stmt->close();
    }
};
?>
