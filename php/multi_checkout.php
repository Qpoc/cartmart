<?php

    session_start();
    
    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die('An error occured: ' . mysqli_connect_error());
    }else {

        $customerid = $_SESSION['sessioncustomerid'];

        $query = "SELECT carttable.customerID, carttable.productid, carttable.inccheckout, producttable.productID, producttable.branchID, producttable.productimg, producttable.productname, producttable.price, carttable.quantity, CONCAT(customertable.customerfname, ' ' , customertable.customerlname) as customername, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress from carttable INNER JOIN producttable ON carttable.productID = producttable.productID INNER JOIN customertable ON carttable.customerID = customertable.customerID WHERE carttable.inccheckout = 'true' AND carttable.customerID = '$customerid'";

        if ($result = mysqli_query($con, $query)) {
           if (mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                   $rows[] = $row;
               }

               $json = json_encode($rows);
               echo $json;
           }
        }else {
            echo 'error';
        }
    }


?>