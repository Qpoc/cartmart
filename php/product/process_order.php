<?php

    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
        header("location:../../checkout.php");
    }else {

        date_default_timezone_set("Asia/Manila");

        $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
        $transactionid = substr(uniqid(str_shuffle($combiStr)), 3 , 9);
        $_SESSION['transactionid'] = $transactionid;
        $orderid = substr(uniqid(str_shuffle($combiStr)), 3 , 9);
        $branchid = $_POST['branchid'];
        $customerid = $_SESSION['sessioncustomerid'];
        $productid = $_POST['productid'];
        $quantity = $_POST['quantity'];
        $item_total_price = $_POST['itemTotalPrice'];
        $subtotal = $_POST['subtotal'];
        $del_fee = $_POST['deliveryFee'];
        $total_price = $_POST['totalPrice'];
        $mod = $_POST['mod'];
        $accept = 'false';
        $date = date('Y-m-d');
        $points = $_POST['hidCoins'];

        $query = "INSERT INTO transactiontable (transactionID, customerID, subtotal, delfee, totalprice, dateadded, accept, modepayment) VALUES ('$transactionid', '$customerid', $subtotal, '$del_fee', $total_price, '$date', '$accept', '$mod')";

        if (mysqli_query($con, $query)) {
            $output = "";
            for ($index=0; $index < count($productid); $index++) { 
                $output = $output . "('$transactionid', '$branchid[$index]', '$productid[$index]', $quantity[$index], $item_total_price[$index])";
                if ($index + 1 != count($productid)) {
                    $output = $output . ", ";
                }
            }
            
            $query = "INSERT INTO ordertable (transactionID, branchID, productID, quantity, itemprice) VALUES " . $output;

            if (mysqli_query($con, $query)) {
                // additional
                $query = "UPDATE customerpoints SET customerpoints = '$points' WHERE customerid = '$customerid'";

                if (mysqli_query($con, $query)) {
                    $_SESSION['transactionid'] = $transactionid;
                    $_SESSION['totalPrice'] = $total_price;
                    $_SESSION['dateorder'] = $date;
                    require "../../Mailer/mail.php";
                    header("location:../../track_order.php");
                }else {
                    die("An error occurred: " . mysqli_error($con));
                    header("location:../../checkout.php");
                }

            }else {
                die("An error occurred: " . mysqli_error($con));
                header("location:../../checkout.php");
            }


        }else {
            header("location:../../checkout.php");
        }
    }

    mysqli_close($con);

?>