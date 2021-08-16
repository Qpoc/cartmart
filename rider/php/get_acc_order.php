<?php
    session_start();

    require_once('connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " .  mysqli_connect_error($con));
    }else {
        
        $email = $_SESSION['rideremail'];
        $offset = $_POST['offset'];

        $query = $query = "SELECT ridertransaction.email, ridertransaction.transactionID, transactiontable.customerID, transactiontable.modepayment, CONCAT(customertable.customerfname, ' ', customertable.customerlname) AS personname, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress, customerimg.customerimg, transactionstatus.transactstatus FROM ridertransaction INNER JOIN transactiontable ON ridertransaction.transactionID = transactiontable.transactionID INNER JOIN customertable ON transactiontable.customerID = customertable.customerID LEFT JOIN customerimg ON transactiontable.customerID = customerimg.customerID INNER JOIN transactionstatus ON ridertransaction.transactionID = transactionstatus.transactionID WHERE ridertransaction.email = '$email' AND transactionstatus.transactstatus != 'Delivered' LIMIT 5 OFFSET $offset";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }
        }else {
            die("An error occured: " . mysqli_error($con));
        }
    }

    mysqli_close($con);

?>