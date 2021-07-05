<?php 

    class CreateDB {
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $tablename;
        public $con;

        // class constructor
        public function __construct($dbname = "marketdb", $servername = "localhost", $username = "root", $password = "")
        {
            $this->dbname = $dbname;
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;

            //connection establish
            $this->con = mysqli_connect($servername, $username, $password);

            //check connection
            if (!$this->con) {
                die("Connection error: " . mysqli_connect_error());
            }

            // Customer
            //query
            $query = "CREATE DATABASE IF NOT EXISTS $dbname";

            //execute
            if (mysqli_query($this->con, $query)) {

                //connection establish
                $this->con = mysqli_connect($servername, $username, $password, $dbname);
                
                //create table
                $query = "CREATE TABLE IF NOT EXISTS customertable(
                    customerID VARCHAR(9) NOT NULL PRIMARY KEY,
                    customerlname VARCHAR(50) NOT NULL,
                    customerfname VARCHAR(50),
                    customeraddress MEDIUMTEXT,
                    mobilenumber VARCHAR(11),
                    emailaddress VARCHAR(50),
                    dateadded DATE NOT NULL
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS branchtable(
                    branchID VARCHAR(9) NOT NULL PRIMARY KEY,
                    branchname VARCHAR(50) NOT NULL,
                    branchaddress VARCHAR(30) NOT NULL,
                    dateadded DATE NOT NULL
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS producttable(
                    branchID VARCHAR(9) NOT NULL,
                    productID VARCHAR(9) NOT NULL,
                    FOREIGN KEY (branchID) REFERENCES branchtable(branchID),
                    PRIMARY KEY (productID,branchID),
                    productimg VARCHAR(500) NOT NULL,
                    productname VARCHAR(50) NOT NULL,
                    quantity INT(8) NOT NULL,
                    price REAL NOT NULL,
                    productdescription LONGTEXT NOT NULL,
                    productcategory VARCHAR(100) NOT NULL,
                    producttype VARCHAR(100) NOT NULL,
                    productbrand VARCHAR(100) NOT NULL
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                 //create table
                 $query = "CREATE TABLE IF NOT EXISTS carttable(
                    branchID VARCHAR(9) NOT NULL,
                    productID VARCHAR(9) NOT NULL,
                    customerID VARCHAR(9) NOT NULL,
                    quantity INT NOT NULL,
                    inccheckout VARCHAR(10) NOT NULL,
                    PRIMARY KEY (branchID, productID, customerID),
                    FOREIGN KEY (branchID) REFERENCES branchtable(branchID),
                    FOREIGN KEY (productID) REFERENCES producttable(productID),
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS customerregistration(
                    customerID VARCHAR(9) NOT NULL,
                    customerusername VARCHAR(15) NOT NULL,
                    customerpassword VARCHAR(100) NOT NULL,
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID),
                    PRIMARY KEY (customerusername)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS wishlist(
                    customerID VARCHAR(9) NOT NULL,
                    productID VARCHAR(9) NOT NULL,
                    branchID VARCHAR(9) NOT NULL,
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID),
                    FOREIGN KEY (productID) REFERENCES producttable(productID),
                    FOREIGN KEY (branchID) REFERENCES producttable(branchID),
                    PRIMARY KEY (customerID, productID, branchID)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS itemcategory(
                    productcategory VARCHAR(100) NOT NULL,
                    producttype VARCHAR(100) NOT NULL,
                    categoryimage VARCHAR(500) NOT NULL,
                    dateadded DATE NOT NULL,
                    PRIMARY KEY (productcategory, producttype)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS categorybackground(
                    categoryimage VARCHAR(500) NOT NULL,
                    productcategory VARCHAR(100) NOT NULL,
                    PRIMARY KEY (productcategory),
                    FOREIGN KEY (productcategory) REFERENCES itemcategory(productcategory)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                // admin

                //create table
                $query = "CREATE TABLE IF NOT EXISTS admintable(
                    email VARCHAR(100) NOT NULL,
                    fname VARCHAR(100) NOT NULL,
                    lname VARCHAR(100) NOT NULL,
                    mobile VARCHAR(20) NOT NULL,
                    adminpassword VARCHAR(100),
                    govID VARCHAR(500),
                    approved VARCHAR(10),
                    PRIMARY KEY (email)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                // Rider

                //create table
                $query = "CREATE TABLE IF NOT EXISTS ridertable(
                    email VARCHAR(100) NOT NULL,
                    fname VARCHAR(100) NOT NULL,
                    lname VARCHAR(100) NOT NULL,
                    mobile VARCHAR(20) NOT NULL,
                    riderpassword VARCHAR(100),
                    govID VARCHAR(500),
                    approved VARCHAR(10),
                    PRIMARY KEY (email)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                // Transaction
                
                $query = "CREATE TABLE IF NOT EXISTS transactiontable(
                    transactionID VARCHAR(9) NOT NULL,
                    customerID VARCHAR(9) NOT NULL,
                    subtotal REAL NOT NULL,
                    delfee REAL NOT NULL,
                    totalprice REAL NOT NULL,
                    dateadded DATE NOT NULL,
                    accept VARCHAR(10) NOT NULL,
                    PRIMARY KEY (transactionID),
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                $query = "CREATE TABLE IF NOT EXISTS ordertable(
                    transactionID VARCHAR(9) NOT NULL,
                    branchID VARCHAR(9) NOT NULL,
                    productID VARCHAR(9) NOT NULL,
                    quantity INT NOT NULL,
                    itemprice REAL NOT NULL,
                    PRIMARY KEY (transactionID, branchID, productID),
                    FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID),
                    FOREIGN KEY (branchID) REFERENCES branchtable(branchID),
                    FOREIGN KEY (productID) REFERENCES producttable(productID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                $query = "CREATE TABLE IF NOT EXISTS messages(
                    messageID INT NOT NULL AUTO_INCREMENT,
                    fromuser VARCHAR(9) NOT NULL,
                    touser VARCHAR(9) NOT NULL,
                    txtmessage VARCHAR(900) NOT NULL,
                    PRIMARY KEY (messageID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

            }else {
                return false;
            }

        }

        public function getProductData($iscategory) {
            if ($iscategory == false) {
                $query = "SELECT * FROM producttable ORDER BY RAND() LIMIT 5";
            }else {
                $query = "SELECT * FROM producttable ORDER BY RAND() LIMIT 6";
            }
           
            //execute query
            $result = mysqli_query($this->con, $query);
          
            if (mysqli_num_rows($result) > 0) {
                return $result;
            }   
            
        }

        public function getDisProdType($category) {

            $query = "SELECT DISTINCT producttable.producttype FROM producttable WHERE producttable.productcategory = '$category'";
           
            //execute query
            $result = mysqli_query($this->con, $query);
          
            if (mysqli_num_rows($result) > 0) {
                return $result;
            }else {
                return "no data";
            }   
        }

        public function getProductByType($type) {
            
            $query = "SELECT producttable.branchID, producttable.productID, producttable.productimg, producttable.productname, producttable.quantity, producttable.price, producttable.productdescription, producttable.productcategory, producttable.producttype, producttable.productbrand FROM producttable WHERE producttable.producttype = '$type' ORDER BY producttable.producttype, RAND() LIMIT 6";
           
            //execute query
            $result = mysqli_query($this->con, $query);
          
            if (mysqli_num_rows($result) > 0) {
                return $result;
            }else {
                return "no data";
            }
        }

        public function getProdByTypeNCategory($type, $category, $offset) {
            
            $query = "SELECT producttable.branchID, producttable.productID, producttable.productimg, producttable.productname, producttable.quantity, producttable.price, producttable.productdescription, producttable.productcategory, producttable.producttype, producttable.productbrand FROM producttable WHERE producttable.producttype = '$type' AND producttable.productcategory = '$category' LIMIT 12 OFFSET $offset";
           
            //execute query
            $result = mysqli_query($this->con, $query);
          
            if (mysqli_num_rows($result) > 0) {
                return $result;
            }else {
                return "no data";
            }
        }
    }
