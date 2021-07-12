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
    }
   
?>