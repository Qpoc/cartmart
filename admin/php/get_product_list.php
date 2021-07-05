<?php
    
    $con = mysqli_connect('localhost','root','','marketdb');


    if (mysqli_connect_errno($con)) {
        die('An error occured: ' . mysqli_connect_error());
    }else {

        if (isset($_POST['offset'])) {
            $offset = $_POST['offset'];

            $query = "SELECT productID, branchID, productimg, productname, quantity, price, productdescription, productcategory, producttype, productbrand, dateadded FROM producttable ORDER BY productcategory,producttype LIMIT 5 OFFSET $offset";
            
        }else if (isset($_POST['productid']) && isset($_POST['branchid'])) {

            $productid = $_POST['productid'];
            $branchid = $_POST['branchid'];

            $query = "SELECT producttable.productID, producttable.branchID, producttable.productimg, producttable.productname, producttable.quantity, producttable.price, producttable.productdescription, producttable.productcategory, producttable.producttype, producttable.productbrand, producttable.dateadded, branchtable.branchname FROM producttable INNER JOIN branchtable ON producttable.branchID = branchtable.branchID WHERE producttable.productID = '$productid' AND producttable.branchID = '$branchid'";
        }

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    $arr[] = $rows;
                }
    
                echo json_encode($arr);
            }else {
                echo 'error';
            }
        }
        
    }

?>