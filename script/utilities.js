function addToCart(productid, branchid) {
    
    var xhr = new XMLHttpRequest();
    var param = 'productid=' + productid + '&addQuantity=' + 3 + "&branchid=" + branchid;

    xhr.open('POST', 'php/add_to_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText == 'false') {
                window.location = 'login.php';
                return false;
            }else {
                onLoadCart();
            }
         
        }
    }

    xhr.send(param);
    
}

function addToCartDescription(productid, branchid) {
    
    var quantity = document.getElementById('cartDescriptionQuantity').value;
    
    var xhr = new XMLHttpRequest();
    var param = 'productid=' + productid + '&addQuantity=' + 3 + '&descriptionquantity=' + quantity + '&branchid=' + branchid;

    xhr.open('POST', 'php/add_to_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText == 'false') {
                window.location = 'login.php';
                return false;
            }else {
                onLoadCart();
            }
         
        }
    }

    xhr.send(param);
    
}

function addToWishlist(productid, i, isShowDescription, branchid) {

    var xhr = new XMLHttpRequest();
    var param = 'productid=' + productid + "&branchid=" + branchid;

    xhr.open('POST', 'php/add_to_wishlist.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {

        if (this.status == 200) {
            if (this.responseText == 'false') {
                alert('An error occured in contacting the server');
            }else if(this.responseText == 'deleted' && isShowDescription == false){
                document.getElementById(productid).style.filter = 'none';
            }else if(this.responseText == 'added' && isShowDescription == false){
                document.getElementById(productid).style.filter = 'invert(36%) sepia(98%) saturate(3866%) hue-rotate(334deg) brightness(109%) contrast(101%)';
            }else if(isShowDescription == true){
                if(this.responseText == 'deleted'){
                    document.getElementById(i).style.filter = 'none';
                    document.getElementById(productid).style.filter = 'none';
                }else if(this.responseText == 'added'){
                    document.getElementById(i).style.filter = 'invert(36%) sepia(98%) saturate(3866%) hue-rotate(334deg) brightness(109%) contrast(101%)';
                    document.getElementById(productid).style.filter = 'invert(36%) sepia(98%) saturate(3866%) hue-rotate(334deg) brightness(109%) contrast(101%)';
                }else {
                    window.location = "login.php";
                }
            }else{
                window.location = "login.php";
            }
        

        }
    }

    xhr.send(param);
}

function buyNow(productid, branchid) {
    
    window.location = "checkout.php";
    var xhr = new XMLHttpRequest();
    var param = 'productid=' + productid + "&branchid=" + branchid;

    xhr.open('POST', 'checkout.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(param);

}

function buyNowDescription(productid, branchid) {

    var quantity = document.getElementById('cartDescriptionQuantity').value;

    window.location = "checkout.php";
    var xhr = new XMLHttpRequest();
    var param = 'productid=' + productid + "&quantity=" + quantity + "&branchid=" + branchid;

    xhr.open('POST', 'checkout.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(param);

}

function loadCheckout(productid, isMultipleQuantity, quantity, branchid) {

    if(isMultipleQuantity == 0){
        quantity = 1;
    }

    var xhr = new XMLHttpRequest();
    var param = 'productid=' + productid + "&branchid=" + branchid;

    onLoadCart();

    xhr.open('POST', 'php/load_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status == 200) {
            
            var data = JSON.parse(this.responseText);
            var output = "";
            var output2 = "";
            var totalprice = 0.0;
    
            for (var i in data) {
                
                if (data[i].productimg !== undefined && data[i].price !== undefined && data[i].productname !== undefined && data[i].quantity !== undefined) {
                    
                    output += "<div class='view-cart-item'>" +
                    "<div class='view-cart-image-container'>" +
                        "<img src= " + data[i].productimg + " alt=''>"+
                    "</div>" + 
                    "<div class='view-cart-item-information-wrapper'>" +
                        "<div class='view-cart-item-information'>" +
                            "<div class='view-cart-item-price'>" +
                                "<p class='view-cart-product-name'> " + data[i].productname + " </p>" +
                                "<p class='view-cart-product-price'>&#8369; " + data[i].price + "</p>" +
                            "</div>" +
                            "<div class='view-cart-button-wrapper'>" +
                                "<div class='view-cart-button-container-quantity'>" +
                                    "<p>Qty: " + quantity + "</p>" + 
                                    "<input type='hidden' name='quantity[]' value='" + quantity + "'/>" +
                                "</div>" +
                            "</div>" +
                            "<div class='view-cart-total-price'>" +
                                "<p>&#8369;"+ quantity * data[i].price +"</p>" +
                                "<input type='hidden' name='itemTotalPrice[]' value='" + quantity * data[i].price + "'/>" +
                                "<input type='hidden' name='productid[]' value='" + data[i].productID + "'/>" + 
                                "<input type='hidden' name='branchid[]' value='" + data[i].branchID + "'/>" + 
                            "</div>" +
                        "</div>" + 
                    "</div>" + 
                "</div>";
                    totalprice += quantity * data[i].price;
                }

                if(data[i].customername !== undefined) {
                    output2 +=  "<h1>Order Summary</h1>" +
                    "<div class='wrapper-bill-info'>" +
                    "<div class='container-bill-info'> " + 
                        "<h4>Billing Information</h4> " + 
                        "<p>" + data[i].customername + "</p> " + 
                        "<p><span>HOME:</span> " + data[i].customeraddress + "</p> " + 
                        "<p><img src='images/Icon/phone-call.png' alt='' width='16'> " + data[i].mobilenumber + "</p> " + 
                        "<p><img src='images/Icon/email.png' alt='' width='16'> " + data[i].emailaddress + "</p> " + 
                    "</div>" + 
                "</div>" +
                    "<div class='wrapper-voucher'>" +
                        "<div class='container-voucher'>" +
                            "<h4>Apply Voucher</h4>" +
                            "<input type='text' placeholder='Enter Voucher Code'>" +
                            "<input type='button' value='APPLY VOUCHER'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='wrapper-voucher'>" +
                        "<div class='container-subtotal'>" +
                            "<h4>Summary</h4>" +
                            "<p>Subtotal: &#8369;"+ totalprice +"</p>"+
                            "<input type='hidden' name='subtotal' value='" + totalprice +"'/>" +
                            "<p>Delivery Fee: &#8369;40.00</p>"+
                            "<input type='hidden' name='deliveryFee' value='" + 40.00 + "'/>" +
                            "<p>Total <sub>(Vat included)</sub>: &#8369;"+ parseFloat(totalprice + 40.00) +"</p>"+
                            "<input type='hidden' name='totalPrice' value='" + parseFloat(totalprice + 40.00) + "'/>" +
                            "<input type='submit' value='PLACE ORDER' id='placeOrder'>"+
                        "</div>"
                    "</div>";

                    document.getElementById('view-cart-container').innerHTML += output;
                    document.getElementById('view-cart-voucher-container').innerHTML = output2;
                }
                    
                
            }
        }
    }

    xhr.send(param);

}

function multipleCheckout() {
    
    var xhr = new XMLHttpRequest();
    onLoadCart();
    xhr.open('POST', 'php/multi_checkout.php', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (this.status == 200 && this.responseText !== '') {
            var data = JSON.parse(this.responseText);
            var output = "";
            var output2 = "";
            var totalprice = 0.0;
            
            for (var i in data) {
                if (data[i].productimg !== undefined && data[i].price !== undefined && data[i].productname !== undefined && data[i].quantity !== undefined) {
                    
                    output += "<div class='view-cart-item'>" +
                    "<div class='view-cart-image-container'>" +
                        "<img src= " + data[i].productimg + " alt=''>"+
                    "</div>" + 
                    "<div class='view-cart-item-information-wrapper'>" +
                        "<div class='view-cart-item-information'>" +
                            "<div class='view-cart-item-price'>" +
                                "<p class='view-cart-product-name'> " + data[i].productname + " </p>" +
                                "<p class='view-cart-product-price'>&#8369; " + data[i].price + "</p>" +
                            "</div>" +
                            "<div class='view-cart-button-wrapper'>" +
                                "<div class='view-cart-button-container-quantity'>" +
                                    "<p>Qty: " + data[i].quantity + "</p>" + 
                                    "<input type='hidden' name='quantity[]' value='" + data[i].quantity + "'/>" +
                                "</div>" +
                            "</div>" +
                            "<div class='view-cart-total-price'>" +
                                "<p>&#8369;"+ data[i].quantity * data[i].price +"</p>" +
                                "<input type='hidden' name='itemTotalPrice[]' value='" + data[i].quantity * data[i].price + "'/>" +
                                "<input type='hidden' name='productid[]' value='" + data[i].productID + "'/>" + 
                                "<input type='hidden' name='branchid[]' value='" + data[i].branchID + "'/>" + 
                            "</div>" +
                        "</div>" + 
                    "</div>" + 
                "</div>";
                    totalprice += data[i].quantity * data[i].price;
                }
                
                if(i == data.length - 1 && data[i].customername !== undefined) {

                    output2 +=  "<h1>Order Summary</h1>" +
                    "<div class='wrapper-bill-info'>" +
                    "<div class='container-bill-info'> " + 
                        "<h4>Billing Information</h4> " + 
                        "<p>" + data[i].customername + "</p> " + 
                        "<p><span>HOME:</span> " + data[i].customeraddress + "</p> " + 
                        "<p><img src='images/Icon/phone-call.png' alt='' width='16'> " + data[i].mobilenumber + "</p> " + 
                        "<p><img src='images/Icon/email.png' alt='' width='16'> " + data[i].emailaddress + "</p> " + 
                    "</div>" + 
                "</div>" +
                    "<div class='wrapper-voucher'>" +
                        "<div class='container-voucher'>" +
                            "<h4>Apply Voucher</h4>" +
                            "<input type='text' placeholder='Enter Voucher Code'>" +
                            "<input type='button' value='APPLY VOUCHER'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='wrapper-voucher'>" +
                        "<div class='container-subtotal'>" +
                            "<h4>Summary</h4>" +
                            "<p>Subtotal: &#8369;"+ totalprice +"</p>"+
                            "<input type='hidden' name='subtotal' value='" + totalprice + "'/>" +
                            "<p>Delivery Fee: &#8369;40.00</p>"+
                            "<input type='hidden' name='deliveryFee' value='" + 40.00 + "'/>" +
                            "<p>Total <sub>(Vat included)</sub>: &#8369;"+ parseFloat(totalprice + 40.00) +"</p>"+
                            "<input type='hidden' name='totalPrice' value='" + parseFloat(totalprice + 40.00) + "'/>" +
                            "<input type='submit' value='PLACE ORDER' id='placeOrder'>"+
                        "</div>"
                    "</div>";

                    document.getElementById('view-cart-container').innerHTML += output;
                    document.getElementById('view-cart-voucher-container').innerHTML = output2;
                }
                    
            }
        }else if(this.responseText == 'error'){
            alert('An error occurred contacting the database');
        }else{
            alert('Please choose an item to checkout');
            window.location = 'view_cart.php';
        }
    }

    xhr.send();

}

function onLoadCart() {
    
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
                                "<button onclick=\"addQuantity('" + data[i].productid + "', 0,"+ data[i].quantity +", '" + data[i].branchid + "')\">-</button>" +
                                "<p id='itemQuantity'>"+data[i].quantity+"</p>" +
                                "<button onclick=\"addQuantity('" + data[i].productid + "', 1,"+ data[i].quantity +", '" + data[i].branchid + "')\">+</button>" +
                            "</div>" +
                            "<img src='images/Icon/trash.png' width=24 height=24 onclick=\"addQuantity('" + data[i].productid + "', 2,"+ data[i].quantity +", '" + data[i].branchid + "')\">" +
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
    
}

function onEditLoadCart(isCheckout) {


    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'php/load_cart.php', true);

    xhr.onload = function () {
        if (this.status == 200) {
    
            var data = JSON.parse(this.responseText);
            var output = "";
            var output2 = "";
            var totalprice = 0.0;
            var checkbox = "";
            for (var i in data) {


                if (data[i].productimg !== undefined && data[i].price !== undefined && data[i].productname !== undefined && data[i].quantity !== undefined) {
                   
                    if (data[i].inccheckout == 'true') {
                        checkbox =  "<form>" +
                        "<input type = 'checkbox' id=\"" + data[i].productid + "\" onchange = \"includeItem('" + data[i].productid + "', '" + data[i].branchid + "')\" checked>" +
                        "</form>";
                    }else if(data[i].inccheckout == 'false'){
                        checkbox =  "<form>" +
                            "<input type = 'checkbox' id=\"" + data[i].productid + "\" onchange = \"includeItem('" + data[i].productid + "','" + data[i].branchid + "')\">" +
                            "</form>";
                    }

                    totalprice += data[i].quantity * data[i].price;
                    output += "<div class='view-cart-item'>" +
                    "<div class='view-cart-image-container'>" +
                        checkbox +
                        "<img src= " + data[i].productimg + " alt=''>"+
                    "</div>" + 
                    "<div class='view-cart-item-information-wrapper'>" +
                        "<div class='view-cart-item-information'>" +
                            "<div class='view-cart-item-price'>" +
                                "<p class='view-cart-product-name'> " + data[i].productname + " </p>" +
                                "<p class='view-cart-product-price'>&#8369; " + data[i].price + "</p>" +
                            "</div>" +
                            "<div class='view-cart-button-wrapper'>" +
                                "<div class='view-cart-button-container-quantity'>" +
                                    "<button onclick=\"addQuantity('" + data[i].productid + "', 0,"+ data[i].quantity +", '" + data[i].branchid + "')\">-</button>" +
                                    "<p id='itemQuantity'>"+data[i].quantity+"</p>" +
                                    "<button onclick=\"addQuantity('" + data[i].productid + "', 1,"+ data[i].quantity +", '" + data[i].branchid + "')\">+</button>" +
                                "</div>" +
                                "<img src='images/Icon/trash.png' width=24 height=24 onclick=\"addQuantity('" + data[i].productid + "', 2,"+ data[i].quantity +", '" + data[i].branchid + "')\">" +
                            "</div>" +
                            "<div class='view-cart-total-price'>" +
                                "<p>&#8369;"+ data[i].quantity * data[i].price +"</p>" +
                            "</div>" +
                        "</div>" + 
                    "</div>" + 
                "</div>";
                    if (i == data.length - 2) {
                        output2 +=  "<h1>Order Summary</h1>" +
                    "<div class='wrapper-voucher'>" +
                        "<div class='container-voucher'>" +
                            "<h4>Apply Voucher</h4>" +
                            "<input type='text' placeholder='Enter Voucher Code'>" +
                            "<input type='button' value='APPLY VOUCHER'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='wrapper-voucher'>" +
                        "<div class='container-subtotal'>" +
                            "<h4>Summary</h4>" +
                            "<p>Subtotal: &#8369;"+ totalprice +"</p>"+
                            "<p>Delivery Fee: &#8369;40.00</p>"+
                            "<p>Total <sub>(Vat included)</sub>: &#8369;"+ parseFloat(totalprice + 40.00) +"</p>"+
                            "<a href='checkout.php'><input type='button' value='CHECKOUT' id='checkout' onclick='multipleCheckout()'></a>"+
                        "</div>"
                    "</div>";
                    }
                }
            }   

            document.getElementById('view-cart-container').innerHTML = output;
            document.getElementById('view-cart-voucher-container').innerHTML = output2;

            onLoadCart();

        }
    }

    xhr.send();
    
}

function showDescription(productid, branchid) {
    
    var xhr = new XMLHttpRequest();
    var param = 'productid=' + productid + "&showDescription=" + true + "&branchid=" + branchid;

    xhr.open('POST', 'php/load_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status == 200) {
            var data = JSON.parse(this.responseText);
            var output = "";

        for (var i in data) {
            if (data[i].productimg !== undefined && data[i].price !== undefined && data[i].productname !== undefined && data[i].quantity !== undefined) {

                var wishlist = document.getElementById(productid).style.filter;
                var wishlistBtnColor = "";

                if (wishlist == 'invert(36%) sepia(98%) saturate(3866%) hue-rotate(334deg) brightness(109%) contrast(101%)') {
                    wishlistBtnColor = "<img id='" + i + "' class='wishlist' src='images/Icon/heart.png' width='32' height='32' onclick=\" addToWishlist('" + productid + "','" + i + "', true, '" + branchid + "')\" style='filter: invert(36%) sepia(98%) saturate(3866%) hue-rotate(334deg) brightness(109%) contrast(101%);'>";
                }else {
                    wishlistBtnColor = "<img id='" + i + "' class='wishlist' src='images/Icon/heart.png' width='32' height='32' onclick=\" addToWishlist('" + productid + "','" + i + "', true, '" + branchid + "')\">";
                }

                output += "<input type='button' id='cancelButton' onclick='removeDescription()'>" +
                "<div class='container' id='description'>" +
                    "<div class='cancel'>" +
                        "<label for='cancelButton'>" +
                            "<img src='images/Icon/cancel.png' id='cancel' alt='' width='32'>" +
                        "</label>" +
                    "</div>" +
                    "<div class='product-information'>"+
                        "<div class='wrapper'>" +
                            "<div class='image'>" +
                                "<img src=\"" + data[i].productimg + "\" alt=''>" +
                            "</div>" +
                        "</div>" +
                        "<div class='title'>" +
                            "<div class='product-name'>" +
                                "<h1>" + data[i].productname + "</h1>" +
                            "</div>"+
                            "<div class='rating'>" +
                                "<i class='fa fa-star'></i>" +
                                "<i class='fa fa-star'></i>" +
                                "<i class='fa fa-star'></i>" +
                                "<i class='fa fa-star'></i>" +
                                "<i class='fa fa-star-o'></i>" +
                                wishlistBtnColor +
                            "</div>" +
                            "<div class='price'>" +
                                "<p>&#8369;" + data[i].price + "<sup>Stocks: "+ data[i].quantity +"</sup></p>" +
                            "</div>" +
                            "<div class='buttons'>" +
                                "<div class='button-container-quantity'>" +
                                "<button onclick=\"addCartDescription(0)\">-</button>" +
                                "<input id='cartDescriptionQuantity' type='text' value='1' onkeydown='return isNumber(event);'/>" +
                                "<button onclick=\"addCartDescription(1)\">+</button>" +
                                "</div>" +
                                "<input type='button' value='BUY NOW' onclick=\"buyNowDescription('" + productid + "', '" + branchid + "')\">" +
                                "<input type='button' value='ADD TO CART' onclick=\"addToCartDescription('" + productid + "','" + branchid + "')\">" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                    "<div class='description-rating-wrapper'>" +
                        "<div class='container-rate'>" +
                            "<input type='button' value='DESCRIPTION'>" +
                            "<input type='button' value='RATING & REVIEW'>" +
                            "<div id='description-container'>" + data[i].productdescription + "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>";
                }
            }

            document.getElementById('description-wrapper').innerHTML = output;
            document.getElementById('description').style.display = 'grid';
            document.getElementById('main').style.filter = 'blur(2px)';
        }
    }

    xhr.send(param);

}

function addCartDescription(isAddQuantity) {
    var value = document.getElementById('cartDescriptionQuantity').value;

    if (isAddQuantity == 0 && value > 1) {
        document.getElementById('cartDescriptionQuantity').value = parseInt(value) - 1;
    }else if(isAddQuantity == 1){
        document.getElementById('cartDescriptionQuantity').value = parseInt(value) + 1;
    }

  
}

function isNumber(evt) {

    var text = document.getElementById('cartDescriptionQuantity').value;

    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode >= 96 && charCode <= 105 || (charCode >= 48 && charCode <= 57) || charCode == 8) {
        if (text.length == 0 && (charCode == 96 || charCode == 48)) {
            document.getElementById('cartDescriptionQuantity').value = 1;
            return false;
        }
        return true;
    }

    return false;
}

function removeDescription() {
    document.getElementById('description').style.display = 'none';
    document.getElementById('main').style.filter = 'blur(0)';
}

function includeItem(productid, branchid) {
    var checkbox = document.getElementById(productid);
    
    var xhr = new XMLHttpRequest();
    var param = "productid=" + productid + "&ischecked=" + checkbox.checked + "&branchid=" + branchid;
    xhr.open('POST', 'php/tmp_storage.php', true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText === false) {
                window.location = "login.php";
            }else if(this.responseText == 'error'){
                alert("An error occured in contacting the database");
            }
        }
    }

    xhr.send(param);
}

function addQuantity(productid, isAddQuantity, quantity, branchid) {
   
    var isRemove;
    if (isAddQuantity == 2) {
        isRemove = confirm('Remove from cart: Item(s) will be removed from order');

        if (isRemove) {
            var xhr = new XMLHttpRequest();
            var param = "productid=" + productid + "&addQuantity=" + isAddQuantity + "&quantity=" + quantity + "&branchid=" + branchid;

            xhr.open('POST', 'php/add_to_cart.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status == 200) {
                    onEditLoadCart();
                    onLoadCart();
                }
            }

            xhr.send(param);
        }

    }else {
        var xhr = new XMLHttpRequest();
        var param = "productid=" + productid + "&addQuantity=" + isAddQuantity + "&quantity=" + quantity + "&branchid=" + branchid;

        xhr.open('POST', 'php/add_to_cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status == 200) {
                onEditLoadCart();
                onLoadCart();   
            }
        }

        xhr.send(param);
    }

    

}