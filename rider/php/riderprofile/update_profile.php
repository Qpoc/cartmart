<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mobile = $_POST['mobile'];

        $query = "UPDATE ridertable SET fname = '$fname', lname = '$lname', mobile = '$mobile', email = '$email' WHERE email = '$email'";

        if (mysqli_query($con, $query)){
            header("location:../../rider_details.php");
        }else {
            die("An error occurred: " . mysqli_error($con));
        }
        
    }

    mysqli_close($con);


?>