<?php
    session_start();

    if (!isset($_SESSION['sessioncustomerid'])) {
        echo false;
    }else {
        if (isset($_POST['productid'])) {
           
            $con = mysqli_connect('localhost', 'root', '', 'marketdb');

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