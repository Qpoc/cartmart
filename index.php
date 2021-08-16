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

    if (isset($_POST['transactionid'])) {
        $_SESSION['transactionid'] = $_POST['transactionid'];
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
    <link rel="stylesheet" href="css/searchbar.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link media="all" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/Icon/eco-bag.png">
    <title>CartMart - Home</title>
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
    <script src="script/search.js"></script>
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
    <div class="img-slider">
        <div class="slide active">
            <img src="images/banner/market.jpg" alt="">
            <div class="info">
                <h2>WELCOME TO CARTMART! JOIN US IN THIS GRAND OPENING</h2>
                <p>Hurry! Discover your favorite products and get a chance to claim exclusive Cartmart points on every item you purchase. It's all happening here!</p>
               <a href="about_us.php"><input type="button" value="ABOUT US"></a>
            </div>
        </div>
        <div class="slide">
            <img src="images/banner/60e17e81e5ddc1.03782604.jpg" alt="">
            <div class="info">
                <h2>SHOW NOW! AND GIVE US YOUR FEEDBACK</h2>
                <p>Don't hesitate to reach us, Cartmart shoppers! Feel free to contact us anytime. Your feedback is important to us as we continuously aim to improve our services.</p>
                <a href="#h1"><input type="button" value="SHOP NOW"></a>    
            </div>
        </div>
        <div class="slide">
            <img src="images/banner/shopnow.jpg" alt="">
            <div class="info">
                <h2>NO TIME FOR GROCERIES? NO PROBLEM! WE WILL DELIVER YOUR GOODS RIGHT AT YOUR DOORSTEP</h2>
                <p>Need some stuff but too lazy to get out? You are at the right place. CartMart does same day delivery, seamless delivery,  affordable delivery, and safe delivery! Just sit back and relax, place your order, and wait for us to knock on your doors. Easy!</p>
            </div>
        </div>
        <div class="slide">
            <img src="images/banner/buy.jpg" alt="">
            <div class="info">
                <h2>JULY 16 IS YOUR LUCKY DAY!</h2>
                <p>Mark your calendars and save the date as we celebrate our first grand opening sale! Items are on sale for up to 70% off. Hurry! Don't miss the chance.</p>
            </div>
        </div>
        <div class="slide">
            <img src="images/banner/phone.jpg" alt="">
            <div class="info">
                <h2>GRAB YOUR PHONE AND BROWSE OUR VARIOUS PRODUCTS</h2>
                <p>Enjoy shopping online at the convenience of your own home! Enrich your cart with all your favorite stuff. Shop now at Cartmart!</p>
            </div>
        </div>
        <div class="navigation">
            <div class="btn active"></div>
            <div class="btn"></div>
            <div class="btn"></div>
            <div class="btn"></div>
            <div class="btn"></div>
        </div>
    </div>

    <script type="text/javascript">
        var slides = document.querySelectorAll('.slide');
        var btns = document.querySelectorAll('.btn');
        let currentSlide = 1;

        // manual navigation
        var manualNav = function (manual) {
            slides.forEach((slide) => {
                slide.classList.remove('active');

                btns.forEach((btn) => {
                    btn.classList.remove('active');
                });
            });

            slides[manual].classList.add('active');
            btns[manual].classList.add('active');
        }

        btns.forEach((btn, i) => {
            btn.addEventListener("click", () => {
                manualNav(i);
                currentSlide = i;
            });
        });

        // autoplay navigation
        var repeat = function (activeClass) {
            let active = document.getElementsByClassName('active');
            let i = 1;

            var repeater = () => {
                setTimeout(function () {
                    [...active].forEach((activeSlide) => {
                        activeSlide.classList.remove('active');
                    });

                    slides[i].classList.add('active');
                    btns[i].classList.add('active');
                    i++;

                    if (slides.length == i) {
                        i = 0;
                    }
                    if (i >= slides.length) {
                        return;
                    }
                    repeater();
                }, 5000);
            }
            repeater();
        }
        repeat();
    </script>
    </section>
    <section class="product-presentation">
        <h1>OUR PRODUCTS</h1>
        <div class="products-wrapper" id="products-wrapper">
            
        </div>
    </section>
    <script>
        getCategory();



        function scrollHorizontally(e) {
            e = window.event || e;
            var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
            document.getElementById('products-wrapper').scrollLeft -= (delta * 150); // Multiplied by 40
            e.preventDefault();
        }

        document.getElementById('products-wrapper').addEventListener('mousewheel', scrollHorizontally, false);
        var elem = document.getElementById('products-wrapper');

        var interval = setInterval(function () {
            var y = elem.scrollLeft + elem.clientWidth;
    
            if (y >= elem.scrollWidth) {
                elem.scrollLeft = 0;
            }else{
                elem.scrollLeft += 175;
            }

        }, 3000);

    </script>
    <section id="h1" class="product-presentation-2">
        <h1>WHAT'S NEW?</h1>
        <div class="products-wrapper-2" id="mycontainer">
            <?php
                $result = $database->getProductData("WHAT'S NEW?");
                if (isset($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        component($row['productimg'],$row['productname'],$row['price'],$row['productID'], $row['branchID']);
                    }
                }
            ?>
        </div>
    </section>
    <section class="product-presentation-2">
        <h1 id="h1">99 AND BELOW</h1>
        <div class="products-wrapper-2" id="mycontainer">
            <?php
                $result = $database->getProductData('99');
                if (isset($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        component($row['productimg'],$row['productname'],$row['price'],$row['productID'], $row['branchID']);
                    }
                }
            ?>
        </div>
        <div class="banner">
            <div class="banner-img">
                <img src="images/banner/saleviolet.jpg" alt="">
            </div>
        </div>
    </section>
    <section class="product-presentation-2">
        <h1 id="h1">HOT OFFERS</h1>
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
    <section class="product-presentation-2">
        <h1 id="h1">BEVERAGES</h1>
        <div class="products-wrapper-2" id="mycontainer">
            <?php
                $result = $database->getProductData("BEVERAGES");
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