<?php
    session_start();

    require_once("../createDB.php");
    require_once("get_prod.php");

  

    if (isset($_SESSION['type']) && isset($_SESSION['category'])) {
        $database = new CreateDB();
        $product = new get_product();
        
        $result = $database->getProdByTypeNCategory($_SESSION['type'], $_SESSION['category'], $_POST['offset']);
        $returnString = "";

        if (isset($result) && $result != 'no data') {
            while ($row = mysqli_fetch_assoc($result)) {
                $returnString = $returnString . $product->getHTMLProdString($row['productID'], $row['branchID'], $row['productname'], $row['price'], $row['productimg']);
            }

            echo $returnString;
        }
    }else if (isset($_SESSION['productid']) && isset($_SESSION['branchid']) && isset($_SESSION['productname']) && isset($_SESSION['price']) && isset($_SESSION['image'])){
        $database = new CreateDB();
        $product = new get_product();

        $returnString = $product->getHTMLProdString($_SESSION['productid'], $_SESSION['branchid'], $_SESSION['productname'], $_SESSION['price'], $_SESSION['image']);
        
        echo $returnString;

    }

    if (isset($_SESSION['productid']) && isset($_SESSION['branchid']) && isset($_SESSION['productname']) && isset($_SESSION['price']) && isset($_SESSION['image'])) {
        unset($_SESSION['productid']);
        unset($_SESSION['branchid']);
        unset($_SESSION['productname']);
        unset($_SESSION['price']);
        unset($_SESSION['image']);
    }

?>