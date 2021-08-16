<?php

    session_start();
    
    require_once('../connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $transactionid = $_POST['transactionid'];

        $query = "SELECT transactionstatus.transactionID, transactionstatus.transactstatus, ridertransaction.email, transactiontable.customerid, customertable.longitude AS custlong, customertable.latitude AS custlat, ordertable.branchid, branchtable.longitude AS brlong, branchtable.latitude AS brlat FROM transactionstatus INNER JOIN ridertransaction ON transactionstatus.transactionID = ridertransaction.transactionID INNER JOIN transactiontable ON transactionstatus.transactionID = transactiontable.transactionid INNER JOIN customertable ON transactiontable.customerid = customertable.customerid INNER JOIN ordertable ON transactionstatus.transactionID = ordertable.transactionID INNER JOIN branchtable ON ordertable.branchid = branchtable.branchid WHERE transactionstatus.transactionID = '$transactionid'";

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