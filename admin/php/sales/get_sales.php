<?php
    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occured while connecting to " . mysqli_connect_error());
    }else {
        $query = "SELECT transactionstatus.transactionID, SUM(transactiontable.subtotal) AS totalsales, YEAR(transactiontable.dateadded) AS salesyear, MONTH(transactiontable.dateadded) AS monthSales FROM transactionstatus INNER JOIN transactiontable ON transactionstatus.transactionID = transactiontable.transactionID WHERE transactionstatus.transactstatus = 'Delivered' GROUP BY YEAR(transactiontable.dateadded), MONTH(transactiontable.dateadded) ORDER BY YEAR(transactiontable.dateadded), MONTH(transactiontable.dateadded)";

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