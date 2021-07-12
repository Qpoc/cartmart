<?php

    session_start();

    require_once('../connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $customerid = $_SESSION['sessioncustomerid'];
        
        if (isset($_POST['offset']) && !isset($_POST['review'])) {
            $offset = $_POST['offset']; 

            $query = "SELECT transactiontable.transactionID, transactiontable.customerID, transactiontable.totalprice, transactiontable.dateadded, transactionstatus.transactstatus, ordertable.productID, ordertable.branchID, producttable.productimg, producttable.productname, productrating.rating FROM transactiontable INNER JOIN transactionstatus ON transactiontable.transactionID = transactionstatus.transactionID INNER JOIN ordertable ON transactiontable.transactionID = ordertable.transactionID INNER JOIN producttable ON ordertable.productID = producttable.productID AND ordertable.branchID = producttable.branchID LEFT JOIN productrating ON transactiontable.transactionID = productrating.transactionID WHERE transactionstatus.transactstatus = 'Delivered' AND transactiontable.customerID = '$customerid' LIMIT 5 OFFSET $offset";
        }else if(isset($_POST['offset']) && isset($_POST['review'])){
            $offset = $_POST['offset']; 

            $query = "SELECT transactiontable.transactionID, transactiontable.customerID, transactiontable.totalprice, transactiontable.dateadded, transactionstatus.transactstatus, ordertable.productID, ordertable.branchID, producttable.productimg, producttable.productname FROM transactiontable INNER JOIN transactionstatus ON transactiontable.transactionID = transactionstatus.transactionID INNER JOIN ordertable ON transactiontable.transactionID = ordertable.transactionID INNER JOIN producttable ON ordertable.productID = producttable.productID AND ordertable.branchID = producttable.branchID LEFT JOIN productrating ON transactiontable.transactionID = productrating.transactionID WHERE transactionstatus.transactstatus = 'Delivered' AND transactiontable.customerID = '$customerid' AND transactiontable.transactionID NOT IN (SELECT transactionID FROM productrating) LIMIT 5 OFFSET $offset";
        }

        if (isset($_POST['productid']) && isset($_POST['branchid'])) {

            $query = "SELECT productname, productimg FROM producttable WHERE productID = '$_POST[productid]' AND branchID = '$_POST[branchid]'";
        }

        
        if($result = mysqli_query($con, $query)){
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

    mysqli_close($con);


?> 
