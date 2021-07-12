<?php

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $transactionid = $_POST['transactionid'];
        $customerid = $_POST['customerid'];

        $query = "SELECT ordertable.transactionID, ordertable.branchID, ordertable.productID, ordertable.quantity, ordertable.itemprice, transactiontable.customerID, transactiontable.subtotal, transactiontable.delfee, transactiontable.totalprice, producttable.productimg, producttable.productname, producttable.price, CONCAT(customerfname, ' ', customerlname) AS customername FROM ordertable INNER JOIN transactiontable ON ordertable.transactionID = transactiontable.transactionID INNER JOIN customertable ON transactiontable.customerID = customertable.customerID INNER JOIN producttable ON ordertable.productID = producttable.productID AND ordertable.branchID = producttable.branchID WHERE ordertable.transactionID = '$transactionid'";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }else {
                echo 'error';
            }
        }else {
            die("An error occurred: " . mysqli_error($con));
        }
    }

    mysqli_close($con);

?>