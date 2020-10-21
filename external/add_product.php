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

    echo $_FILES['image']['name'];

    // Create record on products table
    $sql = "
        INSERT INTO products (name, price, description, active)
        VALUES (
            '".$name."',
             ".$price.", 
             '".$description."', 1);";
    
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "<div class='alert alert-success' role='alert'> New product: ".$name." added successfully. Product ID is: ".$last_id."</div>";
    } else {
       die("<div class='alert alert-danger' role='alert'> Error: ".$sql."<br>". $conn->error."</div>");
    };

    if(file_exists($_FILES['image']['tmp_name'])) {
        //handle file extention check
        $fileExt = explode('.', $fileName);
        $fileLowerExt = strtolower(end($fileExt));
        $allow = array('jpg', 'jpeg', 'png');
        $fileNameNew = $last_id."_".strtolower(trim($name)).".".$fileLowerExt;
        $fileDestination = "img/productimage/".$fileNameNew;

        //check if uploaded file has allowed extension
        if(in_array($fileLowerExt, $allow)) {
            if($fileError === 0){
                if($fileSize < 5000000){
                    move_uploaded_file($fileTmpName, "../".$fileDestination);

                    $query = "
                        UPDATE products
                        SET img_link = '".$fileDestination."'
                        WHERE id = ".$last_id.";
                    ";

                    if ($conn->query($query) === TRUE) {
                        echo "<div class='alert alert-success' role='alert'>Product image successfully uploaded.</div>";
                    } else {
                       die("<div class='alert alert-danger' role='alert'> Error: ".$sql."<br>". $conn->error."</div>");
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'> Product image must be smaller than 5 MB</div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'> File Upload Error</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'> Product image must be of jpg, jpeg, or png filetype</div>";
        }
    } else {
        echo "<div class='alert alert-warning' role='alert'> Product image was not provided. Placeholder image will be used. </div>";
    }
};