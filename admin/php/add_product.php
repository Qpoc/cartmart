<?php

    session_start();

    if (isset($_POST['submit'])) {
        $image =  $_FILES['myfile'];
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
                    $image_destination = "../../images/products/" . $image_name_new;
                    $db_img_path = "images/products/" . $image_name_new;

                    move_uploaded_file($image_tmp_name, $image_destination);

                    require_once('connection.php');

                    $connection = new Connection();
                    $con = $connection->get_connection();

                    $combiStr = "abcdefghijklmnopqrstuvwxyz0123456789";
                    $productID = substr(uniqid(str_shuffle($combiStr)), 3 , 9);
                    $name = mysqli_real_escape_string($con, $_POST['name']);
                    $branchid = $_POST['branch'];
                    $quantity = $_POST['quantity'];
                    $price = $_POST['price'];
                    $description = mysqli_real_escape_string($con, $_POST['description']);
                    $category = $_POST['category'];
                    $type = $_POST['type'];
                    $brand = $_POST['brand'];
                    $points = $_POST['points'];
                    $date = date('Y-m-d');


                    if (mysqli_connect_errno($con)) {
                        die("An error occured: " . mysqli_connect_error());
                    }else {
                        $query = "INSERT INTO producttable (branchID, productID, productimg, productname, quantity, price, productdescription, productcategory, producttype, productbrand, dateadded, productpoints) VALUES ('$branchid', '$productID', '$db_img_path', '$name', $quantity, $price, '$description' , '$category', '$type', '$brand', '$date', $points)";

                        if (mysqli_query($con, $query)) {
                            header('location:../product_list.php');
                        }else {
                            echo "<script>alert('An error occured in inserting the data!');</script>";
                            echo "<script>window.location = '../product_list.php'</script>";
                        }
                    }
                  
                }else {
                    echo "<script>alert('File Size Invalid');</script>";
                    echo "<script>window.location = '../product_list.php'</script>";
                }
            }else {
                echo "<script>alert('An error occured in uploading the file');</script>";
                echo "<script>window.location = '../product_list.php'</script>";
            }

        }else {
            echo "<script>alert('Invalid file type: Product Image');</script>";
            echo "<script>window.location = '../product_list.php'</script>";
        }


      
    }
    
?>