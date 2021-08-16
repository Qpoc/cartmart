<?php



    class Earnings
    {

        public function get_month_earnings($month, $email)
        {
            require_once('../connection.php');
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting: " . mysqli_connect_error());
            } else {

                $email = $_SESSION['rideremail'];

                $month++;

                if ($month == 13) {
                    $month = 1;
                }

                $date_obj   = DateTime::createFromFormat('!m', $month);
                $month_name = $date_obj->format('F');

                $query = "SELECT ridertransaction.transactionid, SUM(transactiontable.delfee) AS income FROM ridertransaction INNER JOIN transactiontable ON ridertransaction.transactionid = transactiontable.transactionid WHERE ridertransaction.email = '$email' AND MONTH(ridertransaction.dateadded) = '$month'";

                if ($result = mysqli_query($con, $query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $rows[] = $row;
                        }

                        return $rows;
                    }
                } else {
                    die("An error occurred: " . mysqli_error($con));
                }
            }

            mysqli_close($con);
        }

        public function get_day_earnings($date, $email)
        {
            require_once('../connection.php');
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting: " . mysqli_connect_error());
            } else {

                $query = "SELECT ridertransaction.transactionid, SUM(transactiontable.delfee) AS income, transactionstatus.transactstatus FROM ridertransaction INNER JOIN transactiontable ON ridertransaction.transactionid = transactiontable.transactionid INNER JOIN transactionstatus ON ridertransaction.transactionid = transactionstatus.transactionid WHERE ridertransaction.email = '$email' AND ridertransaction.dateadded = '$date' AND transactionstatus.transactstatus = 'DELIVERED'";

                if ($result = mysqli_query($con, $query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $rows[] = $row;
                        }

                        return $rows;
                    }
                } else {
                    die("An error occurred: " . mysqli_error($con));
                }
            }

            mysqli_close($con);
        }

        public function get_books_today($date, $email)
        {
            require_once('../connection.php');
            $connection = new Connection();
            $con = $connection->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred while connecting: " . mysqli_connect_error());
            } else {

                $query = "SELECT COUNT(ridertransaction.transactionid) AS totalbooks, transactionstatus.transactstatus FROM ridertransaction INNER JOIN transactiontable ON ridertransaction.transactionid = transactiontable.transactionid INNER JOIN transactionstatus ON ridertransaction.transactionid = transactionstatus.transactionid WHERE ridertransaction.email = '$email' AND ridertransaction.dateadded = '$date' AND transactionstatus.transactstatus = 'DELIVERED'";

                if ($result = mysqli_query($con, $query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $rows[] = $row;
                        }

                        return $rows;
                    }
                } else {
                    die("An error occurred: " . mysqli_error($con));
                }
            }

            mysqli_close($con);
        }
    }

?>