<?php

function component($productimage, $title, $price, $productid, $branchid)
{

    $wishlist = isWishlist($productid, $branchid);

    product($productimage, $title, $price, $productid, $branchid, $wishlist);

}

function product($productimage, $title, $price, $productid, $branchid, $wishlist)
{
    $element = "<div class='product'>
    <div class='wrapper'>
        <div class='product-image'>
            <img src='$productimage' alt=' width='200'>
        </div>
    </div>
    <div class='wrapper-title'>
    <div class='product-title'>
        <p>$title</p>
    </div>
    </div>
    <div class='rating'>
          <i class='fa fa-star'></i>
          <i class='fa fa-star'></i>
          <i class='fa fa-star'></i>
          <i class='fa fa-star'></i>
          <i class='fa fa-star-o'></i>
    </div>
    <div class='price'>
        <p>&#8369; $price</p>
    </div>
  
    <img class='viewDescription' src='images/Icon/eye.png' width='32' height='32' onclick=\"showDescription('$productid', '$branchid')\">
    " . $wishlist . "<input type='submit' class='btnBuy' value='Buy Now' name='btnBuy' onclick=\"buyNow('$productid', '$branchid')\"/>
    <input type='submit' class='btnAdd' value='Add to Cart' name='btnAdd' onclick=\"addToCart('$productid', '$branchid')\">
    <input type='hidden' name='productid' value='$productid'>
    </div>
    ";

    echo $element;
    return $element;

}

function isWishlist($productid, $branchid) {

    $con = mysqli_connect('localhost', 'root', '', 'marketdb');

    if (isset($_SESSION['sessioncustomerid'])) {
        $customerid = $_SESSION['sessioncustomerid'];

        if (mysqli_connect_errno($con)) {
            die('An error occured: ' . mysqli_connect_error());
        }else {
            $query = "SELECT * FROM wishlist WHERE customerID = '$customerid' AND productID = '$productid'";

            $result = mysqli_query($con, $query);

            $wishlist = "";

            if (mysqli_num_rows($result) > 0) {
                $wishlist = "<img id='$productid' class='wishlist' src='images/Icon/heart.png' width='32' height='32' onclick=\" addToWishlist('$productid', 0, false, '$branchid')\" style='filter: invert(36%) sepia(98%) saturate(3866%) hue-rotate(334deg) brightness(109%) contrast(101%);'/>";
            }else {
                $wishlist = "<img id='$productid' class='wishlist' src='images/Icon/heart.png' width='32' height='32' onclick=\"addToWishlist('$productid', 0, false, '$branchid')\"/>";
            }
        }
    }else {
        $wishlist = "<img id='$productid' class='wishlist' src='images/Icon/heart.png' width='32' height='32' onclick=\"addToWishlist('$productid', 0, false)\"/>";
    }

    return $wishlist;
}


?>