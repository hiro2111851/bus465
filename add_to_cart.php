<!-- 
    Page Name: Add to Cart

    Page Description: Handles adding products into cart

    Created By: Hiro
-->
<?php
$cart_items = array();
//session_destroy();


if(isset($_POST['add_to_cart'])){
    // breakdown batch related input
    $batch_info = explode("/", $_POST['batch']);
    $batch_item_id = $batch_info[0];
    $batch_date = $batch_info[1];
    
    if(isset($_SESSION['shopping_cart'])){// shopping cart exists

        //count number of items in cart
        $count = count($_SESSION['shopping_cart']);

        $cart_items = array_column($_SESSION['shopping_cart'], 'batch_item_id');

        if(!in_array($_POST['batch'], $cart_items)) {// item doesn't exist in cart yet
            $_SESSION['shopping_cart'][$count] = array 
                (
                    'batch_item_id' => $batch_item_id,
                    'product_name' => $_POST['product_name'],
                    'batch_date' => $batch_date,
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price']
                );
        } else {// item exists in cart
            for ($i = 0; $i < count($cart_items); $i++){
                if ($cart_items[$i] == $batch_item_id) {
                    // add item quantity to existing cart item
                    $_SESSION['shopping_cart'][$i]['quantity'] += $_POST['quantity'];
                }
            }
        }
    } else { // if shopping cart doesn't exist create array and add product as array key 0
        $_SESSION['shopping_cart'][0] = array 
        (
            'batch_item_id' => $batch_item_id,
            'product_name' => $_POST['product_name'],
            'batch_date' => $batch_date,
            'quantity' => $_POST['quantity'],
            'price' => $_POST['price']
        );
    }
};

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

?>