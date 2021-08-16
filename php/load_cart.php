<?php

    session_start();

    require_once('connection.php');

    if (isset($_SESSION['sessioncustomerid'])) {
        $customerid = $_SESSION['sessioncustomerid'];
    }

    $connection = new Connection();
    $con = $connection->get_connection();

    if (isset($_POST['productid']) && isset($_SESSION['buynow']) || (isset($_POST['productid']) && isset($_POST['showDescription']))) {
        $query = "SELECT producttable.branchID, producttable.productID, producttable.productimg, producttable.productname, producttable.quantity, producttable.price, producttable.productdescription, producttable.productcategory, producttable.producttype, producttable.productbrand, producttable.productpoints, branchtable.longitude, branchtable.latitude FROM producttable INNER JOIN branchtable ON producttable.branchID = branchtable.branchID WHERE producttable.productID = '$_POST[productid]' AND producttable.branchID = '$_POST[branchid]'";
    }else {
        $query = "SELECT carttable.customerID, carttable.productid, carttable.inccheckout, producttable.branchid, producttable.productimg, producttable.productname, producttable.price, carttable.quantity, CONCAT(customertable.customerfname, ' ' , customertable.customerlname) as customername, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress, customertable.longitude AS custLng, customertable.latitude AS custLat, branchtable.longitude, branchtable.latitude from carttable INNER JOIN producttable ON carttable.productID = producttable.productID INNER JOIN customertable ON carttable.customerID = customertable.customerID INNER JOIN branchtable ON producttable.branchID = branchtable.branchID WHERE carttable.customerID = '$customerid'";
    }

    $result = mysqli_query($con,$query);
    $count = 0;

    while ($datas = mysqli_fetch_assoc($result)) {
        $arr_data[] = $datas;
        $count++;
    }

    $_SESSION['count_cart'] = $count;
 
    $arr_count = array(
        "total"=> $count
    );

    if (isset($_SESSION['buynow'])) {
        $query = "SELECT CONCAT(customertable.customerfname, ' ' , customertable.customerlname) as customername, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress, customertable.longitude AS custLng, customertable.latitude AS custLat, customerpoints.customerpoints FROM customertable LEFT JOIN customerpoints ON customertable.customerid = customerpoints.customerid WHERE customertable.customerID = '$customerid'";

        $result = mysqli_query($con, $query);

        while ($datas = mysqli_fetch_assoc($result)) {
            $arr_data[] = $datas;
        }
    }

    $arr_data[] = $arr_count;

    echo json_encode($arr_data);

?>