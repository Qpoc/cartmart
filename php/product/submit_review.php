<?php

    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)){
        die("An error occurred while connecting: " . mysqli_connect_error());
    }else {
        
        $transactionid = $_POST['transactionid'];
        $customerid = $_SESSION['sessioncustomerid'];
        $branchid = $_POST['branchid'];
        $productid = $_POST['productid'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $date = date('Y-m-d');

        if ($comment != '') {
            $query = "INSERT INTO productreview (transactionID, customerID, productID, branchID, review, dateadded) VALUES ('$transactionid', '$customerid', '$productid', '$branchid', '$comment', '$date')";

            if (!mysqli_query($con, $query)) {
                die("An error occurred: " . mysqli_error($con));
            }
        }

        $query = "INSERT INTO productrating (transactionID, customerID, productID, branchID, rating, dateadded) VALUES ('$transactionid', '$customerid', '$productid', '$branchid', $rating, '$date')";

            if (!mysqli_query($con, $query)) {
                die("An error occurred: " . mysqli_error($con));
            }

    }

    mysqli_close($con);


?>