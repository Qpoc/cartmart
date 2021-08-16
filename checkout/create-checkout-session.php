<?php

session_start();

$combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
$_SESSION['transactionid'] = substr(uniqid(str_shuffle($combiStr)), 3 , 9);
$_SESSION['productid'] = $_POST['productid'];
$_SESSION['branch'] = $_POST['branchid'];
$_SESSION['quantity'] = $_POST['quantity'];
$_SESSION['item_total_price'] = $_POST['itemTotalPrice'];
$_SESSION['subtotal'] = $_POST['subtotal'];
$_SESSION['del_fee'] = $_POST['deliveryFee'];
$_SESSION['total_price'] = $_POST['totalPrice'];
$_SESSION['mod'] = $_POST['mod'];
$_SESSION['points'] = $_POST['hidCoins'];

require 'checkout/autoload.php';
\Stripe\Stripe::setVerifySslCerts(false);
\Stripe\Stripe::setApiKey('sk_test_51JDotrASdmMwdXqSGAaRZv5iyVLqu12WbwxG2rn0pN4zYbyjrZUUNgkCJNJz37MqP5zPQlDDbb9M4vYIdMy6K6CG002WmjkMic');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/OnlineSupermarket';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'php',
      'unit_amount' => $_POST['totalPrice'] * 100,
      'product_data' => [
        'name' => 'Total Cost:',
        'images' => ["images/banner/thankyou.jpg"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/checkout.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);