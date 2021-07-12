<?php

    require_once('get_des_prod.php');
    $productid = $_POST['productid'];
    $branchid = $_POST['branchid'];
    $value = $_POST['value'];
    $offset = $_POST['offset'];

    $product = new get_des_prod($productid, $branchid, $offset);


    if ($value === "RATING & REVIEW") {
        $result = $product->get_reviews();
    }else if ($value === "DESCRIPTION"){
        $result = $product->get_description();
    }

    echo $result;
?>