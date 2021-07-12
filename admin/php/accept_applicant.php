<?php

    session_start();

    require_once('connection.php');

    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $isAccept = $_POST['value'];
        $email = $_POST['email'];
        $applicant = $_POST['applicant'];


        if ($applicant == 'rider') {
            if ($isAccept == 'ACCEPT') {
                $query = "UPDATE ridertable SET approved = 'true' WHERE email = '$email'";
            }else if ($isAccept == 'REJECT') {
                $query = "DELETE FROM ridertable WHERE email = '$email'";
            }
        }else if ($applicant == 'admin') {
            if ($isAccept == 'ACCEPT') {
                $query = "UPDATE admintable SET approved = 'true' WHERE email = '$email'";
            }else if ($isAccept == 'REJECT') {
                $query = "DELETE FROM admintable WHERE email = '$email'";
            }
        }
            

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }
    }

    mysqli_close($con);

?>