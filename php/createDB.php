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
                    dateadded DATE NOT NULL,
                    longitude VARCHAR(500) NOT NULL,
                    latitude VARCHAR(500) NOT NULL
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }
                
                //create table
                $query = "CREATE TABLE IF NOT EXISTS customerimg(
                    customerID VARCHAR(9) NOT NULL PRIMARY KEY,
                    customerimg VARCHAR(500) NOT NULL,
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS customerpoints(
                    customerID VARCHAR(9) NOT NULL PRIMARY KEY,
                    customerpoints INT NOT NULL,
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }
                
                //create table
                $query = "CREATE TABLE IF NOT EXISTS branchtable(
                    branchID VARCHAR(9) NOT NULL PRIMARY KEY,
                    branchname VARCHAR(50) NOT NULL,
                    branchaddress VARCHAR(500) NOT NULL,
                    dateadded DATE NOT NULL,
                    longitude VARCHAR(500) NOT NULL,
                    latitude VARCHAR(500) NOT NUll
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
                    productbrand VARCHAR(100) NOT NULL,
                    dateadded DATE NOT NULL,
                    productpoints INT NOT NULL
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
                $query = "CREATE TABLE IF NOT EXISTS custgenderbirth(
                    customerID VARCHAR(9) NOT NULL,
                    gender VARCHAR(10) NOT NULL,
                    birthday VARCHAR(30) NOT NULL,
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID),
                    PRIMARY KEY (customerID)
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

                //create table
                $query = "CREATE TABLE IF NOT EXISTS categoryicon(
                    categoryicon VARCHAR(500) NOT NULL,
                    productcategory VARCHAR(100) NOT NULL,
                    PRIMARY KEY (productcategory),
                    FOREIGN KEY (productcategory) REFERENCES itemcategory(productcategory)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS productreview (
                    transactionID VARCHAR(9) NOT NULL,
                    customerID VARCHAR(9) NOT NULL,
                    productID VARCHAR(9) NOT NULL,
                    branchID VARCHAR(9) NOT NULL,
                    review LONGTEXT NOT NULL,
                    dateadded DATE NOT NULL,
                    PRIMARY KEY (transactionID, productID, branchID, customerID),
                    FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID),
                    FOREIGN KEY (productID) REFERENCES producttable(productID),
                    FOREIGN KEY (branchID) REFERENCES branchtable(branchID),
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS productrating (
                    transactionID VARCHAR(9) NOT NULL,
                    customerID VARCHAR(9) NOT NULL,
                    productID VARCHAR(9) NOT NULL,
                    branchID VARCHAR(9) NOT NULL,
                    rating REAL NOT NULL,
                    dateadded DATE NOT NULL,
                    PRIMARY KEY (transactionID, productID, branchID, customerID),
                    FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID),
                    FOREIGN KEY (productID) REFERENCES producttable(productID),
                    FOREIGN KEY (branchID) REFERENCES branchtable(branchID),
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID)
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
                    dateadded DATE NOT NULL,
                    PRIMARY KEY (email)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS adminimg(
                    email VARCHAR(100) NOT NULL,
                    adminimg VARCHAR(100) NOT NULL,
                    PRIMARY KEY (email),
                    FOREIGN KEY (email) REFERENCES admintable(email)
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
                    dateadded DATE NOT NULL,
                    PRIMARY KEY (email)
                )";
    
                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                //create table
                $query = "CREATE TABLE IF NOT EXISTS riderimg(
                    email VARCHAR(100) NOT NULL,
                    riderimg VARCHAR(500) NOT NULL,
                    PRIMARY KEY (email),
                    FOREIGN KEY (email) REFERENCES ridertable (email)
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
                    modepayment VARCHAR(20) NOT NULL,
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

                $query = "CREATE TABLE IF NOT EXISTS ridermessages(
                    messageID INT NOT NULL AUTO_INCREMENT,
                    transactionID VARCHAR(9) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    customerID VARCHAR(9) NOT NULL,
                    txtmessage VARCHAR(900) NOT NULL,
                    PRIMARY KEY (messageID),
                    FOREIGN KEY (email) REFERENCES ridertable(email),
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID),
                    FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                $query = "CREATE TABLE IF NOT EXISTS customermessages(
                    messageID INT NOT NULL AUTO_INCREMENT,
                    transactionID VARCHAR(9) NOT NULL,
                    customerID VARCHAR(9) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    txtmessage VARCHAR(900) NOT NULL,
                    PRIMARY KEY (messageID),
                    FOREIGN KEY (email) REFERENCES ridertable(email),
                    FOREIGN KEY (customerID) REFERENCES customertable(customerID),
                    FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                $query = "CREATE TABLE IF NOT EXISTS ridertransaction(
                    email VARCHAR(100) NOT NULL,
                    transactionID VARCHAR(9) NOT NULL,
                    dateadded DATE NOT NULL,
                    PRIMARY KEY (email, transactionID),
                    FOREIGN KEY (email) REFERENCES ridertable(email),
                    FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                $query = "CREATE TABLE IF NOT EXISTS transactionstatus(
                    transactionID VARCHAR(9) NOT NULL,
                    transactstatus VARCHAR(100) NOT NULL,
                    PRIMARY KEY (transactionID),
                    FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID)
                )";

                if (!mysqli_query($this->con, $query)) {
                    echo "Error encountered: " . mysqli_error($this->con);
                }

                // // challenges

                // $query = "CREATE TABLE IF NOT EXISTS riderchallenges(
                //     challengeID VARCHAR(9) NOT NULL,
                //     title VARCHAR(100) NOT NULL,
                //     condition VARCHAR() NOT NULL,
                //     PRIMARY KEY (transactionID),
                //     FOREIGN KEY (transactionID) REFERENCES transactiontable(transactionID)
                // )";

                // if (!mysqli_query($this->con, $query)) {
                //     echo "Error encountered: " . mysqli_error($this->con);
                // }

            }else {
                return false;
            }

        }

        public function getProductData($iscategory) {
            if ($iscategory == false) {
                $query = "SELECT * FROM producttable ORDER BY RAND() LIMIT 6";
            }else if ($iscategory == '99'){
                $query = "SELECT * FROM producttable WHERE PRICE <= '$iscategory' ORDER BY RAND() LIMIT 6";
            }else if ($iscategory == "WHAT'S NEW?"){
                $query = "SELECT * FROM producttable WHERE dateadded >= NOW() - INTERVAL 5 DAY ORDER BY RAND() LIMIT 6";
            }else if ($iscategory == "BEVERAGES"){
                $query = "SELECT * FROM producttable WHERE productcategory = '$iscategory' ORDER BY RAND() LIMIT 6";
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
            
            $query = "SELECT producttable.branchID, producttable.productID, producttable.productimg, producttable.productname, producttable.quantity, producttable.price, producttable.productdescription, producttable.productcategory, producttable.producttype, producttable.productbrand, branchtable.longitude, branchtable.latitude FROM producttable INNER JOIN branchtable ON producttable.branchID = branchtable.branchID WHERE producttable.producttype = '$type' AND producttable.productcategory = '$category' LIMIT 12 OFFSET $offset";
           
            //execute query
            $result = mysqli_query($this->con, $query);
          
            if (mysqli_num_rows($result) > 0) {
                return $result;
            }else {
                return "no data";
            }
        }
    }
