<?php

    session_start();
    require_once('product_sales.php');
    $product = new Product();

    if ($_POST['product'] == 'withsales') {
        $result = $product->get_prod_sale($_POST['offset']);
        $json = json_encode($result);
        echo $json;
    }else if ($_POST['product'] == 'nonsales') {
        $result = $product->get_prod_nonsale($_POST['offset']);
        $json = json_encode($result);
        echo $json;
    }
    

?>