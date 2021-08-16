<?php
session_start();

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
    <link rel="stylesheet" href="css/faq.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
    <script src="script/search.js"></script>
    <title>CartMart - Sign up</title>
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
    <main>
        <div class="term-wrapper">
            <div class="term-header">
                <h2>Frequently Asked Questions</h2>
                <ol>
                    <li>
                        <div class="question-wrapper">
                            <div class="question">
                                <h3>1. Do you provide grocery shopping and delivery in my area?</h3>
                            </div>
                            <div class="answer">
                                <p>We continuously expand the coverage of the network of our delivery riders.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="question-wrapper">
                            <div class="question">
                                <h3>2. Can I trust CartMart to pick my meat, produce and other fresh foods?</h3>
                            </div>
                            <div class="answer">
                                <p>Absolutely! Our shoppers will pick your meats, produce and other fresh foods just as if they were shopping for themselves, including checking for the latest expiration date. If we don’t feel that it’s good enough for us, why would it be good enough for you?</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="question-wrapper">
                            <div class="question">
                                <h3>3. How far in advance do I need to order?</h3>
                            </div>
                            <div class="answer">
                                <p>Our delivery times are filed on a first come first served basis, and we get very busy during popular hours. So, we do ask that you place your order as early as possible to ensure your preferred delivery time.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="question-wrapper">
                            <div class="question">
                                <h3>4. Can I change or cancel my delivery time after I have placed my order?</h3>
                            </div>
                            <div class="answer">
                                <p>In most cases yes. You must contact us directly to make the change. You should call at least 3 hours before the scheduled delivery time. Sending an email may not be sufficient enough to stop you order from being processed.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="question-wrapper">
                            <div class="question">
                                <h3>5. Do I need to be home to receive my grocery deliver?</h3>
                            </div>
                            <div class="answer">
                                <p>Unless other arrangements have been made, someone must be home to receive and pay for the groceries and delivery service. </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="question-wrapper">
                            <div class="question">
                                <h3>6. What if I receive my grocery shopping and delivery order and realize that I ordered the wrong item?</h3>
                            </div>
                            <div class="answer">
                                <p>At CartMart, we prioritize customer satisfaction. Along with your grocery order, you should be given the actual receipt from the grocery store so you are able to make returns or exchanges. If the mistake is ours, we will make it right.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="question-wrapper">
                            <div class="question">
                                <h3>7. How specific do I have to be when I shop online in your website?</h3>
                            </div>
                            <div class="answer">
                                <p>Because we want you to be satisfied with your experience when shopping at CartMart, we ask that you be as specific as possible when browsing and selecting the products available. </p>
                            </div>
                        </div>
                    </li>
                </ol>
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