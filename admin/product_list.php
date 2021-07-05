<?php
    session_start();

    require_once('php/navigation.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="../images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/product_list.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
</head>
<body onload="getProductList()">
    <header>
        <div class="wrapper">
            <div class="container">
                <div class="branding">
                    <label for="show-nav">
                        <img src="../images/Icon/menu.png" alt="" width="32">
                    </label>
                    <img src="../images/Icon/eco-bag.png" width="64" alt=""> 
                    <h2>CartMart</h2>
                </div>
            </div>
        </div>
    </header>
    <main id="main">
        <?php
            get_navigation();
        ?>
        <div class="wrapper">
            <div class="container">
                <div class="title">
                    <h1>PRODUCT LIST</h1>
                </div>
                <div class="product-list">
                    <div class="buttons">
                        <div class="new-list">
                            <input type="button" value="NEW" onclick="showModal('addproduct', false)">
                            <select name="" id="category">
                                <?php
                                     $con = mysqli_connect('localhost', 'root', '', 'marketdb');

                                     echo "<option value='' selected hidden>CATEGORIES</option>";

                                     if (mysqli_connect_errno($con)) {
                                         die("An error occurred: " . mysqli_connect_error());
                                     }else {
                                        $query = "SELECT DISTINCT productcategory FROM itemcategory";

                                         if ($result = mysqli_query($con, $query)) {
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                 echo "<option value='$row[productcategory]'>$row[productcategory]</option>";
                                             }
                                             mysqli_close($con);
                                         }else {
                                             echo 'error';
                                         }
                                     }

                                ?>
                            </select>
                        </div>
                        <div class="entry">
                            <select name="" id="category">
                                <option value="" selected hidden>Entries</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                            <input type="text" placeholder="Search">
                        </div>
                    </div>
                    <div class="table-container" id="tableContainer">
                        <table>
                            <thead>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Description</th>
                                <th>Stocks</th>
                                <th>Price</th>
                                <th>Date Added</th>
                                <th>Tools</th>
                            </thead>
                            <tbody id="product-info">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer id="footer">
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
<div class="wrapper-add-product">
    <div class="container-add-product" id="productcontainer">
        <div class="title">
            <h2>Add Product</h2>
            <img src="../images/Icon/cancel.png" alt="" width="32" onclick="closeModal('addproduct')">
        </div>
        <form action="php/add_product.php" method="POST" enctype="multipart/form-data">
            <div class="product-information">
                <div class="preview-image">
                    <img src="" alt="" id="output">
                </div>
                <div>
                    <label for="myfile">Select a image product : <sup id="limit">1mb limit</sup> </label>
                    <input type="file" id="myfile" name="myfile" onchange="showPreviewImage(event)" required>
                </div>
                <div class="product-input">
                    <select name="branch" id="getBranch">
                        
                    </select>
                    <span>Branch:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="name">
                    <span>Product Name:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="quantity">
                    <span>Quantity:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="price">
                    <span>Price:</span>
                </div>
                <span>Product Description</span>
                <textarea textarea name="description" required></textarea>
                <script>
                        CKEDITOR.replace('description');
                </script>
                <div class="product-input">
                    <select name="category" id="getCategory" onchange="getCategoryTypes(this.value)">
                        
                    </select>
                    <span>Product Category:</span>
                </div>
                <div class="product-input">
                    <select name="type" id="getType">
                        <option value='' selected hidden>Select a Category</option>
                        
                    </select>
                    <span>Product Type:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="brand">
                    <span>Product Brand:</span>
                </div>
                <input type="submit" value="ADD PRODUCT" name="submit">
            </div>
        </form>
    </div>
    <div class="wrapper-description">
        <div class="container-description" id="containerDescription">
            <div class="title">
                <h2>Description</h2>
                <img src="../images/Icon/cancel.png" alt="" width="32" onclick="closeModal('showDescription')">
            </div>
            <div class="text-description" id="textDescription">

            </div>
        </div>
    </div>
    <div class="container-edit-product" id="editproductcontainer">
        <div class="title">
            <h2>Edit Product</h2>
            <img src="../images/Icon/cancel.png" alt="" width="32" onclick="closeEditModal()">
        </div>
        <form action="php/edit_product.php" method="POST" enctype="multipart/form-data">
            <div class="product-information">
                <div class="preview-image">
                    <img src="" alt="" id="editoutput">
                </div>
                <div>
                    <label for="myfile">Select a image product : <sup id="editlimit">1mb limit</sup> </label>
                    <input type="file" id="editmyfile" name="myfile" onchange="showPreviewImage(event)" required>
                </div>
                <div class="product-input">
                    <select name="branch" id="editgetBranch">
                        
                    </select>
                    <span>Branch:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="name" id="editName">
                    <span>Product Name:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="quantity" id="editQty">
                    <span>Quantity:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="price" id="editPrice">
                    <span>Price:</span>
                </div>
                <span>Product Description</span>
                <textarea textarea name="editdescription" id="editDescription" required></textarea>
                <script>
                        CKEDITOR.replace('editdescription');
                </script>
                <div class="product-input">
                    <select name="category" id="editgetCategory" onchange="getCategoryTypes(this.value)">
                        
                    </select>
                    <span>Product Category:</span>
                </div>
                <div class="product-input">
                    <select name="type" id="editgetType">
                        
                    </select>
                    <span>Product Type:</span>
                </div>
                <div class="product-input">
                    <input type="text" required name="brand" id="editBrand">
                    <span>Product Brand:</span>
                </div>
                <input type="submit" value="EDIT PRODUCT" name="submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>