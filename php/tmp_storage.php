<?php
    session_start();

    require_once('connection.php');

    if (!isset($_SESSION['sessioncustomerid'])) {
        echo false;
    }else {
        if (isset($_POST['productid'])) {
           
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occured: " . mysqli_connect_error());
            }else {

                $query = "UPDATE carttable SET inccheckout = '$_POST[ischecked]' WHERE customerID = '$_SESSION[sessioncustomerid]' AND productID = '$_POST[productid]' AND branchID = '$_POST[branchid]'";

                if (!mysqli_query($con, $query)) {
                    echo 'error';
                }
                
            }


        }
    }

  


?>