<?php

    require_once("createDB.php");
    require_once("connection.php");

    $database = new CreateDB();
    $connection = new Connection();
    $con = $connection->get_connection();

    date_default_timezone_set('Asia/Manila');

    //check
    if (mysqli_connect_errno($con)) {
        echo "Error encounter: " . mysqli_connect_error();
    }else{

        $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
        $customerID = substr(uniqid(str_shuffle($combiStr)), 3, 9);
        $firstname = mysqli_real_escape_string($con,$_REQUEST['firstname']);
        $lastname = mysqli_real_escape_string($con,$_REQUEST['lastname']);
        $address = mysqli_real_escape_string($con,$_REQUEST['address']);
        $mobilenumber = mysqli_real_escape_string($con,$_REQUEST['mobilenumber']);
        $email = mysqli_real_escape_string($con,$_REQUEST['email']);
        $username = mysqli_real_escape_string($con,$_REQUEST['username']);
        $password =  mysqli_real_escape_string($con,hash('sha256', $_REQUEST['password']));
        $date = date('Y-m-d');
        $longitude = mysqli_real_escape_string($con, $_REQUEST['longitude']);
        $latitude = mysqli_real_escape_string($con, $_REQUEST['latitude']);

        //query insert
        $query = "INSERT INTO customertable(customerID, customerlname, customerfname, customeraddress, mobilenumber, emailaddress, dateadded, longitude, latitude) VALUES ('$customerID', '$lastname', '$firstname', '$address', '$mobilenumber', '$email', '$date', '$longitude', '$latitude')";

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
    }

    mysqli_close($con);

?>