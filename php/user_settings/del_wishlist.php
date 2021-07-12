<?php

    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

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