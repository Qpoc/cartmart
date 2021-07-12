<?php

    session_start();
    
    require_once('../connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $transactionid = $_POST['transactionid'];

        $query = "SELECT transactionstatus.transactionID, transactionstatus.transactstatus, ridertransaction.email FROM transactionstatus INNER JOIN ridertransaction ON transactionstatus.transactionID = ridertransaction.transactionID WHERE transactionstatus.transactionID = '$transactionid'";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }
        }else {
            die("An error occurred: " . mysqli_error($con));
        }
        
    }

?>