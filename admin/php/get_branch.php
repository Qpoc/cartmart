<?php

    $con = mysqli_connect('localhost','root','','marketdb');

    if (mysqli_connect_errno($con)) {
        die('An error occured: ' . mysqli_connect_error());
    }else {

        $query = "SELECT branchID, branchname FROM branchtable";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    $arr[] = $rows;
                }
                
                echo json_encode($arr);

                mysqli_close($con);
            }else {
                echo 'error';
            }
        }
        
    }


?>