<?php

    session_start();

    require_once('connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " .  mysqli_connect_error());
    }else {
        
        $date = date('Y-m-d');
        $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
        $branchID = mysqli_real_escape_string($con, substr(uniqid(str_shuffle($combiStr)), 3 , 9));
        $branch_name = mysqli_real_escape_string($con, $_POST['branch_name']);
        $branch_address = mysqli_real_escape_string($con, $_POST['branch_address']);
        $longitude = mysqli_real_escape_string($con, $_POST['longitude']);
        $latitude = mysqli_real_escape_string($con, $_POST['latitude']);
        
        $query = "INSERT INTO branchtable (branchID, branchname, branchaddress, dateadded, longitude, latitude) VALUES ('$branchID', '$branch_name', '$branch_address', '$date', '$longitude', '$latitude')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }else {
            mysqli_close($con);
            header("location:../branch.php");
        }
        
    }

?>