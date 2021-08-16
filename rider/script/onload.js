function loadData() {
    loadEarningsMonth();
    loadEarningsDay();
    loadBooksToday();
    loadPendingOrders();
    loadOngoingOrders();
}

function loadEarningsMonth(){
    var xhr = new XMLHttpRequest();
    var date = new Date();
    var month = date.getMonth();
    var param = 'month=' + month;

    xhr.open('POST', 'php/earnings/earnings_month.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    if (data[i].income != null) {
                        output += "&#8369;"+ data[i].income;
                    }else{
                        output += "&#8369;"+ 0;
                    }
                }

                document.getElementById('earnMonth').innerHTML = output;
            }
        }
    }

    xhr.send(param);
}

function loadEarningsDay(){
    var xhr = new XMLHttpRequest();
    var param = 'day=' + 'true';

    xhr.open('POST', 'php/earnings/earnings_month.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    if (data[i].income != null) {
                        output += "&#8369;"+ data[i].income;
                    }else{
                        output += "&#8369;"+ 0;
                    }
                }

                document.getElementById('earnDay').innerHTML = output;
            }
        }
    }

    xhr.send(param);
}

function loadBooksToday() {
    var xhr = new XMLHttpRequest();
    var param = 'book=' + 'true';

    xhr.open('POST', 'php/earnings/earnings_month.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += data[i].totalbooks;
                }

                document.getElementById('books').innerHTML = output;
            }
        }
    }

    xhr.send(param);
}

function loadPendingOrders() {
    var xhr = new XMLHttpRequest();
    var param = 'pending=' + 'true';

    xhr.open('POST', 'php/orders/order_details.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    if (data[i].pendingorder != 0 && data[i].pendingorder != null) {
                        output += "Pending orders: " + data[i].pendingorder + " - <a href='rider_order_list.php'>Details</a>";
                    }else {
                        output += "Pending orders: 0";
                    }
                }

                document.getElementById('pending').innerHTML = output;
            }
        }
    }

    xhr.send(param);
}

function loadOngoingOrders() {
    var xhr = new XMLHttpRequest();
    var param = 'ongoing=' + 'true';

    xhr.open('POST', 'php/orders/order_details.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200){
       
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    if (data[i].ongoingorder != 0 && data[i].ongoingorder != null) {
                        output += "Ongoing orders: " + data[i].ongoingorder + "/5 - <a href='accepted_cust.php'>Details</a>";
                    }else{
                        output += "Ongoing orders: 0";
                    }
                }

                document.getElementById('ongoing').innerHTML = output;
            }
        }
    }

    xhr.send(param);
}

function loadHistory() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;

    xhr.open('POST', 'php/history/hist_transact.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<div class='history'>" +
                    "<div class='header'>" +
                        "<h3>Transaction ID: " + data[i].transactionid + " <sup>Date: " + data[i].dateadded + "</sup></h3>" +
                        "</div>" +
                    "<div class='content'>" +
                        "<p>" + data[i].customername + "</p>" +
                        "<p>" + data[i].customeraddress + "</p>" +
                        "<p>Total: &#8369;" + data[i].totalprice + "</p>" +
                        "</div>" +
                    "</div>";
                }

                document.getElementById('historyContainer').innerHTML = output;
            }
        }
    }

    xhr.send(param);

    window.addEventListener("scroll", function () {
        
        var body = document.getElementById('body');
        var y = window.innerHeight + window.pageYOffset;
          
        if (y >= body.scrollHeight) {
            offset += 5;

            param = "offset=" + offset;

            xhr.open('POST', 'php/history/hist_transact.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.responseText != null && this.responseText.trim().length != 0) {
                        var data = JSON.parse(this.responseText);
                        var output = "";

                        for (var i in data) {
                            output += "<div class='history'>" +
                            "<div class='header'>" +
                                "<h3>Transaction ID: " + data[i].transactionid + " <sup>Date: " + data[i].dateadded + "</sup></h3>" +
                                "</div>" +
                            "<div class='content'>" +
                                "<p>" + data[i].customername + "</p>" +
                                "<p>" + data[i].customeraddress + "</p>" +
                                "<p>Total: &#8369;" + data[i].totalprice + "</p>" +
                                "</div>" +
                            "</div>";
                        }

                        document.getElementById('historyContainer').innerHTML += output;
                    }
                }
            }

            xhr.send(param);
        }

    });
}

function loadRiderDetails() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/riderprofile/load_profile.php", true);

    xhr.onload = function () {
        if (this.status == 200) {
    
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                

                for (var i in data) {
                    document.getElementById('riderimg').src = data[i].riderimg;
                    document.getElementById('fname').value = data[i].fname;
                    document.getElementById('lname').value = data[i].lname;
                    document.getElementById('email').value = data[i].email;
                    document.getElementById('number').value = data[i].mobile;
                    document.getElementById('date').value = data[i].dateadded;
                }


            }
        }
    }

    xhr.send();
}