<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/status.css">
    <script src="script/utilities.js"></script>
    <title>CartMart</title>
</head>

<body>
    <main>
        <div class="wrapper">
            <div class="header">
                <select name="" id="">
                    <option value="">On the way to Mall</option>
                    <option value="">Shopping</option>
                    <option value="">On the way to destination</option>
                    <option value="">Order delivered</option>
                </select>
                <input type="button" value="UPDATE">
            </div>
            <div class="container">
                <table>
                    <thead>
                        <th>NAME</th>
                        <th>STATUS</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Cyrus C. Patungan</td>
                            <td>On the way to destination <img src="images/icon/chat.png" alt="" onclick="showChatBox()"> <a href="">Cancel</a></td>
                        </tr>
                        <tr>
                            <td>John Cyrus C. Patungan</td>
                            <td>On the way to destination <img src="images/icon/chat.png" alt="" onclick="showChatBox()"> <a href="">Cancel</a></td>
                        </tr>
                        <tr>
                            <td>John Cyrus C. Patungan</td>
                            <td>On the way to destination <img src="images/icon/chat.png" alt="" onclick="showChatBox()"> <a href="">Cancel</a></td>
                        </tr>
                        <tr>
                            <td>John Cyrus C. Patungan</td>
                            <td>On the way to destination <img src="images/icon/chat.png" alt="" onclick="showChatBox()"> <a href="">Cancel</a></td>
                        </tr>
                        <tr>
                            <td>John Cyrus C. Patungan</td>
                            <td>On the way to destination <img src="images/icon/chat.png" alt="" onclick="showChatBox()"> <a href="">Cancel</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        <div class="wrapper">
            <div class="container">
                <div class="nav">
                    <img class="imgactive" name="imgnav" src="images/icon/home.png" alt="">
                    <h3 class="active">HOME</h3>
                </div>
                <div class="nav">
                    <img src="images/icon/incentive.png" name="imgnav" alt="">
                    <h3>INCENTIVES</h3>
                </div>
                <div class="nav">
                    <img src="images/icon/feedback.png" name="imgnav" alt="">
                    <h3>FEEDBACK</h3>
                </div>
            </div>
        </div>
    </footer>
    <div class="wrapper-chat" id="chatBox">
        <div class="back">
            <img src="images/icon//back.png" alt="" onclick="hideChatBox()">
        </div>
        <div class="container" id="message-container">
           
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
    <script>
        var navigation = document.getElementsByTagName("h3");

        for (let index = 0; index < navigation.length; index++) {
            navigation[index].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                var image = document.getElementsByName("imgnav");
                var currentImg = document.getElementsByClassName("imgactive");

                current[0].className = "";
                currentImg[0].className = "";
                image[index].className = "imgactive"
                console.log("OUTPUT : index", index);
                this.className = "active";
            });
        }
    </script>
</body>

</html>