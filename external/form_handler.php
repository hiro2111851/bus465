<!-- 
    Page Name: Form Handler

    Page Description: PHP file handling forms throughout the app. PHP handlers created by Oliver are not here as they are directly added to the admin pagees

    SQL Injection Prevention: Done

    Created By: Hiro
-->
<?php
// DEBUGGING OPTIONS (uncomment them to use)

    // Print Session Variables
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";

// CUSTOMER SIDE FORMS
    
    // Process Order (for: orderconfirmation.php)
    if(isset($_POST['submit_checkout'])) {
        if($_POST['guest'] == 1) { //check if guest checkout
            //create guest customer record
            $stmt = $conn->prepare( //prepare statement
                "INSERT INTO customers (guest, email, first_name, last_name, phone, street_1, street_2, city, state, zip_code, country)
                VALUES ('1', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"
            );
            $stmt->bind_param( //bind parameters
                "ssssssssss"
                ,$_POST['email']
                ,$_POST['first_name']
                ,$_POST['last_name']
                ,$_POST['phone']
                ,$_POST['street_1']
                ,$_POST['street_2']
                ,$_POST['city']
                ,$_POST['state']
                ,$_POST['zip_code']
                ,$_POST['country']
            );
            $stmt->execute(); //execute
            $customer = $stmt->insert_id; //store created customer_id
            $stmt->close(); //close statement
        } else {
            $customer = $_SESSION['customer_id']; // take customer id from login session
        }

        // retrieve current date
        $tz = "America/Vancouver";
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz));
        $dt->setTimestamp($timestamp);
        $date = $dt->format('Y-m-d');

        // create order record
        $stmt = $conn->prepare( //prepare statement
            "INSERT INTO orders (customer_id, email, date, status, street_1, street_2, city, state, zip_code, country)
            VALUES (?, ?, ?, 'Pending Payment', ?, ?, ?, ?, ?, ?);"
        );
        $stmt->bind_param( //bind parameters
            "issssssss"
            , $customer 
            , $_POST['email']
            , $date
            , $_POST['street_1']
            , $_POST['street_2']
            , $_POST['city']
            , $_POST['state']
            , $_POST['zip_code']
            , $_POST['country']
        );
        $stmt->execute(); //execute
        $order = $stmt->insert_id; //store created order id
        $stmt->close(); //close statement
        
        // create order_items record
        $total = 0; // variable for order total
        foreach($_SESSION['shopping_cart'] as $cartitem) { //loop through shopping cart to create order items for each item in cart 
            //create order item record
            $stmt = $conn->prepare( //prepare statement
                "INSERT INTO order_items (order_id, batch_item_id, quantity, price)
                VALUES (?, ?, ?, ?);"
            );
            $stmt->bind_param( //bind parameters
                "iiid"
                , $order
                , $cartitem['batch_item_id']
                , $cartitem['quantity']
                , $cartitem['price']
            );
            $stmt->execute(); //execute
            $stmt->close(); //close statement

            $total += $cartitem['quantity']*$cartitem['price']; // add amount to total

            // subtract available quantity
            $stmt = $conn->prepare( //prepare statement
                "UPDATE batch_items
                SET quantity_sold = quantity_sold+?
                WHERE id = ?;"
            );
            $stmt->bind_param( //bind parameter
                "ii"
                , $cartitem['quantity']
                , $cartitem['batch_item_id']
            );
            $stmt->execute(); //execute
            $stmt->close(); //close statement
        };
    }

    // Add selected batch_item into shopping cart (for: index.php)
    if(isset($_POST['add_to_cart'])){
        // breakdown batch related input (the <option> holds *PRODUCT_ID*_*BATCH_ITEM_ID*_*BATCH_DEVELIERY_DATE* delimited by an underscore)
        $batch_info = preg_split('/_/', $_POST['batch']); //split the value by the delimiter "_" and return as array
        $batch_item_id = $batch_info[1]; //take 2nd element = batch_items.id
        $batch_date = $batch_info[2]; //take 3rd element = batches.delivery_date

        if(isset($_SESSION['shopping_cart'])){// shopping cart exists

            // create an array of batch_item_id from $_SESSION['shopping_cart'] array
            $cart_items = array(); 
            $cart_items = array_column($_SESSION['shopping_cart'], 'batch_item_id');
            $count = count($cart_items);

            // check the added batch_item_id to the array created above
            if(!in_array($batch_item_id, $cart_items)) {// item doesn't exist in cart yet
                //create new associative array element in $_SESSION['shopping_cart'] array
                $_SESSION['shopping_cart'][$count] = array 
                    (
                        'batch_item_id' => $batch_item_id,
                        'product_name' => $_POST['product_name'],
                        'batch_date' => $batch_date,
                        'quantity' => $_POST['quantity'],
                        'price' => $_POST['price'],
                        'img_link' => $_POST['img_link']
                    );
            } else { // item exists in cart
                // increase quantity of existing cart item
                for ($i = 0; $i < count($cart_items); $i++){
                    if ($cart_items[$i] == $batch_item_id) {
                        $_SESSION['shopping_cart'][$i]['quantity'] += $_POST['quantity']; // add item quantity to existing cart item
                    }
                }
            }
        } else { // if shopping cart doesn't exist create array and add product as array key 0
            $_SESSION['shopping_cart'][0] = array //create cart and add first element (associative array for the cart item)
            (
                'batch_item_id' => $batch_item_id,
                'product_name' => $_POST['product_name'],
                'batch_date' => $batch_date,
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price'],
                'img_link' => $_POST['img_link']
            );
        }
    };

    // Clear Shopping Cart (for: index.php)
    if(isset($_POST['empty_cart'])) {
        unset($_SESSION['shopping_cart']);
        echo "<script>alert('Cart Emptied');</script>";
    };

    // Create Customer Account (for: index.php)
    if(isset($_POST['submit_create'])) {
        //check if the email entered is unique
        $stmt = $conn->prepare("SELECT COUNT(*) FROM customers WHERE email = ?;"); //prepare statement
        $stmt->bind_param("s", $_POST['email']); //bind parameters
        $stmt->execute(); //execute
        $stmt->store_result(); //store query result
        $stmt->bind_result($count); //bind query result to variable
        $stmt->fetch(); //fetch query result
        $stmt->close(); //close statement
    
        if($count > 0) {
            echo "<div class='alert alert-secondary' role='alert'>User account with email: ".$_POST['email']." already exists </div>"; //error handling (duplicate email)
        } else {
            if (strlen($_POST['password']) < 8) { //check password length
                echo "<div class='alert alert-secondary' role='alert'> Password must be at least 8 characters long </div>"; //error handling (password too long) *this should never occur unless user somehow bypasses javascript form validation for minimum length of password field
            } else {
                $pwd_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
                echo "<div class='alert alert-secondary' role='alert'>Create Account Form submitted with email: ".$_POST['email']."</div>"; //inform user that form was received
                $stmt = $conn->prepare( //prepare statement
                    "INSERT INTO customers(guest, email, password, dob, first_name, last_name, phone, street_1, street_2, city, state, zip_code, country)
                    VALUES ('0', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"
                ); 
                $stmt->bind_param( //bind parameter
                    "ssssssssssss"
                    , $_POST['email']
                    , $pwd_hash
                    , $_POST['dob']
                    , $_POST['first_name']
                    , $_POST['last_name']
                    , $_POST['phone']
                    , $_POST['street_1']
                    , $_POST['street_2']
                    , $_POST['city']
                    , $_POST['state']
                    , $_POST['zip_code']
                    , $_POST['country']
                ); 
                if (!$stmt->execute()) {
                    echo "<div class='alert alert-danger' role='alert'> MySQL Error:". $stmt -> error."</div>"; //error handlling
                } else {
                    echo "<div class='alert alert-success' role='alert'>Account created successfully.</div>"; //success message
                };
                $stmt->close(); //close statement
            }
        }
    };

    // User Login (for: index.php)
    if(isset($_POST['submit_login'])) {
        echo "<div class='alert alert-secondary' role='alert'>Login Form submitted with email: ".$_POST['email']."</div>"; //inform user that form was received
    
        $stmt = $conn->prepare("SELECT id, CONCAT(first_name, ' ', last_name) as name, email, password FROM customers WHERE email = ?;"); //prepare statement
        $stmt->bind_param("s", $_POST['email']); //bind parameter
        $stmt->execute(); //execute
        $stmt->store_result(); //store query results
        $stmt->bind_result($id, $name, $email, $password); //bind query results to variables
        
        while($stmt->fetch()) { //fetch query result
            if (password_verify($_POST['password'], $password)) { //check if password and hashed password on MySQL match
                $_SESSION['customer_id'] = $id; //create session variable to store logged in user
                $_SESSION['customer_name'] = $name; //create session variable to store logged in user's name
                echo "<div class='alert alert-success' role='alert'>Login Successful. Welcome ".$name."! </div>"; //success message
            } else {
                //clear sesion variables
                unset($_SESSION['customer_id']); 
                unset($_SESSION['customer_name']); 
                echo "<div class='alert alert-danger' role='alert'>Login unsuccessful: The email and password you entered did not match our records. Please try again. </div>"; //error handling
            };
        };
        $stmt->close(); //close statement
    };

    // User Logout (for: index.php)
    if(isset($_POST['submit_logout'])) {
        //clear session variables
        unset($_SESSION['customer_id']); 
        unset($_SESSION['customer_name']);
        echo "<div class='alert alert-success' role='alert'>Logout Successful. </div>"; //success message
    };


// ADMIN SIDE FORMS

    // Add a new Batch (for: admin/my_batches.php)
    if(isset($_POST['submit_batch'])) {
        $stmt = $conn->prepare("INSERT INTO batches (start_date, end_date, delivery_date) VALUES (?, ?, ?);");  //prepare statement
        $stmt->bind_param("sss", $_POST['start_date'], $_POST['end_date'], $_POST['delivery_date']); //bind parameters
        if (!$stmt->execute()) { 
            echo "MySQL Error:". $conn -> error."<br>"; //error handling
        } else {
            echo "<div class='alert alert-success' role='alert'>Batch added with for delivery date: ".$delivery_date."</div>"; //success message
        };
        $stmt->close(); //close statement
    };

    // Add a batch item to a batch (for admin/batch.php)
    if(isset($_POST['submit_batch_item'])) {
        // check if batch_item with same product id and batch id exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM batch_items WHERE product_id = ? AND batch_id = ?;"); //prepare statement
        $stmt->bind_param("ii", $_POST['product_id'], $_POST['batch_id']); //bind parameter
        $stmt->execute(); //execute
        $stmt->store_result(); //store query result
        $stmt->bind_result($count); //bind query result to variable
        $stmt->fetch(); //fetch query result
        $stmt->close(); //close statement
    
        // check how many matching batch_item exists
        if ($count > 0) {
            // batch item already exists so quantity is increased
            $stmt = $conn->prepare("UPDATE batch_items SET max_quantity = max_quantity + ? WHERE product_id = ? AND batch_id = ?;"); //prepare statement
            $stmt->bind_param("iii", $_POST['max_quantity'], $_POST['product_id'], $_POST['batch_id']); //bind parameters
            if (!$stmt->execute()) { 
                echo "MySQL Error:". $conn -> error."<br>"; //error handling
            } else {
                echo "<div class='alert alert-danger' role='alert'>Duplicate Batch Item Exists: Quantity of ".$_POST['max_quantity']." was added to existing batch item</div>"; //success message
            };
            $stmt->close();//close statement
        } else {
            // if no batch item with same product id and batch id exists, create it
            $stmt = $conn->prepare("INSERT INTO batch_items (batch_id, product_id, max_quantity, quantity_sold) VALUES (?, ?, ?, 0);"); //prepare statement
            $stmt->bind_param("iii", $_POST['batch_id'], $_POST['product_id'], $_POST['max_quantity']); //bind parameters
            if (!$stmt->execute()) {
                echo "MySQL Error:". $conn -> error."<br>"; //error handling
            } else {
                echo "<div class='alert alert-success' role='alert'>Item added to Batch</div>"; //success message
            };
            $stmt->close(); //close statement
        }
    };

    // Add a new product (for: admin/my_products.php)
    if(isset($_POST['submit_product'])){
        //retrieve image detail
        $image = $_FILES['image'];
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];
        
        // Insert a new product into MySQL database
        $stmt = $conn->prepare("INSERT INTO products (name, price, description, active) VALUES (?, ?, ?, 1);"); //prepare statement
        $stmt->bind_param("sds", $_POST['name'], $_POST['price'], $_POST['description']); //bind parameter
        if (!$stmt->execute()) {
            die("<div class='alert alert-danger' role='alert'> Error: ".$sql."<br>". $stmt->error."</div>"); //error handling (end here if error occurs)
        } else {
            $last_id = $stmt->insert_id; //retrieve the product id created
            echo "<div class='alert alert-success' role='alert'> New product: ".$name." added successfully. Product ID is: ".$last_id."</div>"; //success message
        };
        $stmt->close(); //close statement
        
        // handle uploaded image
        if(file_exists($_FILES['image']['tmp_name'])) { //check if image was uploaded
            //handle file extention check
            $fileExt = explode('.', $fileName);
            $fileLowerExt = strtolower(end($fileExt));
            $allow = array('jpg', 'jpeg', 'png'); //the extensions we allow
            $fileNameNew = $last_id."_".strtolower(trim($name)).".".$fileLowerExt;
            $fileDestination = "img/productimage/".$fileNameNew; //destination of the product image
    
            //check if uploaded file has allowed extension
            if(in_array($fileLowerExt, $allow)) { //check if the extension is what we allow
                if($fileError === 0){ //check if the file was uploaded without errors
                    if($fileSize < 5000000){ //check filesize
                        move_uploaded_file($fileTmpName, "../".$fileDestination); //move file from temp location to set destination (img/productimage/)
                        //store image file destination on img_link column of products table
                        $stmt = $conn->prepare("UPDATE products SET img_link = ? WHERE id = ?;"); //prepare statement
                        $stmt->bind_param("ss", $fileDestination, $last_id); //bind parameters
                        if (!$stmt->execute()) {
                            die("<div class='alert alert-danger' role='alert'> SQL Error: <br>". $stmt->error."</div>"); //error handling
                        } else {
                            echo "<div class='alert alert-success' role='alert'>Product image successfully uploaded.</div>"; //success message
                        }
                        $stmt->close(); //close statement
                    } else {
                        echo "<div class='alert alert-danger' role='alert'> Product image must be smaller than 5 MB</div>"; //error handling (filesize) 
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'> File Upload Error</div>"; //error handling (file upload error)
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'> Product image must be of jpg, jpeg, or png filetype</div>"; //error handling (filetype)
            }
        } else {
            echo "<div class='alert alert-warning' role='alert'> Product image was not provided. Placeholder image will be used. </div>"; //error handling (image not exist)
        }
    };

    // Remove a product (for: my_products.php)
    if(isset($_POST['remove_product'])) {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?;"); //prepare statement
        $stmt->bind_param("i", $_POST['product_id']); //bind parameters
        if (!$stmt->execute()) {
            echo "MySQL Error:". $stmt -> error."<br>"; //error handling
        } else {
            // remove image
            if($_POST['img_link'] != 'img/placeholder.png') { //do not delete if the image uses the placeholder image
                unlink("../".$_POST['img_link']); //deletes the image file associated to the image
            }
            echo "<div class='alert alert-warning' role='alert'>Product Name: ".$_POST['name']." successfully deleted.</div>"; //success message
        };
        $stmt->close();
    }

?>