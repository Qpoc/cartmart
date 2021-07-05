function getProductList() {
    var xhr = new XMLHttpRequest();

    var table = document.getElementById('tableContainer');
    var offset = 0;
    var param = "offset=" + offset;
    var output = "";

    xhr.open("POST", "php/get_product_list.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {

            if (this.responseText != 'error') {
                var data = JSON.parse(this.responseText);

                for (var i in data) {
                    output += "<tr>" +
                        "<td><p>" + data[i].productname + "</p></td>" +
                        "<td>" +
                        "<div class='image'>" +
                        "<img src='../" + data[i].productimg + "' alt=''>" +
                        "</div>" +
                        "</td>" +
                        "<td>" +
                        "<div class='view'>" +
                        "<input type='button' value='VIEW' onclick=\"showModal('showDescription', '" + data[i].productID + "')\">" +
                        "</div>" +
                        "</td>" +
                        "<td>" + data[i].quantity + "</td>" +
                        "<td>&#8369;" + data[i].price + "</td>" +
                        "<td>" + data[i].dateadded + "</td>" +
                        "<td>" +
                        "<div class='buttons'>" +
                        "<input type='button' value='Edit' id='edit' onclick=\"showEdit('" + data[i].productID + "', '" + data[i].branchID + "')\">" +
                        "<input type='button' value='Delete' id='delete' onclick=\"deleteProduct('" + data[i].productID + "', ' " + data[i].branchID + " ')\">" +
                        "<input type='hidden' id='productid' value=\"" + data[i].productID + "\"" +
                        "</div>" +
                        "</td>" +
                        "</tr>";
                }

                document.getElementById('product-info').innerHTML = output;
            }
        }

    }

    xhr.send(param);

    table.addEventListener("scroll", function () {

        var y = table.scrollTop + table.offsetHeight;

        if (y >= table.scrollHeight) {
            offset += 5;

            param = "offset=" + offset;

            xhr.open("POST", "php/get_product_list.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status == 200) {

                    if (this.responseText != 'error') {
                        var data = JSON.parse(this.responseText);

                        for (var i in data) {
                            output += "<tr>" +
                                "<td><p>" + data[i].productname + "</p></td>" +
                                "<td>" +
                                "<div class='image'>" +
                                "<img src='../" + data[i].productimg + "' alt=''>" +
                                "</div>" +
                                "</td>" +
                                "<td>" +
                                "<div class='view'>" +
                                "<input type='button' value='VIEW' onclick=\"showModal('showDescription', '" + data[i].productID + "')\">" +
                                "</div>" +
                                "</td>" +
                                "<td>" + data[i].quantity + "</td>" +
                                "<td>&#8369;" + data[i].price + "</td>" +
                                "<td>" + data[i].dateadded + "</td>" +
                                "<td>" +
                                "<div class='buttons'>" +
                                "<input type='button' value='Edit' id='edit' onclick=\"showEdit('" + data[i].productID + "', '" + data[i].branchID + "')\">" +
                                "<input type='button' value='Delete' id='delete' onclick=\"deleteProduct('" + data[i].productID + "', ' " + data[i].branchID + " ')\">" +
                                "<input type='hidden' id='productid' value=\"" + data[i].productID + "\"" +
                                "</div>" +
                                "</td>" +
                                "</tr>";
                        }

                        document.getElementById('product-info').innerHTML = output;
                    }
                }

            }

            xhr.send(param);
        }

    });


}

function showModal(isShow, productID) {
    if (isShow == 'addproduct') {
        document.getElementById('productcontainer').style.display = 'block';
        document.getElementById('main').style.filter = 'blur(2px)';

        var xhr = new XMLHttpRequest();

        xhr.open("POST", "php/get_branch.php");

        xhr.onload = function () {
            if (this.status == 200) {
                if (this.responseText != 'error') {
                    var data = JSON.parse(this.responseText);
                    var output = "<option value='bakery' selected hidden>Branch</option>";

                    for (var i in data) {
                        output += "<option value='" + data[i].branchID + "'>" + data[i].branchname + "</option>"
                    }

                    document.getElementById('getBranch').innerHTML = output;
                }
            }
        }

        xhr.send();

        xhr = new XMLHttpRequest();

        xhr.open("POST", "php/show_category.php");

        xhr.onload = function () {
            if (this.status == 200) {
                if (this.responseText != 'error') {
                    var data = JSON.parse(this.responseText);
                    var output = "<option value='category' selected hidden>Category</option>";

                    for (var i in data) {
                        output += "<option value='" + data[i].productcategory + "'>" + data[i].productcategory + "</option>"
                    }

                    document.getElementById('getCategory').innerHTML = output;
                }
            }
        }

        xhr.send();

    } else if (isShow == 'showDescription') {
        document.getElementById('containerDescription').style.display = 'block';
        document.getElementById('main').style.filter = 'blur(2px)';

        var param = "productid=" + productID;

        var xhr = new XMLHttpRequest();

        xhr.open("POST", "php/get_description.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (this.status == 200) {
                var output = this.responseText;
                document.getElementById('textDescription').innerHTML = output;
            }
        }

        xhr.send(param);
    } else if (isShow == 'showAddbgImg') {
        document.getElementById('productcontainer').style.display = 'block';
        document.getElementById('main').style.filter = 'blur(2px)';

        var xhr = new XMLHttpRequest();

        xhr.open("POST", "php/show_category.php");


        xhr.onload = function () {
            if (this.status == 200) {
                if (this.responseText != null && this.responseText != 'error') {
                    var data = JSON.parse(this.responseText);
                    var output = "<option value='' selected hidden>Select a category</option>";
                    for (var i in data) {
                        output += "<option value='" + data[i].productcategory + "'>" + data[i].productcategory + "</option>";
                    }

                    document.getElementById('getCategory').innerHTML = output;
                }
            }
        }

        xhr.send();
    }
}

function changeSampleTxt(value) {
    document.getElementById('sampleText').innerHTML = value;
}

function closeModal(isShow) {
    if (isShow == 'addproduct') {
        document.getElementById('productcontainer').style.display = 'none';
        document.getElementById('main').style.filter = 'blur(0)';
    } else if (isShow == 'showDescription') {
        document.getElementById('containerDescription').style.display = 'none';
        document.getElementById('main').style.filter = 'blur(0)';
    }
}

function showPreviewImage(event) {

    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
        document.getElementById('sampleText').style.top = '50%';
        document.getElementById('sampleText').style.fontSize = '2em';
    }

}

function deleteProduct(productID, branchID) {
    var ID = productID;
    alert(branchID);
    var isDelete = confirm('Do you want to delete this product?');

    if (isDelete) {
        xhr = new XMLHttpRequest();
        var param = 'productid=' + ID + "&branchid=" + branchID;


        xhr.open("POST", "php/delete_product.php");
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status == 200) {
                if (this.responseText == true) {
                    alert('Data successfully deleted');
                    getProductList();
                } else {
                    alert('Data cannot be deleted due to constraint');
                }
            }
        }

        xhr.send(param);

    }

}

function showBranch() {
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'php/show_branch.php', true);

    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != '') {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<tr>" +
                        "<td><p>" + data[i].branchname + "</p></td>" +
                        "<td>" + data[i].dateadded + "</td>" +
                        "<td>" +
                        "<input type='button' value='DETAILS'>" +
                        "</td>" +
                        "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;
            }
        }
    }

    xhr.send();
}

function showCategory() {
    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;

    xhr.open('POST', 'php/show_category.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')

    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<tr>" +
                        "<td><p>" + data[i].productcategory + "</p></td>" +
                        "<td>" + data[i].producttype + "</td>" +
                        "<td>" + data[i].dateadded + "</td>" +
                        "<td>" +
                        "<input type='button' value='EDIT'>" +
                        "</td>" +
                        "</tr>";
                }

                document.getElementById('tableBody').innerHTML = output;
            }
        }
    }

    xhr.send(param);

    var table = document.getElementById('tableContainer');
    table.addEventListener("scroll", function () {
        var y = table.scrollTop + table.offsetHeight;

        if (y >= table.scrollHeight) {
            offset += 10;
            var param = "offset=" + offset;

            xhr.open('POST', 'php/show_category.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            xhr.onload = function () {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != 'error') {
                        var data = JSON.parse(this.responseText);
                        var output = "";

                        for (var i in data) {
                            output += "<tr>" +
                                "<td><p>" + data[i].productcategory + "</p></td>" +
                                "<td>" + data[i].producttype + "</td>" +
                                "<td>" + data[i].dateadded + "</td>" +
                                "<td>" +
                                "<input type='button' value='EDIT'>" +
                                "</td>" +
                                "</tr>";
                        }

                        document.getElementById('tableBody').innerHTML += output;
                    }
                }
            }

            xhr.send(param);
        }
    })
}

function getCategoryTypes(categoryName, isProductType) {
    var xhr = new XMLHttpRequest();
    var param = "category=" + categoryName + "&productType=" + isProductType;

    xhr.open("POST", "php/show_category.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != 'error') {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<option value='" + data[i].producttype + "'>" + data[i].producttype + "</option>";
                }

                document.getElementById('getType').innerHTML = output;
            }
        }
    }

    xhr.send(param);
}