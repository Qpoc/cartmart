<?php

    session_start();
    require_once("../connection.php");
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred while connecting: " . mysqli_connect_error());
    }else {
        $admin_email = $_SESSION['adminemail'];

        $query = "SELECT admintable.email, admintable.fname, admintable.lname, admintable.mobile, adminimg.adminimg FROM admintable INNER JOIN adminimg ON admintable.email = adminimg.email WHERE admintable.email = '$admin_email'";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)){
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }
        }else {
            die("An error occurred: " . mysqli_error($con));
        }
    }


?>