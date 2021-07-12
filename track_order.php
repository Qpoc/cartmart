<?php
    session_start();

    require_once('php/navigation.php'); 

    if (isset($_SESSION['buynow'])) {
        unset($_SESSION['buynow']);
        unset($_SESSION['branchid']);
    }

    if (isset($_SESSION['category'])) {
        unset($_SESSION['category']);
    }

    if (isset($_SESSION['descriptionquantity'])) {
        unset($_SESSION['descriptionquantity']);
    }

    if (isset($_POST['transactionid']) && isset($_POST['email'])) {
        $_SESSION['transactionid'] = $_POST['transactionid'];
        $_SESSION['myrideremail'] = $_POST['email'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/track_order.css">
    <title>CartMart - My Account</title>
    <script src="script/userSettings.js"></script>
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
    <script src="script/map.js"></script>
</head>
<?php
    if (isset($_SESSION['sessioncustomerid'])) {
        echo "<body onload =\"onLoadCart()\">";
    }else {
        echo "<body>";
    }
?>
    <header id="header">
        <?php
            require_once('php/header.php');
        ?>
    </header>
    <main id="main">
        <div class="status-container">
            <div class="wrapper" id="updateContainer">
                <div class="mycontainer">
                    <img id="imgStatus" src="images/Icon/searching.gif" alt="">
                </div>
                <div class="trackText">
                    <h3 id="status">Looking for available driver</h3>
                </div>
                <div class="chat">
                    <img id="chatRider" src="images/Icon/message.png" alt="Chat your rider" onclick="showChatBox()" width="32" height="32">
                </div>
            </div>
        </div>
    </main>
    <footer id="footer">
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
    <div class="wrapper-chat" id="chatBox">
        <div class="back">
            <img src="images/Icon/back.png" alt="" onclick="hideChatBox()" width="32" height="32">
        </div>
        <div class="container" id="message-container">
            <div class="customer">
                <p>Welcome to CartMart! Feel Free to contact our driver if you have any concerns</p>
            </div>
        </div>
        <div class="textfield" id="textfieldContainer">
            <textarea name="" id="message"></textarea>
            <img id="sendIcon" src="images/Icon/send.png" alt=''>
        </div>
    </div>

<?php
   echo "<script>
        var count = 0;
        var updateStatus = setInterval(function() {
            var xhr = new XMLHttpRequest();
            var param = 'transactionid=' + '$_SESSION[transactionid]';
            xhr.open('POST','php/product/update_status.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                 
                    if(this.responseText != '' && this.responseText != null){
                        var data = JSON.parse(this.responseText);
                        var status = data[0].transactstatus;
                        
                        var sendIcon = document.getElementById('sendIcon');
                        sendIcon.onclick = function(){
                            sendMessage(data[0].transactionID, data[0].email);
                        }
                     
                        if(status == 'accepted'){
                            if(document.getElementById('imgStatus').src != 'images/Icon/wait.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/wait.gif';
                            }
                            document.getElementById('chatRider').style.display = 'block';
                            document.getElementById('status').innerHTML = 'We found you a driver, please wait for a moment.';
                        }else if (status == 'On the way to mall'){
                            if(document.getElementById('imgStatus').src != 'images/Icon/delivery.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/delivery.gif';
                            }
                            document.getElementById('chatRider').style.display = 'block';  
                            document.getElementById('status').innerHTML = 'Your driver is on the way to the Mall';
                        }else if (status == 'Gathering') {
                            if(document.getElementById('imgStatus').src != 'images/Icon/shopping.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/shopping.gif';
                            }
                            document.getElementById('chatRider').style.display = 'block';
                            document.getElementById('status').innerHTML = 'Gathering your order';
                        }else if (status == 'On the way to your home') {          
                            if(document.getElementById('imgStatus').src != 'images/Icon/housedeliver.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/housedeliver.gif';
                            }
                            document.getElementById('chatRider').style.display = 'block';
             
                            document.getElementById('status').innerHTML = 'On the way to your home';               
                        }else if (status == 'Delivered') {
                            if(document.getElementById('imgStatus').src != 'images/Icon/delivered.gif'){
                                document.getElementById('imgStatus').src = 'images/Icon/delivered.gif';
                            }
                            document.getElementById('chatRider').style.display = 'none';
                            document.getElementById('status').innerHTML = 'Your ordered has been delivered. Enjoy :)';
                        }
                    }
                }
            }

            xhr.send(param);

        }, 3000);
        
        var offset = 0;
        var container = document.getElementById('message-container');
        var id = setInterval(function () {
            retrieveMessage();
        }, 2000)

        function retrieveMessage(){";
            if(isset($_SESSION['transactionid'])){
               echo "var xhr = new XMLHttpRequest();
                var param = 'offset=' + offset + '&transactionid=' + '$_SESSION[transactionid]';
                xhr.open('POST', 'php/retrieve_msg.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        if (this.responseText != '' && this.responseText != null) {
                            var data = JSON.parse(this.responseText);
                            var output = \"<div class='customer'>\" +
                                \"<p>\" + data[0].txtmessage + \"</p>\" +
                            \"</div>\";

                            offset += 1;

                            container.scrollTop = container.scrollHeight;

                            document.getElementById('message-container').innerHTML += output;
                        }
                    }
                }

                xhr.send(param);";
            }
        echo "}
    </script>";
?>
<?php
    get_navigation();
?>
</body>
</html>