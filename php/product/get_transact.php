<?php

    session_start();

    require_once('../connection.php');

    $connection = new Connection();

    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        date_default_timezone_set('Asia/Singapore');

        $customerid = $_SESSION['sessioncustomerid'];
        $date = date("Y-m-d");

        $query = "SELECT transactiontable.transactionID, transactiontable.customerID, transactiontable.dateadded, ridertransaction.email, CONCAT(ridertable.fname, ' ', ridertable.lname) AS ridername, ridertable.mobile FROM transactiontable INNER JOIN ridertransaction ON transactiontable.transactionID = ridertransaction.transactionID INNER JOIN ridertable ON ridertransaction.email = ridertable.email WHERE transactiontable.customerID = '$customerid' AND transactiontable.accept = 'true'";

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