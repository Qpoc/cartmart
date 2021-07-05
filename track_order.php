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
    <script src="script/utilities.js"></script>
    <script src="script/product.js"></script>
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
        <div class="wrapper">
            <div class="mycontainer">
                <img src="images/Icon/searching.gif" alt="">
                <h3>Looking for available driver</h3>
                <p>Estimated time: 15 Minutes</p>
            </div>
            <div class="chat">
                <img src="images/Icon/chat.png" alt="" title="Message your driver" onclick="showChatBox()">
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
            <img src="images/icon//back.png" alt="" onclick="hideChatBox()">
        </div>
        <div class="container" id="message-container">
            <div class="customer">
                <p>Welcome to CartMart! Feel Free to contact our driver if you have any concerns</p>
            </div>
        </div>
        <div class="textfield">
            <textarea name="" id="message"></textarea>
            <img src="images/icon/send.png" alt="" onclick="sendMessage()">
        </div>
    </div>
    <script>
        var offset = 0;
        var container = document.getElementById('message-container');
        var id = setInterval(function () {
            var xhr = new XMLHttpRequest();
            var param = "offset=" + offset;
            xhr.open('POST', 'php/retrieve_msg.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText != '') {
                        var data = JSON.parse(this.responseText);
                        var output = "<div class='customer'>" +
                            "<p>" + data[0].txtmessage + "</p>" +
                        "</div>";

                        offset += 1;

                        container.scrollTop = container.scrollHeight;

                        document.getElementById('message-container').innerHTML += output;
                    }
                }
            }

            container.scrollTop = container.scrollHeight;
            xhr.send(param);
            
            
        }, 2000)
    </script>
<?php
    get_navigation();
?>
</body>
</html>