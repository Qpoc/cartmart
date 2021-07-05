<?php

    require_once("createDB.php");

    $database = new CreateDB();

    $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
    $customerID = substr(uniqid(str_shuffle($combiStr)), 3, 9);
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $address = $_REQUEST['address'];
    $mobilenumber = $_REQUEST['mobilenumber'];
    $email = $_REQUEST['email'];
    $username = $_REQUEST['username'];
    $password =  hash('sha256', $_REQUEST['password']);
    $date = date('Y-m-d');

    //connection
    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    //check
    if (mysqli_connect_errno($con)) {
        echo "Error encounter: " . mysqli_connect_error();
    }

    //query insert
    $query = "INSERT INTO customertable(customerID, customerlname, customerfname, customeraddress, mobilenumber, emailaddress, dateadded) VALUES ('$customerID', '$lastname', '$firstname', '$address', '$mobilenumber', '$email', '$date')";

    if (!mysqli_query($con, $query)) {
        echo "Error encountered: " . mysqli_error($con);
    } else {

        $query = "INSERT INTO customerregistration(customerID, customerusername, customerpassword) VALUES ('$customerID','$username', '$password')";

        if (!mysqli_query($con, $query)) {
            echo "Error encountered: " . mysqli_error($con);
        } else {
            echo "<script>alert('Successfully Register')</script>";
            echo "<script>window.location.href='../login.php'</script>";
        }
    }

    mysqli_close($con);

?>