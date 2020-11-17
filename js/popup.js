function openCart() {
    document.getElementById("myCart").style.width ="35%";
    document.getElementById("main").style.marginRight = "35%";
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
    var qty_id = "qty_"+str.split('/')[0];
    var batch = str.split('/')[1];
    if (str == "") {
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(qty_id).innerHTML = this.responseText
            }
        };
        xmlhttp.open("GET", "external/batch_quantity.php?batch="+batch, true);
        xmlhttp.send();
    }
    //remove default option
    var defop = str.split('/')[0]+"_default";
    document.getElementById(defop).style.display = 'none';
}
