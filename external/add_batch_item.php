<!-- 
    Page Name: Add Batch

    Page Description: PHP file handling creation of batches

    Created By: Hiro
-->
<?php
if(isset($_POST['submit_batch_item'])) {
    // get user input from form
    $product_id = $_POST['product_id'];
    $max_quantity = $_POST['max_quantity'];
    $batch_id = $_POST['batch_id'];

    $sql = "
    INSERT INTO batch_items (batch_id, product_id, max_quantity, quantity_sold)
    VALUES ("
        .$batch_id.", "
        .$product_id.", "
        .$max_quantity.", 0);";
    
    if (!$conn->query($sql)) {
        echo "MySQL Error:". $conn -> error."<br>";
    } else {
        echo "<div class='alert alert-success' role='alert'>Item added to Batch</div>";
    };
};
?>
