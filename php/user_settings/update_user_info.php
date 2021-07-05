<?php

    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        echo $_POST['editFName'];
        echo $_POST['editLName'];
        echo $_POST['editEmail'];
        echo $_POST['editCellNum'];

        if (isset($_POST['editFName']) && isset($_POST['editLName']) && isset($_POST['editEmail']) && isset($_POST['editCellNum'])) {

            $customerid = $_SESSION['sessioncustomerid'];

            $fname = $_POST['editFName'];
            $lname = $_POST['editLName'];
            $email = $_POST['editEmail'];
            $number = $_POST['editCellNum'];

            $query = "UPDATE customertable SET customerfname = '$fname', customerlname = '$lname', emailaddress = '$email', mobilenumber = '$number' WHERE customerID = '$customerid'";

            if (mysqli_query($con, $query)) {
                header("location:../../main_settings.php");
            }else {
                die("An error occurred: " . mysqli_error($con));
                header("location:../../main_settings.php");
            }
        }else {
            header("location:../../main_settings.php");
        }
    }

    mysqli_close($con);


?>