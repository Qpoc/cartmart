<?php

    function navigation() {

       require_once('connection.php');
       $connection = new Connection();
       $con = $connection->get_connection();
       
       if (mysqli_connect_errno($con)) {
           die("An error occurred while connecting: " . mysqli_connect_error());
       }else {
           $query = "SELECT CONCAT(ridertable.fname, ' ', ridertable.lname) AS ridername, riderimg.riderimg FROM ridertable INNER JOIN riderimg ON ridertable.email = riderimg.email WHERE ridertable.email = '$_SESSION[rideremail]'";

           $name = "";
           $img = "";

           if ($result = mysqli_query($con, $query)) {
               if (mysqli_num_rows($result) > 0) {
                   while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['ridername'];
                        $img = $row['riderimg'];
                   }
               }
           }
       }

       if ($img == null || $img == "") {
           $img = "images/rider_profile/default.png";
       }
        

       echo "<input type='checkbox' id='navigation'>
       <div class='navigation'>
           <div class='profile'>
               <div class='img'>
                   <img src='$img' alt=' width='64' height='64'>
               </div>
               <p>Hello, $name</p>
               <a href='rider_details.php'><input type='button' value='VIEW DETAILS'></a>
           </div>
           <div class='nav'>
               <nav>
                   <li><img src='images/icon/home.png' alt=' width='32' height='32'><a href='rider_home.php'>HOME</a></li>
                   <li><img src='images/icon/pending.png' alt=' width='32' height='32'><a href='rider_order_list.php'>PENDING ORDERS</a></li>
                   <li><img src='images/icon/ongoing.png' alt=' width='32' height='32'><a href='accepted_cust.php'>ONGOING ORDERS</a></li>
                   <li><img src='images/icon/history.png' alt=' width='32' height='32'><a href='history.php'>HISTORY</a></li>
                   <li><img src='images/icon/riderlogout.png' alt=' width='32' height='32'><a href='php/log_out.php'>LOG OUT</a></li>
               </nav>
           </div>
       </div>";
    }

?>

