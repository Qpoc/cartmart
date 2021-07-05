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
                    "<td>" + data[i].customername + "</td>" +
                    "<td>" +
                    "<p>" + data[i].customeraddress + "</p>" +
                    "</td>" +
                    "<td>" + data[i].emailaddress + "</td>" +
                    "<td>" + data[i].dateadded + "</td>" +
                    "<td><input type='button' value='VIEW DETAILS' onclick=\"showUserDetails('" + data[i].customerpassword + "', '" + data[i].customerusername +  "', '" + data[i].mobilenumber + "')\"></td>" +
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

function showUserDetails(password, username, number) {
    var output = "<tr>" +
    "<td><input type='text' value=\"" + username + "\" id='username'></td>" +
    "<td><input type='password' value=\"" + password + " \" id='passowrd'></td>" +
    "<td><input type='text' value=\"" + number +  "\" id='mobileNum'></td>" +
    "<td>" +
    "<div class='button'>" +
        "<input type='button' value='SAVE CHANGES'>" +
        "<input type='button' value='VIEW CART'>" +
        "</div>" +
        "</td>" +
        "</tr>";
    document.getElementById('userDetails').innerHTML = output;
    document.getElementById('userWrapper').style.display = 'block';
}

function hideUserDetails() {
    document.getElementById('userWrapper').style.display = 'none';
}