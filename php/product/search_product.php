<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred while connecting" . mysqli_connect_error());
    }else {
        $value = $_POST['value'];

        $query = "SELECT branchid, productid, productimg, productname, price FROM producttable WHERE productname LIKE '$value%'";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }
        }else {
            die("An error occurred while connecting: " . mysqli_error($con));
        }
    }

    mysqli_close($con);

?>