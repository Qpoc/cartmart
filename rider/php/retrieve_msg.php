<?php

    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
    
        $offset = $_POST['offset'];

        $query = "SELECT txtmessage FROM messages WHERE fromuser = '000000001' AND touser = '000000000' LIMIT 1 OFFSET $offset";


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