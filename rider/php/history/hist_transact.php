<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("Error connecting to: " . mysqli_connect_error());
    }else {
        $email = $_SESSION['rideremail'];
        $offset = $_POST['offset'];

        $query = "SELECT ridertransaction.transactionid, ridertransaction.dateadded, transactiontable.customerid, transactiontable.totalprice, CONCAT(customertable.customerfname, ' ', customertable.customerlname) AS customername, customertable.customeraddress FROM ridertransaction INNER JOIN transactiontable ON ridertransaction.transactionid = transactiontable.transactionid INNER JOIN customertable ON transactiontable.customerid = customertable.customerid WHERE ridertransaction.email = '$email' LIMIT 5 OFFSET $offset";

        if ($result = mysqli_query($con, $query)){
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }
        }
    }

    mysqli_close($con);

?>