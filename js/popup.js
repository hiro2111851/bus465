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

function batchQuantity(selectObject) {
    var batchinfo = selectObject.value;
    var id_qty = batchinfo.split('_')[0];
    var id = "qty_"+id_qty.split('|')[0];
    var qty = id_qty.split('|')[1];
    // Display quantity
    document.getElementById(id).innerHTML = qty;
    // remove default option
    var def_id = id_qty.split('|')[0]+"_default";
    var def_option = document.getElementById(def_id);
    def_option.remove();
}