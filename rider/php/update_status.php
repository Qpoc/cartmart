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

        if ($value == 'Delivered') {
            $query = "SELECT ordertable.branchid, ordertable.productid, producttable.productpoints, transactiontable.customerid FROM ordertable INNER JOIN producttable ON ordertable.productid = producttable.productid AND ordertable.branchid = producttable.branchid INNER JOIN transactiontable ON ordertable.transactionid = transactiontable.transactionid WHERE ordertable.transactionid = '$transactionid'";

            $points = 0;
            $customerid = "";
            if ($result = mysqli_query($con, $query)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $points += $row['productpoints'];
                        $customerid = $row['customerid'];
                    }
                }
            }

            $query = "INSERT INTO customerpoints (customerid, customerpoints) VALUES ('$customerid', $points) ON DUPLICATE KEY UPDATE customerpoints = customerpoints + $points";

            if (!mysqli_query($con, $query)) {
                die("An error occurred: " . mysqli_error($con));
            }    
        }
    }

    mysqli_close($con);

?>