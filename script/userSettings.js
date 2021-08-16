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
                        "<div class='item-information-wrapper'>" +
                        "<div class='item-information'>" +
                        "<p>&#8369; " + data[i].price + "</p>" +
                        "<p class='product-name'>" + data[i].productname + "</p>" +
                        "<div class='button-wrapper'>" +
                        "<div class='button-container-quantity'>" +
                        "<button onclick=\"addQuantity('" + data[i].productid + "', 0," + data[i].quantity + ")\">-</button>" +
                        "<p id='itemQuantity'>" + data[i].quantity + "</p>" +
                        "<button onclick=\"addQuantity('" + data[i].productid + "', 1," + data[i].quantity + ")\">+</button>" +
                        "</div>" +
                        "<img src='images/Icon/trash.png' width=24 height=24 onclick=\"addQuantity('" + data[i].productid + "', 2," + data[i].quantity + ")\">" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "</div>";
                    totalprice += data[i].price * data[i].quantity;
                }
            }

            if (data[0].total == 0) {
                output2 = " <h4>Your Cart is Empty</h4>";
            } else {
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

    if (pageName != 'wishlist' && pageName != 'track') {
        getUserInformation(pageName);
    } else if (pageName == 'wishlist') {
        getUserWishList();
        getUserInformation(pageName);
    } else if (pageName == 'track') {
        getTrackOrder();
        getUserInformation(pageName);
    }

}

function getTrackOrder() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;
    xhr.open('POST', 'php/product/get_track_order.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null) {
                var data = JSON.parse(this.responseText);
                var output = "";

                var isDeliver = "";

                for (var i in data) {
                    if (data[i].transactstatus != null && data[i].transactstatus != '' && data[i].transactstatus == 'Delivered') {
                        isDeliver = data[i].transactstatus;
                    } else {
                        isDeliver = "<input type='button' value='TRACK ORDER' onclick=\"trackMyOrder('" + data[i].transactionID + "', '" + data[i].email + "')\">";
                    }
                    output += "<tr>" +
                        "<td>" + data[i].transactionID + "</td>" +
                        "<td>" + data[i].subtotal + "</td>" +
                        "<td>" + data[i].delfee + "</td>" +
                        "<td>" + data[i].totalprice + "</td>" +
                        "<td>" + data[i].dateadded + "</td>" +
                        "<td>" + isDeliver + "</td>" +
                        "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;

            }
        }
    }

    xhr.send(param);

    var container = document.getElementById('orderContainer');
    container.addEventListener("scroll", function () {
        var y = container.scrollTop + container.offsetHeight;

        if (y >= container.scrollHeight) {
            offset += 6;
            param = "offset=" + offset;
            xhr.open('POST', 'php/product/get_track_order.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null) {
                        var data = JSON.parse(this.responseText);
                        var output = "";

                        var isDeliver = "";

                        for (var i in data) {
                            if (data[i].transactstatus != null && data[i].transactstatus != '' && data[i].transactstatus == 'Delivered') {
                                isDeliver = data[i].transactstatus;
                            } else {
                                isDeliver = "<input type='button' value='TRACK ORDER' onclick=\"trackMyOrder('" + data[i].transactionID + "', '" + data[i].email + "')\">";
                            }
                            output += "<tr>" +
                                "<td>" + data[i].transactionID + "</td>" +
                                "<td>" + data[i].subtotal + "</td>" +
                                "<td>" + data[i].delfee + "</td>" +
                                "<td>" + data[i].totalprice + "</td>" +
                                "<td>" + data[i].dateadded + "</td>" +
                                "<td>" + isDeliver + "</td>" +
                                "</tr>";
                        }

                        document.getElementById('tableBody').innerHTML += output;

                    }
                }
            }

            xhr.send(param);
        }
    });
}

function trackMyOrder(transactionid, email) {

    window.location = 'track_order.php';

    var xhr = new XMLHttpRequest();
    var param = "transactionid=" + transactionid + "&email=" + email;

    xhr.open('POST', 'track_order.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.send(param);
}

function getUserInformation(pageName) {

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'php/user_settings/get_user_info.php', true);

    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != 'error') {
                
                var data = JSON.parse(this.responseText);
                var points = 0;

                if (data[0].customerpoints != null) { 
                    points = data[0].customerpoints;
                }

                if (pageName == 'manage') {
                    
                    document.getElementById('name').innerHTML = 'Hi, ' + data[0].customername + "<sup style='margin-left: 10px; font-weight:normal; font-size:10px;'> You have: " + points + " points</sup>";
                    document.getElementById('editName').innerHTML = data[0].customername;
                    document.getElementById('email').innerHTML = data[0].emailaddress;
                    document.getElementById('bookName').innerHTML = data[0].customername;
                    document.getElementById('bookAddress').innerHTML = data[0].customeraddress;
                    document.getElementById('bookCellNum').innerHTML = "(+63) " + data[0].mobilenumber;
                } else if (pageName == 'profile') {
                    if (data[0].customerimg != null) {
                        document.getElementById('profilePic').src = data[0].customerimg;
                    } else if (data[0].customerimg == null) {
                        document.getElementById('profilePic').src = "images/user_profile/default.png";
                    }

                    document.getElementById('name').innerHTML = 'Hi, ' + data[0].customername + "<sup style='margin-left: 10px; font-weight:normal; font-size:10px;'> You have: " + points + " points</sup>";
                    document.getElementById('profileName').innerHTML = data[0].customername;
                    document.getElementById('addressEmail').innerHTML = data[0].emailaddress;
                    document.getElementById('cellNum').innerHTML = data[0].mobilenumber;
                    document.getElementById('birthday').value = data[0].birthday;
                    document.getElementById('gender').value = data[0].gender;
                } else if (pageName == 'address') {
                    document.getElementById('name').innerHTML = 'Hi, ' + data[0].customername + "<sup style='margin-left: 10px; font-weight:normal; font-size:10px;'> You have: " + points + " points</sup>";
                    document.getElementById('infoName').innerHTML = data[0].customername;
                    document.getElementById('infoAddress').innerHTML = data[0].customeraddress;
                    document.getElementById('cellNum').innerHTML = data[0].mobilenumber;
                }else {
                    document.getElementById('name').innerHTML = 'Hi, ' + data[0].customername + "<sup style='margin-left: 10px; font-weight:normal; font-size:10px;'> You have: " + points + " points</sup>";
                }
            } else {
                window.location = 'main_settings.php';
            }
        }
    }

    xhr.send();

}

function getUserWishList() {

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'php/user_settings/get_user_wish.php', true);

    xhr.onload = function () {
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
                        "<td data-label='Total'><input type='button' value='ADD TO CART' onclick=\"addToCart('" + data[i].productID + "', '" + data[i].branchID + "')\"></td>" +
                        "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;

            } else {
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

    xhr.onload = function () {
        if (this.status == 200) {
            getUserWishList();
        }
    }

    xhr.send(param);

}

function selectedSetting(value) {

    this.pageName = value;

    if (value == 'logout') {
        window.location = 'php/logout.php';
    } else if (value == 'manage') {
        window.location = 'main_settings.php';
    } else if (value == 'profile') {
        window.location = 'profile.php';
    } else if (value == 'address') {
        window.location = 'address.php';
    } else if (value == 'voucher') {
        window.location = 'voucher.php';
    } else if (value == 'order') {
        window.location = 'my_orders.php';
    } else if (value == 'review') {
        window.location = 'review.php';
    } else if (value == 'wishlist') {
        window.location = 'wishlist.php';
    } else if (value == 'cancellation') {
        window.location = 'cancellation.php';
    } else if (value == 'track') {
        window.location = 'list_track_order.php'
    }

}

function showPreviewImage(event) {

    var output = document.getElementById('profilePic');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }

}

function getOrderDetails() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;
    xhr.open('POST', 'php/product/get_order_details.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != null && this.responseText.trim() != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<tr>" +
                        "<td data-label='Order ID'>" + data[i].transactionID + "</td>" +
                        "<td data-label='Date'>" + data[i].dateadded + "</td>" +
                        "<td data-label='Items'>" +
                        "<div class='product-container'>" +
                        "<img src='" + data[i].productimg + "' alt=''>" +
                        "</div>" +
                        "<p>" + data[i].productname + "</p>" +
                        "</td>" +
                        "<td data-label='Total'>&#8369;" + data[i].totalprice + "</td>" +
                        "</tr>";
                }

                document.getElementById('orderDetails').innerHTML = output;
            }
        }
    }

    xhr.send(param);

    var container = document.getElementById('recent');

    container.addEventListener("scroll", function () {
        var y = container.scrollTop + container.offsetHeight;

        if (y >= container.scrollHeight) {
            offset += 5;

            param = "offset=" + offset;
            xhr.open('POST', 'php/product/get_order_details.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.responseText != null && this.responseText.trim() != 0) {
                        var data = JSON.parse(this.responseText);
                        var output = "";

                        for (var i in data) {
                            output += "<tr>" +
                                "<td data-label='Order ID'>" + data[i].transactionID + "</td>" +
                                "<td data-label='Date'>" + data[i].dateadded + "</td>" +
                                "<td data-label='Items'>" +
                                "<div class='product-container'>" +
                                "<img src='" + data[i].productimg + "' alt=''>" +
                                "</div>" +
                                "<p>" + data[i].productname + "</p>" +
                                "</td>" +
                                "<td data-label='Total'>&#8369;" + data[i].totalprice + "</td>" +
                                "</tr>";
                        }

                        document.getElementById('orderDetails').innerHTML += output;
                    }
                }
            }

            xhr.send(param);
        }
    })

}

function getOrderToReview() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset + "&review=" + 'true';
    xhr.open("POST", "php/product/get_order_details.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            var responseString = this.responseText.trim();
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "<thead>" +
                    "<th>Order ID</th>" +
                    "<th>Purchased</th>" +
                    "<th>Review</th>" +
                    "</thead>" +
                    "<tbody id='tableReview'>";

                for (var i in data) {

                    output += "<tr>" +
                        "<td><p>" + data[i].transactionID + "</p></td>" +
                        "<td data-label='Items'> " +
                        "<div class='product-container'>" +
                        "<img src='" + data[i].productimg + "' alt=''>" +
                        "</div>" +
                        "<p>" + data[i].productname + "</p>" +
                        "</td>" +
                        "<td data-label='Total'><input type='button' value='REVIEW' onclick=\"addReviewItem('" + data[i].transactionID + "','" + data[i].productID + "','" + data[i].branchID + "')\"></td>" +
                        "</tr>";

                }

                output += "</tbody>";

                document.getElementById('table').innerHTML = output;

            }
        }
    }

    xhr.send(param);

    var el = document.getElementById('recent'),
        elClone = el.cloneNode(true);

    el.parentNode.replaceChild(elClone, el);

    var elem = document.getElementById('options').getElementsByTagName('p');
    for (let index = 0; index < elem.length; index++) {
        elem[index].addEventListener('click', function () {
            document.getElementsByClassName('active')[0].className = "";
            this.className = "active";
            if (this.innerHTML.toLowerCase() == 'history') {
                getReviewHistory();
            } else if (this.innerHTML.toLowerCase() == 'to be reviewed') {
                getOrderToReview();
            }
        });
    }

    var container = document.getElementById('recent');

    container.addEventListener("scroll", function () {
        var y = container.scrollTop + container.offsetHeight;
        
        if (y >= container.scrollHeight) {
            offset += 5;

            param = "offset=" + offset;
            xhr.open("POST", "php/product/get_order_details.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.responseText != null && this.responseText.trim().length != 0) {
                        var data = JSON.parse(this.responseText);
                        var output = "";

                        for (var i in data) {

                            output += "<tr>" +
                                "<td><p>" + data[i].transactionID + "</p></td>" +
                                "<td data-label='Items'> " +
                                "<div class='product-container'>" +
                                "<img src='" + data[i].productimg + "' alt=''>" +
                                "</div>" +
                                "<p>" + data[i].productname + "</p>" +
                                "</td>" +
                                "<td data-label='Total'><input type='button' value='REVIEW' onclick=\"addReviewItem('" + data[i].transactionID + "','" + data[i].productID + "','" + data[i].branchID + "')\"></td>" +
                                "</tr>";


                        }

                        document.getElementById('tableReview').innerHTML += output;

                    }
                }
            }

            xhr.send(param);
        }
    });

}

function addReviewItem(transactionid, productid, branchid) {

    var xhr = new XMLHttpRequest();
    var param = "productid=" + productid + "&branchid=" + branchid;
    xhr.open('POST', 'php/product/get_order_details.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != null && this.responseText != '') {
                var data = JSON.parse(this.responseText);

                document.getElementById('productname').innerHTML = data[0].productname;
                document.getElementById('productimg').src = data[0].productimg;
            }
        }
    }

    xhr.send(param);


    document.getElementById('reviewContainer').innerHTML = "<div class='form'>" +
        "<textarea name='' maxlength='210' id='form' cols='30' rows='5' placeholder='Optional'></textarea>" +
        "<input type='button' value='SUBMIT REVIEW' onclick=\"submitReview('" + transactionid + "','" + productid + "','" + branchid + "')\">" +
        "</div>";

    document.getElementById('product-description').style.display = 'block';
    document.getElementById('main').style.filter = 'blur(1px)';
}

function closeReview() {
    document.getElementById('product-description').style.display = 'none';
    document.getElementById('main').style.filter = 'blur(0)';
}

function submitReview(transactionid, productid, branchid) {
    var xhr = new XMLHttpRequest();
    var rating = 0;
    var star = document.getElementsByTagName('i');
    var comment = document.getElementById('form').value;

    if (!comment.trim()) {
        comment = '';
    }

    for (let index = 0; index < star.length; index++) {
        if (star[index].className == "fa fa-star fa-2x") {
            rating++;
        }
    }

    var param = "transactionid=" + transactionid + "&productid=" + productid + "&branchid=" + branchid + "&comment=" + comment + "&rating=" + rating;

    xhr.open('POST', 'php/product/submit_review.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            window.location = 'review.php';
        }
    }
    xhr.send(param);

}

function getReviewHistory() {

    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;
    xhr.open('POST', 'php/product/get_review_hist.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var rating = 0;
                var feedback = "<i>Feedback is not available</i>";
                var output = "<thead>" +
                    "<th>Products rating & review</th>" +
                    "<th>Date</th>" +
                    "</thead>" +
                    "<tbody id='tableReview'>";

                for (var i in data) {
                    rating = indivRatingToStar(data[i].rating);

                    if (data[i].review != null && data[i].review.trim().length != 0) {
                        feedback = data[i].review
                    } else {
                        feedback = "<i>Feedback is not available</i>";
                    }

                    output +=
                        "<tr>" +
                        "<td>" +
                        "<div class='wrapper-td'>" +
                        "<div class='title'>" +
                        "<div class='img'>" +
                        "<img src='" + data[i].productimg + "' width='64' height='64' alt=''>" +
                        "</div>" +
                        "<div class='product-name'>" +
                        "<h3>" + data[i].productname + "</h3>" +
                        rating +
                        "</div>" +
                        "<div class='comment-wrapper'>" +
                        "<div class='comment'>" +
                        "<h5>My Comment:</h5>" +
                        "<p>" + feedback + "</p>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "</td>" +
                        "<td>" + data[i].dateadded + "</td>" +
                        "</tr>" +
                        "</tbody>";
                }

                document.getElementById('table').innerHTML = output;
            }
        }
    }

    xhr.send(param);

    var el = document.getElementById('recent'),
        elClone = el.cloneNode(true);

    el.parentNode.replaceChild(elClone, el);

    var elem = document.getElementById('options').getElementsByTagName('p');
    for (let index = 0; index < elem.length; index++) {
        elem[index].addEventListener('click', function () {
            document.getElementsByClassName('active')[0].className = "";
            this.className = "active";
            if (this.innerHTML.toLowerCase() == 'history') {
                getReviewHistory();
            } else if (this.innerHTML.toLowerCase() == 'to be reviewed') {
                getOrderToReview();
            }
        });
    }

    var container = document.getElementById('recent');

    container.addEventListener("scroll", function () {
        var y = container.scrollTop + container.offsetHeight;

        if (y >= container.scrollHeight) {
            offset += 5;
            var param = "offset=" + offset;
            xhr.open('POST', 'php/product/get_review_hist.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.responseText != null && this.responseText.trim().length != 0) {
                        var data = JSON.parse(this.responseText);
                        var rating = 0;
                        var feedback = "<i>Feedback is not available</i>";
                        var output = "<thead>" +
                            "<th>Products rating & review</th>" +
                            "<th>Date</th>" +
                            "</thead>" +
                            "<tbody id='tableReview'>";

                        for (var i in data) {
                            rating = indivRatingToStar(data[i].rating);

                            if (data[i].review != null && data[i].review.trim().length != 0) {
                                feedback = data[i].review
                            } else {
                                feedback = "<i>Feedback is not available</i>";
                            }

                            output +=
                                "<tr>" +
                                "<td>" +
                                "<div class='wrapper-td'>" +
                                "<div class='title'>" +
                                "<div class='img'>" +
                                "<img src='" + data[i].productimg + "' width='64' height='64' alt=''>" +
                                "</div>" +
                                "<div class='product-name'>" +
                                "<h3>" + data[i].productname + "</h3>" +
                                rating +
                                "</div>" +
                                "<div class='comment-wrapper'>" +
                                "<div class='comment'>" +
                                "<h5>My Comment:</h5>" +
                                "<p>" + feedback + "</p>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</td>" +
                                "<td>" + data[i].dateadded + "</td>" +
                                "</tr>" +
                                "</tbody>";
                        }

                        document.getElementById('table').innerHTML += output;
                    }
                }
            }

            xhr.send(param);
        }
    });

}

function indivRatingToStar(rating) {
    var star = "";

    if (rating == 5) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>";
    } else if (rating < 5 && rating >= 4.5) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-half-o'></i>";
    } else if (rating < 4.5 && rating >= 4) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-o'></i>";
    } else if (rating < 4 && rating >= 3.5) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-half-o'></i>" +
            "<i class='fa fa-star-o'></i>";
    } else if (rating < 3.5 && rating >= 3) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>";
    } else if (rating < 3 && rating >= 2.5) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-half-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>";
    } else if (rating < 2.5 && rating >= 2) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>";
    } else if (rating < 2 && rating >= 1.5) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-half-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>";
    } else if (rating < 1.5 && rating >= 1) {
        star = "<i class='fa fa-star'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>";
    } else if (rating < 1 && rating >= 0.5) {
        star = "<i class='fa fa-star-half-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i> ";
    } else {
        star = "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>" +
            "<i class='fa fa-star-o'></i>";
    }

    return star;
}