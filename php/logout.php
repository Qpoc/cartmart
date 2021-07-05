<?php
    session_start();
    
    echo $_SESSION['sessionusername'];
    if (isset($_SESSION['sessionusername']) && isset($_SESSION['sessionpassword'])) {
        session_destroy();
        header("location:../index.php");
    }else {
        header("location:../index.php");
    }
    
?>