<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Chat em PHP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="navChat">
            <h1>Chat em PHP</h1>
            <button onclick="clearChat()">Limpar Chat</button>
                <div class="dropdown-content">
                    <button onclick="clearChat()">Limpar Chat</button>
                </div>
        </div>
        <!-- Chat body -->
        <div class="chatbody">
            <div id="chat-box"></div><br />
        </div>

        <!-- Chat input -->
        <div class="chat-input">
            <!--<input type="text" id="nickname" placeholder="Seu apelido">-->
            <input type="text" id="message" placeholder="Sua mensagem" class="input-send">
            <button onclick="sendMessage()" class="btn-tosend"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send">
                    <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                    <path d="m21.854 2.147-10.94 10.939" />
                </svg></button>
        </div>
    </div>

    <script>
        function sendMessage() {
            var nickname = document.getElementById('nickname').value;
            var message = document.getElementById('message').value;
            if (nickname && message) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'postMessage.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('nickname=' + nickname + '&message=' + message);
                document.getElementById('message').value = '';
            }
        }

        function getMessages() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getMessages.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('chat-box').innerHTML = this.responseText;
                }
            }
            xhr.send();
        }

        function clearChat() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'clearChat.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('chat-box').innerHTML = '';
                }
            }
            xhr.send();
        }

        setInterval(getMessages, 1000);
    </script>
</body>

</html>