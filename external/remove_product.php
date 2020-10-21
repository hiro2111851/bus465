<!-- 
    Page Name: Remove Product

    Page Description: Handles removing product

    Created By: Hiro
-->
<?php
if(isset($_POST['remove_product'])) {
    // remove image
    if($_POST['img_link'] != 'img/placeholder.png') {
        unlink("../".$_POST['img_link']);
    }

    $sql = "
    DELETE FROM products
    WHERE id = '".$_POST['product_id']."';";

    if (!$conn->query($sql)) {
        echo "MySQL Error:". $conn -> error."<br>";
    } else {
        echo "<div class='alert alert-warning' role='alert'>Product Name: ".$_POST['name']." successfully deleted.</div>";
    };
}
?>