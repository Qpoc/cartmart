<?php

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die('An error occurred while connecting to: ' . mysqli_connect_error());
    }else {

        if (isset($_POST['offset'])) {
            $offset = $_POST['offset'];
        }

        $query = "SELECT email, CONCAT(fname, ' ', lname) AS ridername, mobile, govID, dateadded FROM ridertable WHERE approved = 'false'";

        if (isset($_POST['approved'])) {
            $query = "SELECT email, CONCAT(fname, ' ', lname) AS ridername, mobile, govID, dateadded FROM ridertable WHERE approved = 'true'";
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
            die("An error occurred: " . mysqli_error($con));
        }
    }
    
    mysqli_close($con);
?>