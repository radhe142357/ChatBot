<!DOCTYPE html>
<html>
<head>
    <title>Laravel Real-Time Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #messages {
            height: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: scroll;
            margin-bottom: 10px;
        }
        #input-box {
            display: flex;
        }
        #input-box input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
        }
        #input-box button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <h1>Welcome to Laravel Real-Time Chat!</h1>

    <div id="messages"></div>

    <div id="input-box">
        <input type="text" id="message" placeholder="Type your message..." />
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        let ws = new WebSocket('ws://localhost:8080');

        ws.onopen = function() {
            console.log("Connected to chat server");
        };

        ws.onmessage = function(event) {
            const messagesDiv = document.getElementById('messages');
            const message = document.createElement('div');
            message.textContent = event.data;
            messagesDiv.appendChild(message);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        };

        function sendMessage() {
            const input = document.getElementById('message');
            const text = input.value.trim();
            if (text !== '') {
                ws.send(text);
                input.value = '';
            }
        }

        // Optional: Enter key sends message
        document.getElementById('message').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>
