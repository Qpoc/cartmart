function loadCartUserInfo(pageName) {

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'php/load_cart.php', true);

    xhr.onload = function () {
        if (this.status == 200) {
            var data = JSON.parse(this.responseText);
            var output = "";
            var output2 = "";
            var totalprice = 0.0;
            for (var i in data) {
                if (data[i].productimg !== undefined && data[i].price !== undefined && data[i].productname !== undefined && data[i].quantity !== undefined) {
                    output += "<div class='cart-item'> <div class='image-container'> " + 
                    "<img src= " + data[i].productimg + "  alt=''>" +
                "</div>" +
                "<div class='item-information-wrapper'>"+
                    "<div class='item-information'>" +
                        "<p>&#8369; " + data[i].price + "</p>" +
                        "<p class='product-name'>"+data[i].productname+"</p>" +
                        "<div class='button-wrapper'>" +
                            "<div class='button-container-quantity'>" +
                                "<button onclick=\"addQuantity('" + data[i].productid + "', 0,"+ data[i].quantity +")\">-</button>" +
                                "<p id='itemQuantity'>"+data[i].quantity+"</p>" +
                                "<button onclick=\"addQuantity('" + data[i].productid + "', 1,"+ data[i].quantity +")\">+</button>" +
                            "</div>" +
                            "<img src='images/Icon/trash.png' width=24 height=24 onclick=\"addQuantity('" + data[i].productid + "', 2,"+ data[i].quantity +")\">" +
                        "</div>" +
                    "</div>" +
                "</div>" +
                "</div>";
                    totalprice += data[i].price * data[i].quantity;
                }
            }
            
            if (data[0].total == 0) {
                output2 = " <h4>Your Cart is Empty</h4>";
            }else {
                output2 = " <h4>Subtotal: &#8369; " + totalprice + "</h4>" +
                "<div class='buttons'>" + 
                    "<a href='view_cart.php'><button>EDIT CART</button></a>" +
                "</div>";
            }
                

            document.getElementById('cart-item-wrapper').innerHTML = output;
            document.getElementById('button-container').innerHTML = output2;
            document.getElementById('cart-quantity').innerHTML = data[i].total;
        }
    }

    xhr.send();

    if (pageName != 'wishlist') {
        getUserInformation(pageName);
    }else if(pageName == 'wishlist'){
        getUserWishList();
    }
    
}

function getUserInformation(pageName) {
    
    var xhr = new XMLHttpRequest();
    
    xhr.open('POST', 'php/user_settings/get_user_info.php', true);

    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                
                if (pageName == 'manage') {
                    document.getElementById('name').innerHTML = 'Hi, ' + data[0].customername;
                    document.getElementById('editName').innerHTML = data[0].customername;
                    document.getElementById('email').innerHTML = data[0].emailaddress;
                    document.getElementById('bookName').innerHTML = data[0].customername;
                    document.getElementById('bookAddress').innerHTML = data[0].customeraddress;
                    document.getElementById('bookCellNum').innerHTML = "(+63) " + data[0].mobilenumber;
                }else if (pageName == 'profile'){
                    document.getElementById('name').innerHTML = 'Hi, ' + data[0].customername;
                    document.getElementById('profileName').innerHTML = data[0].customername;
                    document.getElementById('addressEmail').innerHTML = data[0].emailaddress;
                    document.getElementById('cellNum').innerHTML = data[0].mobilenumber;
                }else if (pageName == 'address'){
                    document.getElementById('name').innerHTML = 'Hi, ' + data[0].customername;
                    document.getElementById('infoName').innerHTML = data[0].customername;
                    document.getElementById('infoAddress').innerHTML = data[0].customeraddress;
                    document.getElementById('cellNum').innerHTML = data[0].mobilenumber;
                }
            }else {
                window.location = 'main_settings.php';
            }
        }
    }

    xhr.send();

}

function getUserWishList() {
   
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'php/user_settings/get_user_wish.php', true);

    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<tr id='" + data[i].productID + "'>" +
                    "<td data-label='Items'>" +
                    "<div class='product-container'>" +
                    "<img src='" + data[i].productimg + "' alt=''>" +
                    "</div>" +
                    "<p>" + data[i].productname + " <img src='images/Icon/trash.png' alt='' width='16' height='16' onclick=\"deleteWishlist('" + data[i].productID + "')\"></p>" +
                    "</td>" +
                    "<td data-label='Total'><input type='button' value='REVIEW'></td>" +
                    "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;

            }else{
                window.location = 'main_settings.php';
            }
        }
    }

    xhr.send();
}

function deleteWishlist(productID) {

    var xhr = new XMLHttpRequest();
    var param = "productid=" + productID;
    
    xhr.open('POST', 'php/user_settings/del_wishlist.php', true);
    
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status == 200) {
            alert(this.responseText);
            getUserWishList();
        }
    }

    xhr.send(param);
    
}

function selectedSetting(value) {

    this.pageName = value;

    if (value == 'logout') {
        window.location = 'php/logout.php';
    }else if(value == 'manage') {
        window.location = 'main_settings.php';
    }else if(value == 'profile'){
        window.location = 'profile.php';
    }else if(value == 'address'){
        window.location = 'address.php';
    }else if(value == 'voucher'){
        window.location = 'voucher.php';
    }else if(value == 'order'){
        window.location = 'my_orders.php';
    }else if(value == 'review'){
        window.location = 'review.php';
    }else if(value == 'wishlist'){
        window.location = 'wishlist.php';
    }else if(value == 'cancellation'){
        window.location = 'cancellation.php';
    }
   
}
