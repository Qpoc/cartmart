<?php

    session_start();
    require_once('orders.php');
    $orders = new Order();

    if (isset($_POST['pending'])) {
        $rows = $orders->get_pending_order();
        $json = json_encode($rows);

        echo $json;
    }else if(isset($_POST['ongoing'])) {
        $email = $_SESSION['rideremail'];
        $rows = $orders->get_ongoing_order($email);
        $json = json_encode($rows);

        echo $json;
    }


?>