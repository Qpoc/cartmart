<?php
    session_start();

    require_once("php/createDB.php");
    require_once("php/component.php");
    require_once("php/navigation.php");

    $database = new CreateDB();

    if (isset($_POST['productid']) && isset($_POST['branchid']) && isset($_POST['productname']) && isset($_POST['price']) && isset($_POST['image'])) {
        $_SESSION['productid'] = $_POST['productid'];
        $_SESSION['branchid'] = $_POST['branchid'];
        $_SESSION['productname'] = $_POST['productname'];
        $_SESSION['price'] = $_POST['price'];
        $_SESSION['image'] = $_POST['image'];
    }

    if (isset($_POST['category']) && !isset($_POST['type'])) {
        $_SESSION['category'] = $_POST['category'];
    }else if (isset($_POST['category']) && isset($_POST['type'])) {
        $_SESSION['category'] = $_POST['category'];
        $_SESSION['type'] = $_POST['type'];
    }

    if (isset($_SESSION['buynow'])) {
        unset($_SESSION['buynow']);
        unset($_SESSION['branchid']);
    }

    if (isset($_SESSION['descriptionquantity'])) {
        unset($_SESSION['descriptionquantity']);
    }

    if (isset($_POST['transactionid'])) {
        $_SESSION['transactionid'] = $_POST['transactionid'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/category_type.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/search.js"></script>
    <link media="all" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/Icon/eco-bag.png">
    <title>CartMart - Home</title>
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
</head>
    <?php
        if (isset($_SESSION['sessioncustomerid'])) {
            echo "<body onload='onLoadCart()' id='body'>";
        } else {
            echo "<body id='body'>";
        }
    ?>
<header>
    <?php
        require_once('php/header.php');
    ?>
</header>
<main id="main">
    <section class="product-presentation-2">
        <h4>
            <?php 
                if (isset($_SESSION['category']) && isset($_SESSION['type'])) {
                    echo "<h4><a href='index.php'>Home</a> 
                    > <a href='categories.php' onclick=\"getProdByCategoryOn('$_SESSION[category]')\">$_SESSION[category]</a> > <a href='category_type.php' onclick=\"getProductByCategory('$_SESSION[category]','$_SESSION[type]')\">$_SESSION[type]</a></h4>";
                }else if(isset($_SESSION['productid']) && isset($_SESSION['branchid']) && isset($_SESSION['productname']) && isset($_SESSION['price']) && isset($_SESSION['image'])){
                    echo "<h4><a href='index.php'>Home</a> > <span>Search Results:</span></h4>";
                }
            ?>
        </h4>
        <div class="products-wrapper-2" id="productContainer">
          
        </div>
    </section>
</main>
<footer id="footer">
    <div id="footer-wrapper">
        <P>Copyright &copy; 2021 CartMart</P>
    </div>
</footer>
<div class="product-description">
    <div class="wrapper" id="description-wrapper">
        <input type="button" id="cancelButton" onclick="removeDescription()">
        <div class="container" id="description">
            <div class="cancel">
                <label for="cancelButton">
                    <img src="images/Icon/cancel.png" id="cancel" alt="" width="32">
                </label>
            </div>
            <div class="product-information">
                <div class="wrapper">
                    <div class="image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="title">
                    <div class="product-name">
                        <h1></h1>
                    </div>
                    <div class="rating">
                        <i class='fa fa-star'></i>
                        <i class='fa fa-star'></i>
                        <i class='fa fa-star'></i>
                        <i class='fa fa-star'></i>
                        <i class='fa fa-star-o'></i>
                    </div>
                    <div class="price">
                        <p>&#8369;98.00</p>
                    </div>
                    <div class="buttons">
                        <input type="button" value="ADD TO CART">
                        <input type="button" value="ADD TO WISHLIST">
                    </div>
                </div>
            </div>
            <div class="description-rating-wrapper">
                <div class="container-rate">
                    <input type="button" value="DESCRIPTION">
                    <input type="button" value="RATING & REVIEW">
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>

    var xhr = new XMLHttpRequest();
    var offset = 0;
    var param = "offset=" + offset;

    xhr.open('POST', 'php/product/fetch_prod_data.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status == 200) {
            if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                var data = this.responseText;
                document.getElementById('productContainer').innerHTML = data;
            }
        }
    }

    xhr.send(param);
    
    window.addEventListener('scroll', function() {
        
        var body = document.getElementById('body');
        var elementHeight = body.offsetHeight;
        
        var y = window.innerHeight + window.pageYOffset;

        if (y >= elementHeight) {
            
            offset += 12;
            param = "offset=" + offset;

            xhr.open('POST', 'php/product/fetch_prod_data.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '' && this.responseText != null && this.responseText != 'error') {
                        var data = this.responseText;
                        document.getElementById('productContainer').innerHTML += data;
                    }
                }
            }

            xhr.send(param);
        }
      
    })

</script>
<?php
get_navigation();
?>
</body>

</html>