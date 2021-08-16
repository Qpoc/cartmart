<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred while connecting: " . mysqli_connect_error());
    }else {
        $query = "SELECT DISTINCT itemcategory.productcategory, categoryicon.categoryicon FROM itemcategory LEFT JOIN categoryicon ON itemcategory.productcategory = categoryicon.productcategory ORDER BY itemcategory.productcategory";

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