<?php
    session_start();
    
    require_once('php/component.php');
    require_once('php/createDB.php');
    require_once('php/navigation.php');

    $database = new CreateDB();

    if (isset($_SESSION['buynow'])) {
        unset($_SESSION['buynow']);
        unset($_SESSION['branchid']);
    }

    if (isset($_SESSION['category'])) {
        unset($_SESSION['category']);
    }

    if (isset($_SESSION['descriptionquantity'])) {
        unset($_SESSION['descriptionquantity']);
    }

    // if (isset($_POST['btnAdd'])) {
    //     if (!isset($_SESSION['sessionusername']) && !isset($_SESSION['sessionpassword'])) {
    //         header("location:login.php");
    //         session_destroy();
    //     }else {
    //         if (isset($_SESSION['cart'])) {

    //             //returns an array of productid
    //             $product_id_array = array_column($_SESSION['cart'],'productid');
                
    //             if (in_array($_POST['productid'], $product_id_array)) {
    //                 echo "<script>alert('Product is already in the cart')</script>";
    //                 echo "<script>window.location = index.php</script>";
    //             }else {
    //                 $count = count($_SESSION['cart']);
    //                 $cart_array = array(
    //                     'productid' => $_POST['productid']
    //                 );
    
    //                 $_SESSION['cart'][$count] = $cart_array;
    //             }
                
    //         }else {
    //             $cart_array = array(
    //                 'productid' => $_POST['productid']
    //             );
    
    //             //create new session
    //             $_SESSION['cart'][0] = $cart_array;
    //         }
    //     }

    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
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
<header id="header">
    <?php
        require_once('php/header.php');
    ?>
</header>
<main id="main">
    <section id="promotional-banner">
        <div id="promotional-wrapper">
            <div id="promotional-text">
                <h1>GRAND OPENING SALE UP TO 50% OFF!</h1>
                <button>SHOP NOW!</button>
            </div>
            <div id="promotional-image">
                <img src="images/banner/banner1.jpg" alt="" width="1000">
            </div>
        </div>
    </section>
    <section class="product-presentation">
        <h1>OUR PRODUCTS</h1>
        <div class="products-wrapper">
            <div class="product">
                <div class="product-image">
                    <img src="images/Icon/bread.png" alt="" width="200">
                </div>
                <div class="product-title">
                    <h2>Bakery</h2>
                </div>
            </div>
            <div class="product">
                <div class="product-image">
                    <img src="images/Icon/Beverage-Transparent.png" alt="" width="200">
                </div>
                <div class="product-title">
                    <h2>Bakery</h2>
                </div>
            </div>
            <div class="product">
                <div class="product-image">
                    <img src="images/Icon/low-pork-fat-meaty-steak.jpg.png" alt="" width="200">
                </div>
                <div class="product-title">
                    <h2>Bakery</h2>
                </div>
            </div>
            <div class="product">
                <div class="product-image">
                    <img src="images/Icon/Fruit-PNG.png" alt="" width="200">
                </div>
                <div class="product-title">
                    <h2>Bakery</h2>
                </div>
            </div>
            <div class="product">
                <div class="product-image">
                    <img src="images/Icon/bread.png" alt="" width="200">
                </div>
                <div class="product-title">
                    <h2>Bakery</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="product-presentation-2" id="productsContainer">
        <h1>HOT OFFERS</h1>
        <div class="products-wrapper-2" id="mycontainer">
            <?php
                $result = $database->getProductData(false);
                if (isset($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        component($row['productimg'],$row['productname'],$row['price'],$row['productID'], $row['branchID']);
                    }
                }
            ?>
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
        
    </div>
</div>
<?php
    get_navigation();
?>
</body>
</html>