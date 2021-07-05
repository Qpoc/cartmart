<?php

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    $product_ID = $_POST['productid'];
    $branch_ID = $_POST['branchid'];

    if (mysqli_connect_errno($con)) {
        die("An error occured: " . mysqli_connect_error());
    }else {
        $query = "DELETE FROM producttable WHERE productID = '$product_ID' AND branchID = '$branch_ID'";

        if (mysqli_query($con, $query)) {
            echo true;
        }else {
            echo false;
        }
    }


?>