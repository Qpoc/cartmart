<?php

    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occured: " . mysqli_connect_error());
    }else {
        // Valid ID
        $image = $_FILES['validID'];
        $name = $image['name'];
        $tmp = $image['tmp_name'];
        $error = $image['error'];
        $size = $image['size'];

        $extension = explode('.', $name);
        $act_ext = strtolower(end($extension));

        $type_allowed = array('jpg', 'jpeg', 'png');

        if (in_array($act_ext, $type_allowed)) {
            if ($size < 1000000) {
                if ($error === 0) {
                    
              

                    $email = $_POST['email'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $mobile = $_POST['mobile'];
                    $password = hash("sha256", $_POST['password']);
                    $confirm_pass = $_POST['confirmpass'];
                    $isAdmin = $_POST['choose'];

                    if ($isAdmin == 'admin') {
                        $new_file_name = uniqid('', true).".".$act_ext;
                        $new_path = "../images/admin_ID/" . $new_file_name;
                        $db_path = "images/admin_ID/" . $new_file_name;
                    }
                
                    if ($isAdmin == 'admin') {
                        $query = "INSERT INTO admintable (email, fname, lname, mobile, adminpassword, govID, approved) VALUES ('$email', '$fname', '$lname', '$mobile', '$password', '$db_path', 'false')";
                    }else if ($isAdmin == 'rider') {
                        $query = "INSERT INTO ridertable (email, fname, lname, mobile, riderpassword, govID, approved) VALUES ('$email', '$fname', '$lname', '$mobile', '$password', '$db_path', 'false')";
                    }
            
                    if (!mysqli_query($con, $query)) {
                        die("An error occurred: " . mysqli_error($con));
                        echo "<script>window.location = '../admin_reg.php'</script>";
                    }else {
                        move_uploaded_file($tmp, $new_path);
                        header("location:../admin_login.php");
                    }
                }else {
                    echo "<script>alert('An error occurred in uploading the file: Product Image');</script>";
                    echo "<script>window.location = '../admin_reg.php'</script>";
                }
            }else {
                echo "<script>alert('Invalid file size: Product Image');</script>";
                echo "<script>window.location = '../admin_reg.php'</script>";
            }
        }else {
            echo "<script>alert('Invalid file type: Product Image');</script>";
            echo "<script>window.location = '../admin_reg.php'</script>";
        }

    }

    mysqli_close($con);


?>