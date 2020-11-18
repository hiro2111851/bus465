function fillAddress(check) {
    if(check == true) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //First Name
                document.getElementById('first_name').value = this.responseText.split('_')[0];
                document.getElementById('first_name').disabled = true;

                //Last Name
                document.getElementById('last_name').value = this.responseText.split('_')[1];
                document.getElementById('last_name').disabled = true;

                //Email
                document.getElementById('email').value = this.responseText.split('_')[2];
                document.getElementById('email').disabled = true;

                //Phone
                document.getElementById('phone').value = this.responseText.split('_')[3];
                document.getElementById('phone').disabled = true;

                //Street Address
                document.getElementById('street_1').value = this.responseText.split('_')[4];
                document.getElementById('street_1').disabled = true;

                //Unit #/Apt
                document.getElementById('street_2').value = this.responseText.split('_')[5];
                document.getElementById('street_2').disabled = true;

                //City
                document.getElementById('city').value = this.responseText.split('_')[6];
                document.getElementById('city').disabled = true;
                
                //State
                document.getElementById('state').value = this.responseText.split('_')[7];
                document.getElementById('state').disabled = true;
                
                // Postal Code
                document.getElementById('zip_code').value = this.responseText.split('_')[8];
                document.getElementById('zip_code').disabled = true;
                
                //Country
                document.getElementById('country').value = this.responseText.split('_')[9];
                document.getElementById('country').disabled = true;
            }
        };
        xmlhttp.open("GET", "external/customer_info.php", true);
        xmlhttp.send();
    } else {
        alert("Cleared Customer/Address Information");
        // clear form
        document.getElementById("checkout_form").reset();
        // enable all form input
        var input = document.getElementsByTagName("input");
        for (var i = 0; i < input.length; i++) {
            input[i].disabled = false;
        }
    }

}

