<?php

    session_start();

    if (isset($_SESSION['sessioncustomerid'])) {
        $customerid = $_SESSION['sessioncustomerid'];
    }

    $con = mysqli_connect('localhost','root','','marketdb');

    if (isset($_POST['productid']) && isset($_SESSION['buynow']) || (isset($_POST['productid']) && isset($_POST['showDescription']))) {
        $query = "SELECT producttable.branchID, producttable.productID, producttable.productimg, producttable.productname, producttable.quantity, producttable.price, producttable.productdescription, producttable.productcategory, producttable.producttype, producttable.productbrand FROM producttable WHERE producttable.productID = '$_POST[productid]' AND producttable.branchID = '$_POST[branchid]'";
    }else {
        $query = "SELECT carttable.customerID, carttable.productid, carttable.inccheckout, producttable.branchid, producttable.productimg, producttable.productname, producttable.price, carttable.quantity, CONCAT(customertable.customerfname, ' ' , customertable.customerlname) as customername, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress from carttable INNER JOIN producttable ON carttable.productID = producttable.productID INNER JOIN customertable ON carttable.customerID = customertable.customerID WHERE carttable.customerID = '$customerid'";
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
        $query = "SELECT CONCAT(customertable.customerfname, ' ' , customertable.customerlname) as customername, customertable.customeraddress, customertable.mobilenumber, customertable.emailaddress FROM customertable WHERE customerID = '$customerid'";

        $result = mysqli_query($con, $query);

        while ($datas = mysqli_fetch_assoc($result)) {
            $arr_data[] = $datas;
        }
    }

    $arr_data[] = $arr_count;

    echo json_encode($arr_data);

?>