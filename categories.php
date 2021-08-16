<?php
    session_start();

    require_once("php/createDB.php");
    require_once("php/component.php");
    require_once("php/navigation.php");

    $database = new CreateDB();

    if (isset($_POST['category']) && !isset($_POST['type'])) {
        $_SESSION['category'] = $_POST['category'];
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
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/categories.css">
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
        echo "<body onload='onLoadCart()'>";
    }else {
        echo "<body>";
    }
?>
<header>
    <?php
        require_once('php/header.php');
    ?>
</header>
<main id="main">
    <section class="product-header">
        <div class="wrapper" id="bgContainer">
            <div class="container">
                <h1>
                    <?php 
                        if (isset($_SESSION['category'])) {
                            echo $_SESSION['category']; 
                        }else if(!isset($_SESSION['category'])) {
                            echo "Sorry your search is not available";
                        }
                    ?>
                </h1>
            </div>
        </div>
        <?php
            if (isset($_SESSION['category'])) {
                echo "<script type='text/javascript'>
                changeBackground();
                function changeBackground() {
                    var xhr = new XMLHttpRequest();
                    var param = \"category=\" + encodeURIComponent('$_SESSION[category]');
                
                    xhr.open('POST', 'php/product/get_bg_path.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                
                    xhr.onload = function(){
                        if (this.status == 200) {
                            if(this.responseText != null && this.responseText != 'error') {
                                var path = this.responseText;
                
                                document.getElementById('bgContainer').style.backgroundImage = \"url(\" + path + \")\";
                            }
                        }
                    }
                
                    xhr.send(param);
                
                }
                </script>";
            }
        ?>
        
    </section>
    <section class="product-presentation">
        <?php
            if (isset($_SESSION['category'])) {
                $result = $database->getDisProdType($_SESSION['category']);

                if ($result != null && $result != "no data") {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='wrapper'>
                            <div class='container'>
                            <div class='title'>
                                <h1>$row[producttype]</h1>
                                <a href='category_type.php' onclick=\"getProductByCategory('$_SESSION[category]','$row[producttype]')\">view all ></a>
                            </div>
                            <div class='products-wrapper-2'>";
                    
                        $result2 = $database->getProductByType($row['producttype']);
                        if ($result2 != null && $result2 != "no data") {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                component($row2['productimg'],$row2['productname'],$row2['price'],$row2['productID'], $row2['branchID']);
                            } 
                        }else {
                            echo "<h2>Sorry data is not available as of the moment.</h2>";
                        }

                        echo "</div>
                        </div>
                        </div>";

                    }
                }else {
                    echo "<h2 style='text-align: center;'>Sorry data is not available as of the moment.</h2>";
                    
                    echo "</div>
                    </div>
                    </div>";
                }
                
            }

        ?>
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
<?php
    get_navigation();
?>
</body>
</html>