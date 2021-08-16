<?php

    session_start();

    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        echo 'error';
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $customerid = $_SESSION['sessioncustomerid'];

        $query = "SELECT customerregistration.customerID, CONCAT(customertable.customerfname, ' ' , customertable.customerlname) as customername, customertable.customerfname, customertable.customerlname, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress, customerimg.customerimg, custgenderbirth.gender, custgenderbirth.birthday, customerpoints.customerpoints from customerregistration INNER JOIN customertable ON customerregistration.customerID = customertable.customerID LEFT JOIN customerimg ON customerregistration.customerID = customerimg.customerID LEFT JOIN custgenderbirth ON customerregistration.customerID = custgenderbirth.customerID LEFT JOIN customerpoints ON customerregistration.customerID = customerpoints.customerID WHERE customerregistration.customerID = '$customerid'";

        if ($result = mysqli_query($con, $query)) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $row[] = $rows;
            }

            $json = json_encode($row, true);

            echo $json;
        }else {
            echo 'error';
            die("An error occurred: " . mysqli_error($con));
        }
    }

?>