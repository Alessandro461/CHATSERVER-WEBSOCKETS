<!DOCTYPE html>
<html>
<head>
    <title>Chat en Tiempo Real</title>
    <style>
    #chat {
        width: 100%;
        height: 400px;
        overflow-y: scroll;
        border: 1px solid #ccc;
    }
    #message {
        width: 80%;
    }
    </style>
</head>
<body>
    <h1>Chat en Tiempo Real</h1>
    <div id="chat"></div>
    <input type="text" id="message" placeholder="Escribe tu mensaje">
    <button id="send">Enviar</button>

    <script>
        var conn = new WebSocket('ws://localhost:8080');
        var chat = document.getElementById('chat');
        var sendButton = document.getElementById('send');
        var messageInput = document.getElementById('message');

        conn.onopen = function(e) {
            chat.innerHTML += '<div>Conexión establecida</div>';
        };

        conn.onmessage = function(e) {
            chat.innerHTML += '<div>' + e.data + '</div>';
            chat.scrollTop = chat.scrollHeight;
        };
        
        sendButton.onclick = function() {
            var msg = messageInput.value;
            conn.send(msg);
            messageInput.value = '';
        };
    </script>
</body>
</html>