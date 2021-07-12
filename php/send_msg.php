<?php

    session_start();

    require_once('connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $customerid = $_SESSION['sessioncustomerid'];
        $transactionid = $_POST['transactionid'];
        $email = $_POST['email'];

        $message = mysqli_escape_string($con,$_POST['message']);

        $query = "INSERT INTO customermessages (transactionID, customerID, email, txtmessage) VALUES ('$transactionid', '$customerid', '$email', '$message')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }
        
    }

    mysqli_close($con);

?>