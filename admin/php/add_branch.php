<?php

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " .  mysqli_connect_error());
    }else {
        
        $date = date('Y-m-d');
        $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
        $branchID = substr(uniqid(str_shuffle($combiStr)), 3 , 9);
        $branch_name = $_POST['branch_name'];
        $branch_address = $_POST['branch_address'];
        
        $query = "INSERT INTO branchtable (branchID, branchname, branchaddress, dateadded) VALUES ('$branchID', '$branch_name', '$branch_address', '$date')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }else {
            mysqli_close($con);
            header("location:../branch.php");
        }
        
    }

?>