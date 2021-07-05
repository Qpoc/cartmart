<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error($con));
    }else {
        $email = $_POST['email'];
        
        $password = hash('sha256', $_POST['password']);

        $query = "SELECT email, CONCAT(fname, ' ', lname) as adminname, mobile, adminpassword, govID FROM admintable WHERE email = '$email' AND adminpassword = '$password' AND approved = 'true'";

        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) == 1) {
                echo "<script>alert('hello');</script>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION['adminname'] = $row['adminname'];
                    header("location:../admin_home.php");
                }
            }else {
                echo "<script>alert('Unauthorized access! or your account is subject for approval');</script>";
                echo "<script>window.location = '../admin_login.php';</script>";
            }
        }else {
            header("location:../admin_login.php");
        }
    }


?>