<?php

    require_once('../connection.php');

    class get_des_prod {

        public $productid;
        public $branchid;
        public $offset;

        public function __construct($productid, $branchid, $offset){
            $this->productid = $productid;
            $this->branchid = $branchid;
            $this->offset = $offset;
        }

        public function get_reviews(){
            
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting" . mysqli_connect_error());
            }else {
                $query = "SELECT productrating.rating, productrating.customerid, productrating.dateadded, productreview.review, customertable.customerfname FROM productrating LEFT JOIN productreview ON productrating.transactionID = productreview.transactionID INNER JOIN customertable ON productrating.customerid = customertable.customerid WHERE productrating.productid = '$this->productid' AND productrating.branchid = '$this->branchid' ORDER BY productrating.dateadded DESC LIMIT 5 OFFSET $this->offset";
                
                if ($result = mysqli_query($con, $query)){
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                            $rows[] = $row;
                        }

                        $json = json_encode($rows);
                        return $json;
                    }
                }else {
                    die('An error occurred: ' . mysqli_error($con));
                }
            }

            mysqli_close($con);
        }

        public function get_description() {
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting" . mysqli_connect_error());
            }else {
                $query = "SELECT productdescription FROM producttable WHERE productid = '$this->productid' AND branchid = '$this->branchid'";
                
                if ($result = mysqli_query($con, $query)){
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                            $rows[] = $row;
                        }

                        $json = json_encode($rows);
                        return $json;
                    }
                }else {
                    die('An error occurred: ' . mysqli_error($con));
                }
            }

            mysqli_close($con);
        }

    }




?>