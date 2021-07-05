function showChatBox() {
    document.getElementById('chatBox').style.display = 'block';
}

function hideChatBox() {
    document.getElementById('chatBox').style.display = 'none';
}

function sendMessage() {
    var message = document.getElementById('message').value;
    
    var xhr = new XMLHttpRequest();
    var param = "message=" + message;

    xhr.open('POST','php/send_msg.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    document.getElementById('message-container').innerHTML += "<div class='rider'>" +
    "<p>" + message + "</p>" +
    "</div>";
    document.getElementById('message').value = "";

    var container = document.getElementById('message-container');
    container.scrollTop = container.scrollHeight;
    
    xhr.send(param);
}