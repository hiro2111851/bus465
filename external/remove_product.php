<!-- 
    Page Name: Remove Product

    Page Description: Handles removing product

    Created By: Hiro
-->
<?php
if(isset($_POST['remove_product'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?;");
    $stmt->bind_param("i", $_POST['product_id']);

    if (!$stmt->execute()) {
        echo "MySQL Error:". $stmt -> error."<br>";
    } else {
        echo "<div class='alert alert-warning' role='alert'>Product Name: ".$_POST['name']." successfully deleted.</div>";

        // remove image
        if($_POST['img_link'] != 'img/placeholder.png') {
            unlink("../".$_POST['img_link']);
        }
    };
}
?>