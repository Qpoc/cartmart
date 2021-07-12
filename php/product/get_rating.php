<?php

    require_once('get_prod.php');

    $productid = $_POST['productid'];
    $branchid = $_POST['branchid'];

    $rating = new get_product();
    $result = $rating->ratingToStar($productid, $branchid);

    echo $result;


?>