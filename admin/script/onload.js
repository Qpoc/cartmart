function loadUser() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var params = "offset=" + offset;

    xhr.open('POST', 'php/get_user_info.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<tr>" +
                    "<td><p>" + data[i].customername + "</p></td>" +
                    "<td>" +
                    "<p>" + data[i].customeraddress + "</p>" +
                    "</td>" +
                    "<td><p>" + data[i].emailaddress + "</p></td>" +
                    "<td><p>" + data[i].dateadded + "</p></td>" +
                    "<td><input type='button' value='VIEW DETAILS' onclick=\"showUserDetails('" + data[i].customerpassword + "', '" + data[i].customerusername +  "', '" + data[i].mobilenumber + "', '" + data[i].customerID + "')\"></td>" +
                    "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;
            }
        }
    }

    xhr.send(params);

    var table = document.getElementById('tableContainer');

    table.addEventListener("scroll", function() {
        var y = table.scrollTop + table.offsetHeight;

        if (y >= table.scrollHeight) {
            offset += 4;

            xhr.open('POST', 'php/get_user_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                
                    }
                }
            }
            
            xhr.send(params);
        }
    })
}

function showUserDetails(password, username, number, customerid) {
    var output = "<tr>" +
    "<td><input type='text' disabled value=\"" + username + "\" id='username'></td>" +
    "<td><input type='password' disabled value=\"" + password + " \" id='passowrd'></td>" +
    "<td><input type='text' disabled value=\"" + number +  "\" id='mobileNum'></td>" +
    "<td>" +
    "<div class='button'>" +
        "<input type='button' value='VIEW CART' onclick=\"viewUserCart('" + customerid + "')\">" +
        "</div>" +
        "</td>" +
        "</tr>";
    document.getElementById('userDetails').innerHTML = output;
    document.getElementById('userWrapper').style.display = 'block';
}

function viewUserCart(customerid) {
    var xhr = new XMLHttpRequest();
    var params = "customerid=" + customerid;
    xhr.open("POST", "php/user/get_user_cart.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            var data = JSON.parse(this.responseText);
            var output = "";

            for (var i in data) {
                output += "<tr>" +
                "<td><p>" + data[i].productname + "</p></td>" +
                "<td>" +
                "<div class='cartImg'><img src='../" + data[i].productimg + "'></div>"
                "</td>" +
                "</tr>";
            }

            document.getElementById('cartDetails').innerHTML = output;
            document.getElementById('userWrapper').style.display = 'none';
            document.getElementById('cartWrapper').style.display = 'block';
        }
    }

    xhr.send(params);
}

function hideUserDetails() {
    document.getElementById('userWrapper').style.display = 'none';
    document.getElementById('cartWrapper').style.display = 'none';
}

function loadRider() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var params = "offset=" + offset;

    xhr.open('POST', 'php/get_rider_info.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";
                for (var i in data) {
                    output += "<tr>" +
                    "<td>" + data[i].ridername + "</td>" +
                    "<td>" +
                    "<p>" + data[i].email + "</p>" +
                    "</td>" +
                    "<td>" + data[i].mobile + "</td>" +
                    "<td>" + data[i].dateadded + "</td>" +
                    "<td><input type='button' value='VIEW DETAILS' onclick=\"showApplicantDetails('" + data[i].govID + "','" + data[i].email + "', 'rider')\"></td>" +
                    "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;
            }
        }
    }

    xhr.send(params);

    var table = document.getElementById('tableContainer');

    table.addEventListener("scroll", function() {
        var y = table.scrollTop + table.offsetHeight;

        if (y >= table.scrollHeight) {
            offset += 4;

            xhr.open('POST', 'php/get_user_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                
                    }
                }
            }
            
            xhr.send(params);
        }
    })
}

function loadAcceptedRider() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var params = "offset=" + offset + "&approved=" + 'true';

    xhr.open('POST', 'php/get_rider_info.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";
                for (var i in data) {
                    output += "<tr>" +
                    "<td>" + data[i].ridername + "</td>" +
                    "<td>" +
                    "<p>" + data[i].email + "</p>" +
                    "</td>" +
                    "<td>" + data[i].mobile + "</td>" +
                    "<td>" + data[i].dateadded + "</td>";
                }

                document.getElementById('tableBody').innerHTML = output;
            }
        }
    }

    xhr.send(params);

    var table = document.getElementById('tableContainer');

    table.addEventListener("scroll", function() {
        var y = table.scrollTop + table.offsetHeight;

        if (y >= table.scrollHeight) {
            offset += 4;

            xhr.open('POST', 'php/get_user_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                
                    }
                }
            }
            
            xhr.send(params);
        }
    })
}

function loadAdmin() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var params = "offset=" + offset;
    
    xhr.open('POST', 'php/get_admin_info.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<tr>" +
                    "<td>" + data[i].adminname + "</td>" +
                    "<td>" +
                    "<p>" + data[i].email + "</p>" +
                    "</td>" +
                    "<td>" + data[i].mobile + "</td>" +
                    "<td>" + data[i].dateadded + "</td>" +
                    "<td><input type='button' value='VIEW DETAILS' onclick=\"showApplicantDetails('" + data[i].govID + "','" + data[i].email + "', 'admin')\"></td>" +
                    "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;
            }
        }
    }

    xhr.send(params);

    var table = document.getElementById('tableContainer');

    table.addEventListener("scroll", function() {
        var y = table.scrollTop + table.offsetHeight;

        if (y >= table.scrollHeight) {
            offset += 4;

            xhr.open('POST', 'php/get_user_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                
                    }
                }
            }
            
            xhr.send(params);
        }
    })
}

function loadAcceptedAdmin() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var params = "offset=" + offset + "&approved=" + 'true';
    
    xhr.open('POST', 'php/get_admin_info.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<tr>" +
                    "<td>" + data[i].adminname + "</td>" +
                    "<td>" +
                    "<p>" + data[i].email + "</p>" +
                    "</td>" +
                    "<td>" + data[i].mobile + "</td>" +
                    "<td>" + data[i].dateadded + "</td>" +
                    "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;
            }
        }
    }

    xhr.send(params);

    var table = document.getElementById('tableContainer');

    table.addEventListener("scroll", function() {
        var y = table.scrollTop + table.offsetHeight;

        if (y >= table.scrollHeight) {
            offset += 4;

            xhr.open('POST', 'php/get_user_info.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                
                    }
                }
            }
            
            xhr.send(params);
        }
    })
}

function showApplicantDetails(validID, email, applicant) {
    
    var output = "</div> <img id='validID' src='" + validID + "' alt=''>" +
    "<div class='buttons'>" +
    "<input type='button' value='ACCEPT' onclick=\"acceptApplicant(this.value,'" + email + "', '" + applicant + "')\">" + 
    "<input type='button' value='REJECT' onclick=\"acceptApplicant(this.value,'" + email + "', '" + applicant + "')\")\">";
   
    document.getElementById('imgContainer').innerHTML += output;
    document.getElementById('userWrapper').style.display = 'block';
}

function acceptApplicant(value, email, applicant) {
    var xhr = new XMLHttpRequest();
    var param = "value=" + value + "&email=" + email + "&applicant=" + applicant;
    xhr.open('POST','php/accept_applicant.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status == 200) {
            
        }
    }
    
    xhr.send(param);
}

// Not finish, we need to get picture
function showAdminInfo() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST","php/admin/admin_info.php", true);

    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != null && this.responseText != '') {
                var data = JSON.parse(this.responseText);
                document.getElementById('profilePic').src = data[0].adminimg;
                document.getElementById('firstName').value = data[0].fname;
                document.getElementById('lastName').value = data[0].lname;
                document.getElementById('mobileNumber').value = data[0].mobile;
                document.getElementById('emailAddress').value = data[0].email;
            }
        }
    }

    xhr.send();
}

function showPreviewImage(event) {
    var output = document.getElementById('profilePic');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }
}