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