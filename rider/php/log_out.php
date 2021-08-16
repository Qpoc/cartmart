<?php

    session_start();

    if (isset($_SESSION['rideremail'])) {
        session_destroy();
        header("location:../../admin/admin_login.php");
    }

?>