<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username='ShopAtCartMart@gmail.com';
    $mail->Password="shopcartmart";
    $mail->setFrom('ShopAtCartMart@gmail.com', 'CartMart');
    $mail->addAddress("$_SESSION[sessioncustomeremail]");
    $mail->addReplyTo('ShopAtCartMart@gmail.com');
    $mail->isHTML(true);
    $mail->Subject='Your order has been placed';
    $mail->Body="<h1>Order Confirmation</h1><br><p>This will served as a receipt and confirmation that your order has been placed. Thank you! and enjoy shopping at CartMart</p><ul><li>Transaction ID: $_SESSION[transactionid]</li><li>Total: $_SESSION[totalPrice]</li><li>Date: $_SESSION[dateorder]</li></ul><h4>Follow us on our Facebook Page<br>If you have any concern contact us at 145-4515 or visit our website <a href='http://cartmart.epizy.com'>http://cartmart.epizy.com</a></h4>";

    $mail->send();

    if (isset($_SESSION['branch'])) {
        unset($_SESSION['branch']);
        unset($_SESSION['productid']);
        unset($_SESSION['quantity']);
        unset($_SESSION['item_total_price']);
        unset($_SESSION['subtotal']);
        unset($_SESSION['del_fee']);
        unset($_SESSION['total_price']);
        unset($_SESSION['mod']);
        unset($_SESSION['points']);
    }else {
        header("location:index.php");
    }
    

?>