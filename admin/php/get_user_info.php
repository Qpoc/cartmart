<?php

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        echo 'error';
        die('An error occurred while connecting to: ' . mysqli_connect_error());
    }else {

        if (isset($_POST['offset'])) {
            $offset = $_POST['offset'];
        }

        $query = "SELECT customertable.customerID, CONCAT(customertable.customerfname, ' ', customertable.customerlname) AS customername, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress, customertable.dateadded, customerregistration.customerusername, customerregistration.customerpassword FROM customertable INNER JOIN customerregistration ON customertable.customerID = customerregistration.customerID LIMIT 4 OFFSET $offset";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)){
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
