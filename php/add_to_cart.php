<?php
    session_start();

    require_once('connection.php');
  
    if (!isset($_SESSION['sessionusername']) && !isset($_SESSION['sessionpassword'])) {
        echo "false";
    }else {
        $connection = new Connection();
        $con = $connection->get_connection();
    
        $customerid = $_SESSION['sessioncustomerid'];

        if (mysqli_connect_error()) {
            die("Error occured:");
        }else {
           
        if (isset($_POST['productid']) && isset($_POST['branchid'])) {
            
            $productid = $_POST['productid'];
            $branchid = $_POST['branchid'];
           
            if ($_POST['addQuantity'] == 1 || $_POST['addQuantity'] == 3) {
                if (isset($_POST['descriptionquantity'])) {
                    
                    $query = "INSERT INTO carttable(branchID, productID, customerID, quantity, inccheckout) VALUES ('$branchid', '$productid', '$customerid', '$_POST[descriptionquantity]', 'false') ON DUPLICATE KEY UPDATE quantity = quantity + $_POST[descriptionquantity]";
                    
                }else {
                    $query = "INSERT INTO carttable(branchID, productID, customerID, quantity, inccheckout) VALUES ('$branchid', '$productid', '$customerid', 1, 'false') ON DUPLICATE KEY UPDATE quantity = quantity + 1";
                }
             
            }else if($_POST['addQuantity'] == 0){
                if ($_POST['quantity'] > 1) {
                    $query = "INSERT INTO carttable(branchID, productID, customerID, quantity, inccheckout) VALUES ('$branchid', '$productid', '$customerid', 1, 'false') ON DUPLICATE KEY UPDATE quantity = quantity - 1";
                }
            }else if($_POST['addQuantity'] == 2){
                $query = "DELETE FROM carttable WHERE productID = '$productid' AND branchID = '$branchid' AND customerID = '$customerid'";
            }
            
            if (mysqli_query($con, $query)) {
                
                mysqli_close($con);
            }
        }

        }
    }

?>