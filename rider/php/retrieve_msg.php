<?php

    session_start();

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
    
        $offset = $_POST['offset'];
        $email = $_SESSION['rideremail'];
        $transactionid = $_POST['transactionid'];
        $customerid = $_POST['customerid'];

        $query = "SELECT txtmessage FROM customermessages WHERE transactionID = '$transactionid' AND customerID = '$customerid' AND email = '$email' LIMIT 1 OFFSET $offset";


        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }

                $json = json_encode($rows);

                echo $json;
            }
        }
        
    }

    mysqli_close($con);

?>