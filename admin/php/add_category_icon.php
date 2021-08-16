<?php

    session_start();
    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();


    if (isset($_POST['submit'])) {
        $image =  $_FILES['iconfile'];
        $image_name = $image['name'];
        $image_size = $image['size'];
        $image_error = $image['error'];
        $image_type = $image['type'];
        $image_tmp_name = $image['tmp_name'];

        $image_ext = explode('.', $image_name);
        $image_act_ext = strtolower(end($image_ext));

        $type_allowed = array('jpg', 'jpeg', 'png');

        if (in_array($image_act_ext, $type_allowed)) {

            if ($image_error === 0) {
                if ($image_size < 1000000) {
               
                    $image_name_new = uniqid('', true).".".$image_act_ext;
                    $image_destination = "../../images/category_icon/" . $image_name_new;
                    $db_img_path = "images/category_icon/" . $image_name_new;
                    $category = mysqli_real_escape_string($con,$_POST['getIconCategory']);

                    require_once('connection.php');

                    $connection = new Connection();
                    $con = $connection->get_connection();

                    if (mysqli_connect_errno($con)) {
                        die("An error occurred while connecting to: " . mysqli_connect_error());
                    }else {
                        $query = "INSERT INTO categoryicon (categoryicon, productcategory) VALUES ('$db_img_path', '$category') ON DUPLICATE KEY UPDATE categoryicon = '$db_img_path'";

                        if (!mysqli_query($con, $query)){
                            die("An error occurred while connecting: " . mysqli_error($con));
                        }else {
                            move_uploaded_file($image_tmp_name, $image_destination);
                            echo "<script>window.location = '../category.php'</script>";
                        }

                    }
                }else {
                    echo "<script>alert('File Size Invalid');</script>";
                    echo "<script>window.location = '../category.php'</script>";
                }
            }else {
                echo "<script>alert('An error occured in uploading the file');</script>";
                echo "<script>window.location = '../category.php'</script>";
            }

        }else {
            echo "<script>alert('Invalid file type: Product Image');</script>";
            echo "<script>window.location = '../category.php'</script>";
        }
      
    }


?>