function showEdit(productid, branchid) {

    var xhr = new XMLHttpRequest();
    var params = "productid=" + productid + "&branchid=" + branchid;

    xhr.open("POST", 'php/get_product_list.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != 'null' && this.responseText != 'error') {
                var data = JSON.parse(this.responseText);

                for (var i in data) {
                    document.getElementById('editoutput').src = "../" + data[i].productimg;
                    document.getElementById('editgetBranch').innerHTML = "<option value=" + data[i].branchname + ">" + data[i].branchname + "</option>";
                    document.getElementById('editName').value = data[i].productname;
                    document.getElementById('editQty').value = data[i].quantity;
                    document.getElementById('editPrice').value = data[i].price;
                    CKEDITOR.instances['editDescription'].setData(data[i].productdescription);
                    document.getElementById('editgetCategory').innerHTML = "<option value=" + data[i].productcategory + ">" + data[i].productcategory + "</option>";
                    document.getElementById('editgetType').innerHTML = "<option value=" + data[i].producttype + ">" + data[i].producttype + "</option>";
                    document.getElementById('editBrand').value = data[i].productbrand;
                    document.getElementById('editProdid').value = productid;
                    document.getElementById('editBranchid').value = branchid;
                    document.getElementById('editpoints').value = data[i].productpoints;
                }
            }

            document.getElementById('editproductcontainer').style.display = 'block';
        }
    }

    xhr.send(params);
    
}

function closeEditModal() {
    document.getElementById('editproductcontainer').style.display = 'none';
}

function salesToday() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/sales/get_sales_today.php", true);
    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != '' && this.responseText != null){
                var data = JSON.parse(this.responseText);
            
                for (var i in data){
                    if (data[i].totalsales !== null) {
                        document.getElementById('salesToday').innerHTML = "&#8369;" + data[i].totalsales;
                    } 
                }
            }
        }
    }

    xhr.send();

    getNumProd();
    getNumUser();
}

function getNumProd() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/sales/get_num_prod.php", true);
    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != '' && this.responseText != null){
                var data = JSON.parse(this.responseText);
                
                document.getElementById('numProd').innerHTML = data[0].totalproducts;
                
            }
        }
    }

    xhr.send();
}

function getNumUser() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/sales/get_num_user.php", true);
    xhr.onload = function () {
        if (this.status == 200){
            if (this.responseText != '' && this.responseText != null){
                var data = JSON.parse(this.responseText);
                
                document.getElementById('numUser').innerHTML = data[0].totalcust;
                
            }
        }
    }

    xhr.send();
}

function showCatIcon() {

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

                document.getElementById('getIconCategory').innerHTML = output;
            }
        }
    }

    xhr.send();

    document.getElementById('categoryIcon').style.display = 'block';
    document.getElementById('main').style.filter = 'blur(1px)';
}

function closeCatIcon() {
    document.getElementById('categoryIcon').style.display = 'none';
    document.getElementById('main').style.filter = 'none';
}

function previewIcon(event){
    
    var output = document.getElementById('outputIcon');

    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src);
    }
}