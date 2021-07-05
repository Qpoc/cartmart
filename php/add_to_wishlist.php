<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die('An error occured: ' . mysqli_connect_error());
    }else {
        $productid = $_POST['productid'];
        $branchid = $_POST['branchid'];
        $customerid = $_SESSION['sessioncustomerid'];

        $query = "INSERT INTO wishlist (customerID, productID, branchid) VALUES ('$customerid', '$productid', '$branchid')";

        if (!mysqli_query($con, $query)) {
            $query = "DELETE FROM wishlist WHERE productID = '$productid' AND customerID = '$customerid' AND branchid = '$branchid'";
            if (!mysqli_query($con, $query)) {
                echo "An error occured";
            }
            echo 'deleted';
        }else {
            echo 'added';
        }

        mysqli_close($con);

    }

?>