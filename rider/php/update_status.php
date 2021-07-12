<?php

    require_once('connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();
    

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $value = $_POST['value'];
        $transactionid = $_POST['transactionid'];

        $query = "UPDATE transactionstatus SET transactstatus = '$value' WHERE transactionID = '$transactionid'";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }
        echo 'hello';
    }

    mysqli_close($con);

?>