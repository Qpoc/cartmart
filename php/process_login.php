<?php
      session_start();

      require_once('createDB.php');
      require_once('connection.php');

      $database = new CreateDB();

      $username = $_REQUEST['username'];
      $password = hash('sha256', $_REQUEST['password']);
  
     //connection
      $database = new CreateDB();
      $connection = new Connection();
      $con = $connection->get_connection();

     //check
     if (mysqli_connect_errno($con)) {
         echo "Error encounter: " . mysqli_connect_error();
     }

     $query = "SELECT CONCAT(customerfname, ' ' , customerlname) as customername, customerregistration.customerID, customerusername, customerpassword, customertable.emailaddress FROM customerregistration 
     INNER JOIN customertable ON customerregistration.customerID = customertable.customerID
     WHERE customerusername = '$username' AND customerpassword = '$password'";

     $result = mysqli_query($con, $query);
     $row = mysqli_fetch_assoc($result);
  
     if($username == $row['customerusername'] && $password == $row['customerpassword']){
        $_SESSION['sessioncustomerid'] = $row['customerID'];
        $_SESSION['sessionusername'] = $username;
        $_SESSION['sessionpassword'] = $password;
        $_SESSION['sessioncustomername'] = $row['customername'];
        $_SESSION['sessioncustomeremail'] = $row['emailaddress'];
        header("location:../index.php");
     }else {
        echo "<script>alert('Invalid Username and Password')</script>";
        echo "<script>window.location.href='../login.php'</script>";
     }

?>