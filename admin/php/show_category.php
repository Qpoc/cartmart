<?php

    session_start();

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error());
    }else {

        if (!isset($_POST['productType']) && !isset($_POST['offset'])) {
            $query = "SELECT DISTINCT productcategory FROM itemcategory";
        }else if(isset($_POST['offset'])) {
            $offset = $_POST['offset'];
            $query = "SELECT * FROM itemcategory ORDER BY productcategory,producttype LIMIT 15 OFFSET $offset";
        }else if (isset($_POST['productType'])) {
            $category = mysqli_real_escape_string($con, $_POST['category']);
            $query = "SELECT producttype FROM itemcategory WHERE productcategory = '$category'";
        }
        
        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
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

?>