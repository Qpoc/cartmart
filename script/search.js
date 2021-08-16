function searchProduct(value) {
    var xhr = new XMLHttpRequest();
    var param = "value=" + value;

    xhr.open("POST", "php/product/search_product.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != null && this.responseText.trim().length != 0){
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<div class='result-container' onclick=\"getSearchProduct('" + data[i].productid + "','" + data[i].branchid + "', '" + data[i].productname + "', '" + data[i].price + "', '" + data[i].productimg + "')\">" +
                    "<div class='img-wrapper'>" +
                    "<div class='imgcontainer'>" +
                    "<img src='" + data[i].productimg + "' width='64' height='64' alt=''>" +
                    "</div>" +
                    "<div class='productname'>" +
                    "<h4>" + data[i].productname + "</h4>" +
                    "<p>&#8369;" + data[i].price + "</p>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
                }

                document.getElementById('search-result').innerHTML = output;
                document.getElementById('search-result').style.display = 'block';
            }
        }
    }

    xhr.send(param);

}

function closeSearchProduct() {
    document.getElementById('search-result').style.display = 'none';
}

function getSearchProduct(productid, branchid, productname, price, image) {

    var xhr = new XMLHttpRequest();
    var params = "productid=" + productid + "&branchid=" + branchid + "&productname=" + encodeURIComponent(productname) + "&price=" + price + "&image=" + encodeURIComponent(image);
    xhr.open("POST", "category_type.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status == 200) {
            window.location = "category_type.php";
        }
    }
    xhr.send(params);
    document.getElementById('search-result').style.display = 'none';
}

function getCategory(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/product/get_category.php", true);
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText != null && this.responseText.trim().length != 0) {
                var data = JSON.parse(this.responseText);
                var output = "";

                for (var i in data) {
                    output += "<div class='product' onclick=\"searchProdByCategory('" + data[i].productcategory + "')\">" +
                    "<div class='product-image'>" +
                        "<img src='" + data[i].categoryicon + "' alt='icon' width='200'>" +
                        "</div>" +
                    "<div class='product-title'>" +
                    "<h2>" + data[i].productcategory + "</h2>" +
                        "</div>" +
                "</div>";
                }

                document.getElementById('products-wrapper').innerHTML += output;
            }
        }
    }

    xhr.send();
}

function searchProdByCategory (category) {
    var xhr = new XMLHttpRequest();
    var param = "category=" + category;
    xhr.open("POST", "categories.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            window.location = "categories.php";
        }
    }
    
    xhr.send(param);
}