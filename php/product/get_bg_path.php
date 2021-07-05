<?php

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {
        
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }

        $query = "SELECT categoryimage FROM categorybackground WHERE productcategory = '$category'";

        if ($result = mysqli_query($con,$query)) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                echo $row['categoryimage'];
            }
        }else {
            echo 'error';
        }
        
    }


?>