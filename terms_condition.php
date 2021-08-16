<?php
session_start();

if (isset($_SESSION['sessionusername']) && isset($_SESSION['sessionpassword'])) {
    header("location:index.php");
}

require_once('php/createDB.php');
require_once('php/navigation.php');

$database = new CreateDB();

if (isset($_SESSION['buynow'])) {
    unset($_SESSION['buynow']);
    unset($_SESSION['branchid']);
}

if (isset($_SESSION['descriptionquantity'])) {
    unset($_SESSION['descriptionquantity']);
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/terms_condition.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/search.js"></script>

    <script src="script/product.js"></script>
    <script src="script/map.js"></script>
    <title>CartMart - Sign up</title>
</head>

<body>
    <header>
        <?php
            require_once('php/header.php');
        ?>
    </header>
    <main>
        <div class="term-wrapper">
            <div class="term-header">
                <h2>TERMS & CONDITIONS</h2>
                <p>The following Terms of Use shall govern your use and access of the Platform and of the services therein. The term “Platform” pertains to the web and mobile versions of the website jointly operated and/or owned by CartMart Inc. By accessing the Platform and/or using any of the services therein, you represent that you are at least 18 years old and agree, without limitation or qualification, to be bound by these Terms of Use. These Terms apply to all users of the site, including without limitation users who are browsers, vendors, customers, merchants, and/ or contributors of content.
                Our store is hosted on Infinity Free. They provide us with the online e-commerce platform that allows us to sell our products and services to you.
                </p>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Products, Pricing, Content and Specifications</h3>
                    <p>The products and services featured on the Platform (collectively, the "Products") and their contents, specifications, and prices are subject to change at any time, without need of prior notice. The prices of the Products may be different from that in CartMart physical stores.</p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Payment</h3>
                    <h4>Cash on Delivery</h4>
                    <p>You may also pay cash on delivery through our logistics courier. The total price for items or goods, including delivery fees, processing fees, and/or other charges, will be displayed on the Platform when you place your order. The grocery items you selected and included in your cart shall be subject to the actual availability of stocks in our physical stores. You will only be charged for the goods picked-up or delivered. The total bill shall be adjusted accordingly if goods ordered are unavailable.</p>
                    <h4>Failure to Pay</h4>
                    <p>If a Customer fails to make any payment using the payment method selected on the Platform or payment is cancelled for any reason whatsoever, CartMart shall cancel the order and/or suspend delivery or deny the collection of the Products from the participating store until payment is made in full. In addition, the Customer will be banned and no longer make any transactions for a month.</p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Accuracy of Information</h3>
                    <p>CartMart endeavors to provide an accurate description of the Products, but we do not warrant that such description, color, information, price or other content available on the Site are accurate, complete, reliable, current, or free from error. The weight, measurements and other descriptions provided on the Platform are approximate figures and are provided for convenience purposes only. We make all reasonable efforts to accurately display the attributes of the Products, including the applicable colors. However, the color you see on the Platform may differ from the actual color, depending on your mobile device, computer system, monitor, and/or other display features.
                    The Platform may contain typographical errors or inaccuracies and may not be complete or current. CartMart therefore reserves the right to correct any errors, inaccuracies or omissions (including after an order has been submitted) and to change or update information at any time without prior notice. Please note that such errors, inaccuracies or omissions may relate to pricing and availability, and we reserve the right to cancel or refuse to accept any order placed based on incorrect pricing or availability information. The prices and amount indicated serves only as a guide price and amount. Final prices and amount due will be reflected during payment and collection of items in the store.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Acceptance of Order</h3>
                    <p>We reserve the right, without prior notice, to limit the order quantity on any Product, to cancel any order at any time, and/or to refuse service to any customer. We also may require verification of information prior to the acceptance and/or shipment of any order. 
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Use of the Platform</h3>
                    <p>In using the Platform and the services therein, you agree to:
                    </p>
                    <ol>
                        <li>do so only for lawful purposes;</li>
                        <li>ensure that all information or data you provide on the Platform at the time of placement of the order are accurate and complete and take sole responsibility for such information and data;</li>
                        <li>be responsible for maintaining the confidentiality of your account information and password and for restricting access to such information and to your computer.</li>
                    </ol> 
                    <p>You agree to accept responsibility for all activities that occur under your account, whether such activity is authorized or not. You should notify us (CONTACT US TO) AHAHH immediately if you have knowledge or have reason for suspecting that the confidentiality of your account has been compromised or if there has been any unauthorized use thereof.</p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Right to Refuse Service</h3>
                    <p>We reserve the right, at our sole discretion, to refuse service to anyone for any reason at any time.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Intellectual Property</h3>
                    <p>All information and content available on the Platform, including but not limited to trademarks, logos, service marks, features, functions, text, graphics, logos, button icons, images, data compilations and software thereof (collectively, the "Content") are our property or property of some online e-commerce product listings that are protected by local and international laws, including laws governing copyrights and trademarks.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Alcohol Listing</h3>
                    <p>Any alcohol listings on the Site are intended for and may only be purchased by those who are 18 years old and above.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>InfinityFree Web Hosting</h3>
                    <p>This platform is hosted on InfinityFree Web Host. They provide us with the online e-commerce platform that allows us to sell our products and provide the Services to you. In using the platform, you consent to having your personal information, including your User Content, transferred or processed by InfinityFree. You also acknowledge that your purchase of and access to and use of the Platform and the Content herein may be subject to local and international laws applicable to InfinityFree, and it shall be your sole responsibility to ensure that you access or use the Platform and the Content only in compliance with such applicable laws.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Force Majeure</h3>
                    <p>CartMart shall not be liable for any loss or damage that result from causes over which it does not have control or is beyond its control. Such causes include, but are not limited to (i) the failure of electronic or mechanical equipment or communication lines; (ii) bugs, errors, configuration problems or the incompatibility of computer hardware or software; (iii) the failure or unavailability of Internet access; (iv) unauthorized access, theft or operator error; (v) war, insurrection, riot, civil commotion, act of God, accident, fire, water damage, explosion, power interruption, strike or other stoppage of labor; (vi) any law, decree, regulation or order of any government or government body. CartMart shall also not be responsible for any damage to the User’s computer, software, or other property resulting in any way from the use of this Site.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Revisions to these Terms and Conditions.</h3>
                    <p>We may revise these Terms of Use at any time and from time to time by updating this posting, without prior notice to you. You should visit this page from time to time to review the then current Terms of Use because they are binding on you.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Termination</h3>
                    <p>You or we may suspend or terminate your account or your use of the Platform at any time, with or without reason. You are personally liable for any orders or charges that you incur prior to termination of the account. We reserve the right to change, suspend, or discontinue all or any aspect of the Platform at any time without notice.
                    </p>
                </div>
            </div>
            <div class="term-container">
                <div class="header">
                    <h3>Additional Assistance</h3>
                    <p>If you have any questions or concerns, feel free you to contact us.
                    </p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
    <?php
    get_navigation();
    ?>
</body>

</html>