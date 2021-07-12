<?php

    session_start();

    require_once('connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $transactionid = $_POST['transactionid'];

        $email = mysqli_real_escape_string($con, $_SESSION['rideremail']);
        
        $date = date('Y-m-d');

        $query = "INSERT INTO ridertransaction (email, transactionID, dateadded) VALUES ('$email', '$transactionid','$date')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }

        $query = "INSERT INTO transactionstatus (transactionID, transactstatus) VALUE ('$transactionid', 'accepted')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }

        $query = "UPDATE transactiontable SET accept = 'true' WHERE transactionID = '$transactionid'";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }
        
    }

    mysqli_close($con);

?>