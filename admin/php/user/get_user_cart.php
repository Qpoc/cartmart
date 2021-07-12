<?php

    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred while connecting" . mysqli_connect_error());
    }else{
        $customerid = $_POST['customerid'];

        $query = "SELECT carttable.branchID, carttable.productID, carttable.quantity, producttable.productimg, producttable.productname FROM carttable INNER JOIN producttable ON carttable.productID = producttable.productID WHERE customerID = '$customerid'";

        if ($result = mysqli_query($con, $query)){
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
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