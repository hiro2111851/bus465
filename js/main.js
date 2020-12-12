function openCart() {
    document.getElementById("myCart").style.width ="40%";
    document.getElementById("main").style.marginRight = "40%";
    document.getElementById("login_form").style.display = "none";
    document.getElementById("acc_create_form").style.display = "none";
}

function closeCart() {
    document.getElementById("myCart").style.width ="0";
    document.getElementById("main").style.marginRight = "0";  
}

function openLogin() {
    document.getElementById("login_form").style.display = "block";
    document.getElementById("acc_create_form").style.display = "none";
}

function openCreateAccount() {
    document.getElementById("login_form").style.display = "none";
    document.getElementById("acc_create_form").style.display = "block";
}

function closeForm() {
    document.getElementById("login_form").style.display = "none";
    document.getElementById("acc_create_form").style.display = "none";
}

function batchQuantity(str) {
    // AJAX to retrieve quantity available in batch
    var qty_id = "qty_"+str.split('_')[0];
    var qty_input = "qty_input_"+str.split('_')[0];
    var btn_id = "btn_"+str.split('_')[0];
    var batch = str.split('_')[1];
    if (str == "") {
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //display quantity available
                document.getElementById(qty_id).innerHTML = this.responseText;

                if (document.getElementById(btn_id)) {
                    // if add to cart button and quantity input exists, simply update the max quantity for the input field
                    document.getElementById(qty_input).max = this.responseText;
                // for the first time a batch is selected, create add to cart button, quantity input and input label
                } else {
                    // create add to cart button
                    var cartButton = document.createElement('button');
                    cartButton.innerHTML = "Add to Cart";
                    cartButton.setAttribute("name", "add_to_cart");
                    cartButton.setAttribute("type", "submit");
                    cartButton.setAttribute("id", btn_id);
                    document.getElementById(qty_id).parentElement.after(cartButton);
                    // create quantity input
                    var qtyInput = document.createElement('input');
                    qtyInput.type = "number";
                    qtyInput.min = 1;
                    // set max as the quantity available
                    qtyInput.max = this.responseText;
                    qtyInput.required = true;
                    qtyInput.className = "mr-3";
                    qtyInput.name = "quantity";
                    qtyInput.id = qty_input;
                    document.getElementById(qty_id).parentElement.after(qtyInput);
                    // label for quantity input
                    var qtyLabel = document.createElement('label')
                    qtyLabel.for = "quantity";
                    qtyLabel.innerHTML = "Quantity: ";
                    qtyLabel.className = "mr-3";
                    document.getElementById(qty_id).parentElement.after(qtyLabel);
                    //remove default option
                    var defop = str.split('_')[0]+"_default";
                    document.getElementById(defop).style.display = 'none';
                }
            }
        };
        xmlhttp.open("GET", "external/batch_quantity.php?batch="+batch, true);
        xmlhttp.send();
    }
}