<?php

    class Product {


        public function get_prod_sale($offset) {
            require_once('../connection.php');
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting to: " . mysqli_connect_error());
            }else {

                $query = "SELECT ordertable.productID, ordertable.branchID, branchtable.branchname, producttable.productname, producttable.productimg, COUNT(*) AS totalsales FROM transactionstatus INNER JOIN ordertable ON transactionstatus.transactionID = ordertable.transactionID INNER JOIN producttable ON ordertable.productID = producttable.productID AND ordertable.branchID = producttable.branchID INNER JOIN branchtable ON ordertable.branchID = branchtable.branchID WHERE transactionstatus.transactstatus = 'Delivered' GROUP BY ordertable.productID, ordertable.branchID LIMIT 5 OFFSET $offset";

                if ($result = mysqli_query($con, $query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                            $rows[] = $row;
                        }
                    }

                    return $rows;
                }
                
            }

            mysqli_close($con);
        }

        public function get_prod_nonsale($offset) {
            require_once('../connection.php');
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting to: " . mysqli_connect_error());
            }else {

                $query = "SELECT producttable.productID, producttable.branchID, producttable.productname, producttable.productimg, branchtable.branchname FROM producttable INNER JOIN branchtable ON producttable.branchID = branchtable.branchID WHERE producttable.productID NOT IN (SELECT ordertable.productID FROM ordertable) AND producttable.branchID NOT IN (SELECT ordertable.productID FROM ordertable) LIMIT 5 OFFSET $offset";

                if ($result = mysqli_query($con, $query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                            $rows[] = $row;
                        }
                    }

                    return $rows;
                }
                
            }

            mysqli_close($con);
        }




    }


?>