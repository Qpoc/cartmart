<?php

    session_start();

    $image = $_FILES['myfile'];
    $category = $_POST['category'];
    $img_name = $image['name'];
    $img_type = $image['type'];
    $img_tmp = $image['tmp_name'];
    $img_error = $image['error'];
    $img_size = $image['size'];

    $img_ext = explode('.', $img_name);
    $img_act_ext = strtolower(end($img_ext));

    $type_allowed = array('jpg', 'jpeg', 'png');

    if (in_array($img_act_ext, $type_allowed)) {
        if ($img_error === 0) {
            if ($img_size < 1000000) {

                $img_new_name = uniqid('', true).".".$img_act_ext;
                $img_destination = "../../images/banner/" . $img_new_name;
                $db_path = "images/banner/" . $img_new_name;

                require_once('connection.php');

                $connection = new Connection();
                $con = $connection->get_connection();

                if (mysqli_connect_errno($con)) {
                    die("An error occurred: " . mysqli_connect_error());
                }else {
                    $query = "INSERT INTO categorybackground (categoryimage, productcategory) VALUES ('$db_path', '$category') ON DUPLICATE KEY UPDATE categoryimage = '$db_path'";

                    if (!mysqli_query($con,$query)) {
                        echo "<script>alert('An error occurred in updating the database');</script>";
                        echo "<script>window.location = '../category.php'</script>";
                    }else {
                        move_uploaded_file($img_tmp, $img_destination);
                        echo "<script>window.location = '../category.php'</script>";
                    }
                }

                mysqli_close($con);

            }else {
                echo "<script>alert('File Size Invalid');</script>";
                echo "<script>window.location = '../category.php'</script>";
            }
        }else {
            echo "<script>alert('An error occured in uploading the file');</script>";
            echo "<script>window.location = '../category.php'</script>";
        }
    }else {
        echo "<script>alert('Invalid file type: $img_act_ext');</script>";
        echo "<script>window.location = '../category.php'</script>";
    }
