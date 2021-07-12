<?php

    session_start();
    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " .  mysqli_connect_error());
    }else {
        
        $date = date('Y-m-d');
        $category_name = $_POST['category_name'];
        $category_type = $_POST['category_type'];
        
        $query = "INSERT INTO itemcategory (productcategory, producttype, dateadded) VALUES ('$category_name', '$category_type', '$date')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }else {
            mysqli_close($con);
            header("location:../category.php");
        }
        
    }

?>