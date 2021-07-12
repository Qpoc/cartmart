<?php

    session_start();

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred while connecting: " . mysqli_connect_error());
    }else {
        $category = $_POST['editCategory'];
        $type = $_POST['editType'];
        $hid_category = $_POST['hidCategory'];
        $hid_type = $_POST['hidType'];

        $query = "UPDATE itemcategory SET productcategory = '$category', producttype = '$type' WHERE productcategory = '$hid_category' AND producttype = '$hid_type'";

        if (!mysqli_query($con, $query)) {
            die("An error occurred while: " . mysqli_error($con));
        }else {
            header("Location:../category.php");
        }
    }

    mysqli_close($con);
?>