var id;

function showChatBox(transactionid, customerid) {
    document.getElementById('chatBox').style.display = 'block';
    
    document.getElementById('chatBox').innerHTML = "<div class='back'>" +
    "<img src='images/icon//back.png' alt='' onclick='hideChatBox()'>" +
    "</div>" +
    "<div class='container' id='" + transactionid + "'>" +
    "</div>" +
    "<div class='textfield' id='textfieldContainer'>" +
    "</div>";

    document.getElementById('textfieldContainer').innerHTML = "<textarea name='' id='message'></textarea><img src='images/icon/send.png' alt='' onclick=\"sendMessage('" + transactionid + "', '" + customerid + "')\">";
    fetchMessages(transactionid, customerid);
}

function hideChatBox() {
    document.getElementById('chatBox').style.display = 'none';
}

function sendMessage(transactionid, customerid) {
    var message = document.getElementById('message').value;
    var xhr = new XMLHttpRequest();
    var param = "message=" + message + "&customerid=" + customerid + "&transactionid=" + transactionid;

    xhr.open('POST','php/send_msg.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    document.getElementById(transactionid).innerHTML += "<div class='rider'>" +
    "<p>" + message + "</p>" +
    "</div>";
    document.getElementById('message').value = "";

    var container = document.getElementById(transactionid);
    container.scrollTop = container.scrollHeight;
    
    xhr.send(param);
}

function fetchMessages(transactionid, customerid) {

    var offset = 0;
    clearInterval(id);
    id = setInterval(function () {
        var xhr = new XMLHttpRequest();
        var param = "offset=" + offset + "&customerid=" + customerid + "&transactionid=" + transactionid;
        xhr.open('POST', 'php/retrieve_msg.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                if (this.responseText != '') {
                    var data = JSON.parse(this.responseText);
                    var output = "<div class='customer'>" +
                        "<p>" + data[0].txtmessage + "</p>" +
                    "</div>";
                    
                    offset += 1;
                    
                    document.getElementById(transactionid).innerHTML += output;
                }
            }
        }

        xhr.send(param);
        
    }, 2000)


}

function stopInterval() {
    clearInterval(id);
}

function loadCustomerOrders() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;

    xhr.open('POST', 'php/get_un_order.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";
                var img_path = "";
                var modepayment = "";

                for (var i in data) {

                    if (data[i].customerimg == null) {
                        img_path = "../images/user_profile/default.png";
                    }else if (data[i].customerimg != null) {
                        img_path = "../" + data[i].customerimg;
                    }

                    if (data[i].modepayment == "COD") {
                        modepayment = "Cash on Delivery";
                    }else if(data[i].modepayment == "credit"){
                        modepayment = "Online Payment";
                    }

                    output += "<div class='reports'>" +
                    "<div class='profile'> " +
                    "<div class='customer-img'> " +
                    "<img src='" + img_path + "' alt=''> " +
                    "</div> " +
                    "<div class='information'> " +
                    "<h4>" + data[i].customername + "</h4> " +
                    "<p>" + data[i].customeraddress + "</p> " +
                    "<p>" + data[i].mobilenumber + " " + data[i].emailaddress + "</p> " +
                    "<p>MOP: " + modepayment + "</p>" + 
                    "</div> " +
                    "<div class='button' id='" + data[i].transactionID + "'> " +
                    "<input type='button' value='DETAILS' onclick=\"showOrderDetails('" + data[i].transactionID + "', '" + data[i].customerID + "')\"> " +
                    "<input type='button' value='ACCEPT' onclick=\"acceptCustOrder('" + data[i].transactionID + "')\"> " +
                    "</div> " +
                    "</div> " +
                    "</div>";
                }

                document.getElementById('orderContainer').innerHTML += output;

            }
        }
    }

    xhr.send(param);

    var container = document.getElementById('transactionContainer');

    container.addEventListener("scroll", function() {
        
        var y = container.scrollTop + container.offsetHeight;

        if (y >= container.scrollHeight) {
            offset += 5;
            
            xhr.open('POST', 'php/get_un_order.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                        var data = JSON.parse(this.responseText);
                        var output = "";
                        var img_path = "";

                        for (var i in data) {
                            if (data[i].customerimg == null) {
                                img_path = "../images/user_profile/default.png";
                            }else if (data[i].customerimg != null) {
                                img_path = "../" + data[i].customerimg;
                            }

                            output += "<div class='reports'>" +
                            "<div class='profile'> " +
                            "<div class='customer-img'> " +
                            "<img src='" + img_path + "' alt=''> " +
                            "</div> " +
                            "<div class='information'> " +
                            "<h4>" + data[i].customername + "</h4> " +
                            "<p>" + data[i].customeraddress + "</p> " +
                            "<p>" + data[i].mobilenumber + " " + data[i].emailaddress + "</p> " +
                            "</div> " +
                            "<div class='button' id='buttonContainer'> " +
                            "<input type='button' value='DETAILS' onclick=\"showOrderDetails('" + data[i].transactionID + "', '" + data[i].customerID + "')\"> " +
                            "<input type='button' value='ACCEPT' '" + data[i].transactionID + "'> " +
                            "</div> " +
                            "</div> " +
                            "</div>";
                        }

                        document.getElementById('orderContainer').innerHTML += output;

                    }
                }
            }

            xhr.send(param);
        }
    })
}

function showOrderDetails(transactionid, customerid) {
    window.location = "order_list.php";

    var xhr = new XMLHttpRequest();
    var param = "transactionid=" + transactionid + "&customerid=" + customerid;
    xhr.open('POST','order_list.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send(param);

}

function loadOrderList(transactionid, customerid) {
    var xhr = new XMLHttpRequest();
    var param = "transactionid=" + transactionid + "&customerid=" + customerid;
    xhr.open('POST', 'php/get_order_list.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "<div class='header'>" +
                "<h5>Ordered by: " + data[0].customername + "</h5>" +
                "</div>";

                for (var i in data) {
                   output += "<div class='reports'>" +
                   "<div class='profile'>" +
                   "<div class='customer-img'>" +
                   "<img src='../" + data[i].productimg + "' alt=''>" +
                   "</div>" +
                   "<div class='information'>" +
                   "<h4>"+ data[i].productname + "</h4>" +
                   "<p>&#8369;" + data[i].price + "</p>" +
                   "<div class='item-price'>" +
                   "<p>Qty: " + data[i].quantity + "</p>" +
                   "<p>Total: &#8369;" + data[i].itemprice + "</p>" +
                   "</div>" +
                   "</div>" +
                   "<div class='button'>" +
                   "<input type='button' value='ITEM DETAILS'>" +
                   "</div>" +
                   "</div>" +
                   "</div>";
                }

                output += "<div class='summary'>" +
                "<div class='container'>" +
                    "<h3>Summary</h3>" +
                    "<p>Subtotal: &#8369;" + data[data.length - 1].subtotal + "</p>" +
                    "<p>Delivery Fee: &#8369;" + data[data.length - 1].delfee + "</p>" +
                    "<p>Total <sub>(Vat included)</sub>: &#8369;" + data[data.length - 1].totalprice + "</p>" +
                "</div>" +
                "</div>";

                document.getElementById('transactionContainer').innerHTML += output;
            }
        }
    }

    xhr.send(param);

    // Ajax call scroll
}

function showPreviewImage(event) {
    console.log(event.target.files[0]);
    var output = document.getElementById('riderimg');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }

    document.getElementById('btnSubmit').click();
}