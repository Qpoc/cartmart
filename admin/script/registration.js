function isChecked() {
    var admin = document.getElementById('admin');
    var rider = document.getElementById('rider');
    
    if (admin.checked) {
        document.getElementById('condition').innerHTML = "Applying for Admin requires a valid government issued ID showing citizenship and birth date, and to be at least 18 years old in order to work as an Individual admin on Cartmart.";
    }else if (rider.checked) { 
        document.getElementById('condition').innerHTML = "Applying for Rider requires a valid government issued ID showing citizenship and birth date, Driver's License, and to be at least 18 years old in order to work as an Individual rider on Cartmart.";
    }
 }

 function isPasswordMatch(value, isConfirmField) {

     
     var password = document.getElementById('password').value;
     var confirmPass = document.getElementById('confirmPass').value;

     if (password == value && value.length != 0 && isConfirmField == true) {
        document.getElementById('confirmPass').style.border = '1px rgb(1,166,93) solid';
     }else if (confirmPass == value && value.length != 0 && isConfirmField == false) {
        document.getElementById('confirmPass').style.border = '2px rgb(1,166,93) solid';
     }else if (confirmPass != value && value.length != 0 && isConfirmField == false) {
        document.getElementById('confirmPass').style.border = '2px rgb(216,54,53) solid';
     }else if (password != value && value.length != 0 && isConfirmField == true) {
        document.getElementById('confirmPass').style.border = '2px rgb(216,54,53) solid';
     }
 }