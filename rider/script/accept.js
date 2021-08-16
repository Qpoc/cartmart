function acceptCustOrder(transactionid) {
    document.getElementById(transactionid).innerHTML = "<img src=\"images/icon/accept.png\" alt='' style='filter: invert(82%) sepia(54%) saturate(3213%) hue-rotate(91deg) brightness(107%) contrast(109%);'>";

    var xhr = new XMLHttpRequest();
    var param = "transactionid=" + encodeURIComponent(transactionid);
    xhr.open('POST', 'php/proc_acc_order.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(param);

}

function loadAcceptedOrders() {

    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;

    xhr.open('POST', 'php/get_acc_order.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";
                var modepayment = "";
                var img_path = "";

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

                    output += "<div class='status-update'>" +
                    "<select name='' onchange=\"updateStatus(this.value, '" + data[i].transactionID + "')\">" +
                    "<option value='' selected hidden>Update " + data[i].personname + "</option>" +
                    "<option value='On the way to mall'>On the way to mall</option>" +
                    "<option value='Gathering'>Gathering your groceries</option>" +
                    "<option value='On the way to your home'>On the way to your home</option>" +
                    "<option value='Delivered'>Delivered</option>" +
                    "</select>" +
                    "</div>"+"<div class='transaction'>" +
                    "<div class='reports'>" +
                    "<div class='profile'> " +
                    "<div class='customer-img'> " +
                    "<img src='" + img_path + "' alt=''> " +
                    "</div> " +
                    "<div class='information'> " +
                    "<h4>" + data[i].personname + "</h4> " +
                    "<p>" + data[i].customeraddress + "</p> " +
                    "<p>" + data[i].mobilenumber + " " + data[i].emailaddress + "</p> " +
                    "<p>MOP: " + modepayment + "</p>" +
                    "</div> " +
                    "<div class='button' id='buttonContainer'> " +
                    "<input type='button' value='DETAILS' onclick=\"showOrderDetails('" + data[i].transactionID + "', '" + data[i].customerID + "')\"> " +
                    "<input type='button' value='CANCEL'>" +
                    "<img src='images/icon/message.png' alt='' onclick=\"showChatBox('" + data[i].transactionID + "', '" + data[i].customerID + "')\">" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
                }

                document.getElementById('acceptedCustContainer').innerHTML += output;

            }
        }
    }

    xhr.send(param);

    var container = document.getElementById('acceptedCustContainer');

    container.addEventListener("scroll", function() {
        var y = container.scrollTop + container.offsetHeight;

        if (y >= container.scrollHeight) {
            
        }
    })

}

function updateStatus(value, transactionid) {
    var xhr = new XMLHttpRequest();
    var param = "value=" + encodeURIComponent(value) + "&transactionid=" + transactionid;

    xhr.open('POST','php/update_status.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.send(param);
}