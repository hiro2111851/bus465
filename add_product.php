<!-- 
    Page Name: Add Product

    Page Description: php file that handles adding product and product image upload

    Created By:Hiro
-->
<?php
if(isset($_POST['submit_product'])){
    //retrieve form content
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    //retrieve image
    $image = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    // Create record on products table
    $sql = "
        INSERT INTO products (name, price, description, active)
        VALUES (
            '".$name."',
             ".$price.", 
             '".$description."', 1);";
    
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: ".$last_id;
    } else {
       die("Error: ".$sql."<br>". $conn->error);
    };

    //handle file extention check
    $fileExt = explode('.', $fileName);
    $fileLowerExt = strtolower(end($fileExt));
    $allow = array('jpg', 'jpeg', 'png');
    $fileNameNew = $last_id."_".strtolower(trim($name)).$fileLowerExt;
    $fileDestination = "img/productimage/".$fileNameNew;

    //check if uploaded file has allowed extension
    if(in_array($fileLowerExt, $allow)) {
        if($fileError === 0){
            if($fileSize < 5000000){
                move_uploaded_file($fileTmpName, $fileDestination);

                $query = "
                    UPDATE products
                    SET img_link = '".$fileDestination."'
                    WHERE id = ".$last_id.";
                ";

                if ($conn->query($query) === TRUE) {
                    echo "Product image successfully uploaded";
                } else {
                   die("Error: ".$sql."<br>". $conn->error);
                }
            } else {
                echo "Product image must be smaller than 5 MB";
            }
        } else {
            echo "File Upload Error";
        }
    } else {
        echo "Product image must be of  jpg, jpeg, or png filetype";
    }
};