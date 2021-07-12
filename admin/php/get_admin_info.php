<?php

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        echo 'error';
        die('An error occurred while connecting to: ' . mysqli_connect_error());
    }else {

        if (isset($_POST['offset'])) {
            $offset = $_POST['offset'];
        }


        $query = "SELECT email, CONCAT(fname, ' ',lname) as adminname, mobile, govID, dateadded FROM admintable WHERE approved = 'false' LIMIT 5 OFFSET $offset";

        if (isset($_POST['approved'])) {
            $query = "SELECT email, CONCAT(fname, ' ',lname) as adminname, mobile, govID, dateadded FROM admintable WHERE approved = 'true' LIMIT 5 OFFSET $offset";
        }

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }else {
                echo 'error';
            }
        }else {
            echo 'error';
        }
    }
    mysqli_close($con);
?>