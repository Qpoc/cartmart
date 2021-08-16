<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else{
        $email = $_SESSION['rideremail'];

        $query = "SELECT ridertable.email, ridertable.fname, ridertable.lname, ridertable.mobile, ridertable.dateadded, riderimg.riderimg FROM ridertable LEFT JOIN riderimg ON ridertable.email = riderimg.email WHERE ridertable.email = '$email'";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }
        }
    }

    mysqli_close($con);

?>