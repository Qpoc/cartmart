<?php

    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        
        $points = $_POST['points'];
        $customerid = $_SESSION['sessioncustomerid'];
        
        $query = "UPDATE customerpoints SET customerpoints = $points WHERE customerid = '$customerid'";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }
        
    }

    mysqli_close($con);

?>