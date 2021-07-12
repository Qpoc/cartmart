<?php
    session_start();

    require_once('connection.php');
    $connection = new Connection();
    $con = $connection->get_connection();

    if (mysqli_connect_errno($con)) {
        die("An error occurred: " . mysqli_connect_error($con));
    }else {
        $email = $_POST['email'];
        $choose = $_POST['choose'];

        $password = hash('sha256', $_POST['password']);

        if ($choose == 'admin') {
            $query = "SELECT email, CONCAT(fname, ' ', lname) as adminname, mobile, adminpassword, govID FROM admintable WHERE email = '$email' AND adminpassword = '$password' AND approved = 'true'";
        }elseif ($choose == 'rider') {
            $query = "SELECT email, CONCAT(fname, ' ', lname) as ridername, mobile, riderpassword, govID FROM ridertable WHERE email = '$email' AND riderpassword = '$password' AND approved = 'true'";
        }
        
        if ($result = mysqli_query($con, $query)) {
            if (mysqli_num_rows($result) == 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($choose == 'admin') {
                        $_SESSION['adminname'] = $row['adminname'];
                        $_SESSION['adminemail'] = $row['email'];
                        header("location:../admin_home.php");
                    }else if ($choose == 'rider') {
                        $_SESSION['ridername'] = $row['ridername'];
                        $_SESSION['rideremail'] = $row['email'];
                        header("location:../../rider/rider_home.php");
                    }
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