<?php

    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        $message = mysqli_escape_string($con,$_POST['message']);

        $query = "INSERT INTO messages (fromuser, touser, txtmessage) VALUES ('000000001', '000000000', '$message')";

        if (!mysqli_query($con, $query)) {
            die("An error occurred: " . mysqli_error($con));
        }
        
    }

    mysqli_close($con);

?>