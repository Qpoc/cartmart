<?php

    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        $query = "SELECT * FROM branchtable";

        if ($result = mysqli_query($con, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }

            $json = json_encode($rows);

            echo $json;
        }else {
            echo 'error';
        }
    }

?>