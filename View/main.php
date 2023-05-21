<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>WebSocket Chat</title>
  </head>
  <body>
    <input type="text" id="messageInput" />
    <button onclick="sendMessage()">Enviar</button>

    <ul id="messageList"></ul>
    <?php
    session_start();
    if (isset($_SESSION['user']))
    {
      echo 'connected';
      exec('php C:\xampp\htdocs\websocket-tests2\server.php > /dev/null 2>&1 &');
    }else{
      echo 'Disconected';
    }
    ?>
    <script>
      const socket = new WebSocket('ws://localhost:8080');
      const messageInput = document.getElementById('messageInput');
      const messageList = document.getElementById('messageList');

      socket.onopen = () => {
        console.log('Conexão estabelecida com sucesso.');
      };

      socket.onmessage = (event) => {
        const message = event.data;
        displayMessage(message);
      };

      socket.onclose = (event) => {
        console.log('Conexão fechada com o código:', event.code);
      };

      function sendMessage() {
        const message = messageInput.value;
        socket.send(message);
        messageInput.value = '';
      }

      function displayMessage(message) {
        const li = document.createElement('li');
        li.textContent = message;
        messageList.appendChild(li);
      }
    </script>
  </body>
</html>