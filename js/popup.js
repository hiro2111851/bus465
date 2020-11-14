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