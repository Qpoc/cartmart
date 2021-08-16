<?php

    session_start();
    require_once('earnings.php');
    $earnings = new Earnings();
    $email = $_SESSION['rideremail'];


    if(isset($_POST['month'])){
        $rows = $earnings->get_month_earnings($_POST['month'], $email);
        $json = json_encode($rows);
        echo $json;
    }else if(isset($_POST['day'])) {
        $date = date('Y-m-d');
        $rows = $earnings->get_day_earnings($date, $email);
        $json = json_encode($rows);
        echo $json;
    }else if(isset($_POST['book'])){
        $date = date('Y-m-d');
        $rows = $earnings->get_books_today($date, $email);
        $json = json_encode($rows);
        echo $json;
    }

?>