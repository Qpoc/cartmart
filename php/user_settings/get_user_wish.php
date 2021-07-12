<?php
    session_start();

    require_once('../connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $customerid = $_SESSION['sessioncustomerid'];

        $query = "SELECT wishlist.productID, wishlist.branchID, producttable.productimg, producttable.productname FROM wishlist INNER JOIN producttable ON wishlist.productID = producttable.productID WHERE wishlist.customerID = '$customerid'";

        if ($result = mysqli_query($con, $query)) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $row[] = $rows;
            }

            $json = json_encode($row);

            echo $json;
        }else {
            echo 'error';
            die("An error occurred: " . mysqli_error($con));
        }
    }

?>