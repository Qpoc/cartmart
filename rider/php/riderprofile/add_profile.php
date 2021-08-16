<?php

    session_start();
    require_once('../connection.php');

    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];

        $img_name = $image['name'];
        $img_tmp = $image['tmp_name'];
        $img_error = $image['error'];
        $img_size = $image['size'];

        $img_ext = explode('.', $img_name);
        $img_act_ext = strtolower(end($img_ext));

        $type_allowed = array('jpg', 'jpeg', 'png');

        if (in_array($img_act_ext, $type_allowed)) {
            if ($img_size < 1000000) {
                if ($img_error == 0) {

                    $img_new_name = uniqid('',true) . "." . $img_act_ext;
                    $img_new_path = "../../images/rider_profile/" . $img_new_name;
                    $img_db_path = "images/rider_profile/" . $img_new_name;

                    $connection = new Connection();
                    $con = $connection->get_connection();

                    $email = $_SESSION['rideremail'];

                    if (mysqli_connect_errno($con)) {
                        die("An error occurred: " . mysqli_connect_error());
                    }else {
                        $query = "INSERT INTO riderimg (email, riderimg) VALUES ('$email', '$img_db_path') ON DUPLICATE KEY UPDATE riderimg = '$img_db_path'";

                        if (!mysqli_query($con, $query)) {
                            die("An error occurred: " . mysqli_error($con));
                        }else {
                            move_uploaded_file($img_tmp, $img_new_path);
                            echo "<script>window.location = '../../rider_details.php';</script>";
                        }
                    }

                }else {
                    echo "<script>alert('An error occurred: Product Image');</script>";
                    echo "<script>window.location = '../../rider_details.php';</script>";
                }
            }else {
                echo "<script>alert('Invalid file size: exceeds 1mb');</script>";
                echo "<script>window.location = '../../rider_details.php';</script>";
            }
        }else {
            echo "<script>alert('Invalid file type: Product Image');</script>";
            echo "<script>window.location = '../../rider_details.php';</script>";
        }
    }else {
        header("location:../../rider_details.php");
    }
  
    mysqli_close($con);


?>