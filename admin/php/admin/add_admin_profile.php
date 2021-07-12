<?php

    session_start();
    require_once('../connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    $image = $_FILES['adminImage'];
    print_r($image);

    $img_name = $image['name'];
    $img_type = $image['type'];
    $tmp_str = $image['tmp_name'];
    $img_error = $image['error'];
    $img_size = $image['size'];

    $extension = explode('.', $image['name']);

    $act_ext = strtolower(end($extension));

    $type_allowed = array('jpg', 'jpeg', 'png');

    if (in_array($act_ext, $type_allowed)) {
        if ($img_error === 0) {
            if ($img_size < 1000000) {
                $img_new_name = uniqid('', true) . "." . $act_ext;
                $img_path = "../../images/admin_profile/" . $img_new_name;
                $db_path = "images/admin_profile/" . $img_new_name;

                if (mysqli_connect_errno($con)) {
                    die("An error occurred while connecting: " . mysqli_connect_error());
                }else {
                    $email = $_SESSION['adminemail'];
            
                    $query = "INSERT INTO adminimg (email, adminimg) VALUES ('$email', '$db_path') ON DUPLICATE KEY UPDATE adminimg = '$db_path'";

                    if (!mysqli_query($con, $query)){
                        die("An error occurred: " . mysqli_error($con));
                    }else {
                        move_uploaded_file($tmp_str, $img_path);
                        echo "<script>window.location = '../../edit_profile.php'</script>";
                    }
                    
                }
              
            }else {
                echo "<script>alert('File Size Invalid');</script>";
                echo "<script>window.location = '../../edit_profile.php'</script>";
            }
        }else {
            echo "<script>alert('An error occured in uploading the file');</script>";
            echo "<script>window.location = '../../edit_profile.php'</script>";
        }

    }else {
        echo "<script>alert('Invalid file type: Product Image');</script>";
        echo "<script>window.location = '../../edit_profile.php'</script>";
    }

    mysqli_close($con);

?>