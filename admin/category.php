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
    <link rel="stylesheet" href="css/category.css">
    <script src="script/utilities.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
</head>
<body onload="showCategory()">
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
        <div class='wrapper'>
            <h1>EDIT DETAILS</h1>
            <form action="php/add_category.php" method="POST">
                <div class='container'>
                    <div class="information">
                        <input type="text" name="category_name" required>
                        <span>Category</span>
                    </div>
                    <div class="information">
                        <input type="text" name="category_type" required>
                        <span>Type</span>
                    </div>
                    <div class="button">
                        <input type="submit" value="+ ADD CATEGORY" name="submit" class = "submit-button">
                    </div>
                    <div class="button">
                        <input type="button" value="+ ADD/EDIT BACKGROUND IMAGE TO CATEGORY" onclick="showModal('showAddbgImg', 'false')">
                    </div>
                </div>
            </form>
            <div class='container' id="mainTbContainer">
                <div class=table-container id="tableContainer">
                    <h3>Branch List</h3>
                    <table>
                        <thead>
                            <thead>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Date Added</th>
                                <th>Tool</th>
                            </thead>
                        </thead>
                        <tbody id="tableBody">
                            
                        </tbody>
                    </table>
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
            <h2>Add Background Image</h2>
            <img src="../images/Icon/cancel.png" alt="" width="32" onclick="closeModal('addproduct')">
        </div>
        <form action="php/change_category_bg.php" method="POST" enctype="multipart/form-data">
            <div class="product-information">
                <div class="preview-image">
                    <img src="" alt="" id="output">
                    <h1 id="sampleText">Sample Text</h1>
                </div>
                <div>
                    <label for="myfile">Select a background : <sup id="limit">1mb limit</sup> </label>
                    <input type="file" id="myfile" name="myfile" onchange="showPreviewImage(event)" required>
                </div>
                <div class="product-input">
                    <select name="category" id="getCategory" required onchange="changeSampleTxt(this.value)">
                        
                    </select>
                    <span>Category:</span>
                </div>
                <input type="submit" value="CHANGE BACKGROUND" name="submit">
            </div>
        </form>
    </div>
</div>
<div class="category-modal" id="categoryModal">
    <div class="wrapper">
        <div class="close" onclick="closeModal('editcategory')">
            <img src="images/icon/cancel.png" alt="" width="32" height="32">
        </div>
        <form action="php/edit_category.php" method="POST">
            <div class="info">
                <input id="editCategory" name="editCategory" type="text">
            </div>
            <div class="info">
                <input id="editType" name="editType" type="text">
            </div>
            <input type="hidden" id="hidCategory" name="hidCategory">
            <input type="hidden" id="hidType" name="hidType">
            <div class="info">
                <input type="submit" value="EDIT CHANGES">
            </div>
        </form>
    </div>
</div>
</body>
</html>