<?php

    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred while connecting: " . mysqli_connect_error());
    }else {
        $customerid = $_SESSION['sessioncustomerid'];
        $offset = $_POST['offset'];

        $query = "SELECT productrating.rating, productrating.dateadded, productrating.productid, productrating.branchid, productreview.review, producttable.productimg, producttable.productname FROM productrating LEFT JOIN productreview ON productrating.transactionid = productreview.transactionid INNER JOIN producttable ON productrating.productid = producttable.productid AND productrating.branchid = producttable.branchid WHERE productrating.customerid = '$customerid' ORDER BY productrating.dateadded LIMIT 5 OFFSET $offset";

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