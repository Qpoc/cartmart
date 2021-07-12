<?php

    session_start();

    require_once('../connection.php');

    $connection = new Connection();

    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $customerid = $_SESSION['sessioncustomerid'];
        $offset = $_POST['offset'];
        $date = date('Y-m-d');

        $query = "SELECT transactiontable.transactionID, transactiontable.customerID, transactiontable.subtotal, transactiontable.delfee, transactiontable.totalprice, transactiontable.dateadded, ridertransaction.email, CONCAT(ridertable.fname, ' ', ridertable.lname) AS ridername, ridertable.mobile, transactionstatus.transactstatus FROM transactiontable INNER JOIN ridertransaction ON transactiontable.transactionID = ridertransaction.transactionID INNER JOIN ridertable ON ridertransaction.email = ridertable.email LEFT JOIN transactionstatus ON transactiontable.transactionID = transactionstatus.transactionID WHERE transactiontable.customerID = '$customerid' AND transactiontable.accept = 'true' LIMIT 6 OFFSET $offset";

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