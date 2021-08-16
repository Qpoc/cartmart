<?php

    class Order{

        public function get_pending_order() {
            require_once('../connection.php');
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting to: " . mysqli_connect_error());
            }else {
                $query = "SELECT count(accept) AS pendingorder FROM transactiontable WHERE accept = 'false'";

                if ($result = mysqli_query($con, $query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $rows[] = $row;
                        }

                        return $rows;
                    }
                }
            }

            mysqli_close($con);
        }

        public function get_ongoing_order($email) {
            require_once('../connection.php');
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting to: " . mysqli_connect_error());
            }else {
                $query = "SELECT COUNT(ridertransaction.transactionid) AS ongoingorder, transactionstatus.transactstatus FROM ridertransaction INNER JOIN transactionstatus ON ridertransaction.transactionid = transactionstatus.transactionid WHERE ridertransaction.email = '$email' AND (transactionstatus.transactstatus = 'accepted' OR transactionstatus.transactstatus = 'On the way to mall' OR transactionstatus.transactstatus = 'Gathering' OR transactionstatus.transactstatus = 'On the way to your home')";

                if ($result = mysqli_query($con, $query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $rows[] = $row;
                        }

                        return $rows;
                    }
                }
            }

            mysqli_close($con);
        }

    }



?>