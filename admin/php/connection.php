<?php

    class Connection {

        public $host;
        public $username;
        public $password;
        public $dbname;

        public function __construct($host = "localhost", $username = "root", $password = "", $dbname = "marketdb"){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
        }

        public function get_connection(){
            $con = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
            return $con;
        }

        public function count_acc_order(){
            $con = $this->get_connection();

            if (mysqli_connect_errno($con)) {
                die("An error occurred: " . mysqli_connect_error());
            }else {
                $email = mysqli_real_escape_string($con, $_SESSION['rideremail']);
                $query = "SELECT COUNT(*) AS total FROM ridertransaction WHERE email = '$email'";

                $result = mysqli_query($con, $query);

                $row = mysqli_fetch_assoc($result);

                return $row['total'];
            }
        }

    }
    

?>