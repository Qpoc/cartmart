function getProductByCategory(category, type) {
    
    window.location = 'category_type.php';

    var xhr = new XMLHttpRequest();
    var param = "category=" + encodeURIComponent(category) + "&type=" + encodeURIComponent(type);
    
    xhr.open('POST', 'category_type.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.send(param);

}

function getProdByCategoryOn(category) {
    
    window.location = 'categories.php';

    var xhr = new XMLHttpRequest();
    var param = "category=" + encodeURIComponent(category);

    xhr.open('POST', 'categories.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.send(param);

}

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
