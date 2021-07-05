<?php

    $con = mysqli_connect('localhost','root','','marketdb');

    if (mysqli_connect_errno($con)) {
        die('An error occured: ' . mysqli_connect_error());
    }else {

        $productID = $_POST['productid'];

        $query = "SELECT productdescription FROM producttable WHERE productID = '$productID'";

        if ($result = mysqli_query($con, $query)) {
            while ($rows = mysqli_fetch_assoc($result)) {
                echo $rows['productdescription'];
            }
        }
        
    }

?>