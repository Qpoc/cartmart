<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $customerid = $_SESSION['sessioncustomerid'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];

        $query = "INSERT INTO custgenderbirth (customerID, gender, birthday) VALUES ('$customerid','$gender','$birthday') ON DUPLICATE KEY UPDATE gender = '$gender', birthday = '$birthday'";

        if (!mysqli_query($con, $query)){
            die("An error occurred: " . mysqli_error($con));
        }else {
            header("location:../../profile.php");
        }
        
    }

    mysqli_close($con);
?>