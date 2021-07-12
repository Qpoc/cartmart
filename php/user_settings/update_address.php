<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $customerid = $_SESSION['sessioncustomerid'];
        $address = $_POST['addressField'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        $query = "UPDATE customertable SET customeraddress = '$address', latitude = '$latitude', longitude = '$longitude' WHERE customerid = '$customerid'";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }else {
            header("location:../../address.php");
        }
        
    }

    mysqli_close($con);

?>