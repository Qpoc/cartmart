<?php
    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occured while connecting to " . mysqli_connect_error());
    }else {

        $date = Date('Y-m-d');

        $query = "SELECT transactionstatus.transactionID, SUM(transactiontable.subtotal) AS totalsales FROM transactionstatus INNER JOIN transactiontable ON transactionstatus.transactionID = transactiontable.transactionID WHERE transactionstatus.transactstatus = 'Delivered' AND transactiontable.dateadded = '$date'";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
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