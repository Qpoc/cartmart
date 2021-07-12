<?php
class get_product{

    public function getHTMLProdString($productid, $branchid, $title, $price, $productimage) {
        require_once('../connection.php');
    
        $connection = new Connection();
        $con = $connection->get_connection();

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

        $star = $this->ratingToStar($productid, $branchid);


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
            $star
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

        return $element;

    }

    public function getRating($productid, $branchid){
        require_once("../connection.php");
        $connection = new Connection();
        $con = $connection->get_connection();

        if (mysqli_connect_errno($con)) {
            die("An error occured while connecting: " . mysqli_connect_error());
        }else {
            $query = "SELECT COUNT(productID) AS ratingcount, AVG(rating) AS ratings FROM productrating WHERE productID = '$productid' AND branchID = '$branchid';";

            if ($result = mysqli_query($con, $query)) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    return $row;
                }
            }
        }
    }

    public function ratingToStar($productid, $branchid){
        $rating = $this->getRating($productid, $branchid);

        if ($rating['ratings'] == 5) {
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 5 && $rating['ratings'] >= 4.5){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star-half-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 4.5 && $rating['ratings'] >= 4){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 4 && $rating['ratings'] >= 3.5){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star-half-o'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 3.5 && $rating['ratings'] >= 3){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 3 && $rating['ratings'] >= 2.5){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star-half-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 2.5 && $rating['ratings'] >= 2){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 2 && $rating['ratings'] >= 1.5){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star-half-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 1.5 && $rating['ratings'] >= 1){
            $star = "<i class='fa fa-star'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else if ($rating['ratings'] < 1 && $rating['ratings'] >= 0.5){
            $star = "<i class='fa fa-star-half-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i> 
            <sup>($rating[ratingcount])</sup>";
        }else {
            $star = "<i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>
            <i class='fa fa-star-o'></i>";
        }

        return $star;

    }
}
?>