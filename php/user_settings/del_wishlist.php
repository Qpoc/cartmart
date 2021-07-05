<?php

    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        echo 'error';
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $customerID = $_SESSION['sessioncustomerid'];
        $productID = $_POST['productid'];


        $query = "DELETE FROM wishlist WHERE wishlist.productID = '$productID' AND wishlist.customerID = '$customerID'";

        if($result = mysqli_query($con, $query)){
            echo $result;
        }
        
        mysqli_close($con);
    }

?>