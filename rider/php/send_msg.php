<?php

    session_start();

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $email = $_SESSION['rideremail'];
        $customerid = $_POST['customerid'];
        $transactionid = $_POST['transactionid'];
        
        $message = mysqli_escape_string($con,$_POST['message']);

        $query = "INSERT INTO ridermessages (transactionID, email, customerID, txtmessage) VALUES ('$transactionid','$email', '$customerid', '$message')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }
        
    }

    mysqli_close($con);

?>