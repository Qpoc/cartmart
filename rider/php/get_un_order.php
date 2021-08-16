<?php

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $offset = $_POST['offset'];

        $query = "SELECT transactiontable.transactionID, transactiontable.customerID, transactiontable.modepayment, CONCAT(customertable.customerfname, ' ', customertable.customerlname) AS customername, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress, customerimg.customerimg FROM transactiontable INNER JOIN customertable ON transactiontable.customerID = customertable.customerID LEFT JOIN customerimg ON transactiontable.customerID = customerimg.customerID WHERE transactiontable.accept = 'false' LIMIT 5 OFFSET $offset";

        if ($result = mysqli_query($con,$query)) {
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
            echo 'error';
        }
    }

    mysqli_close($con);
?>