<?php

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;
    echo "<h1>" . $title . "<img alt='logo-lessons' class='ms-2 icons-medium' src=" . base_url("assets/images/users/" . $contractor['profilepicture'] . "") . " /></h1>";
        
        echo '<div id="chat-container">';
        echo '<div id="message-list">';
        echo '</div>';
        echo '<div id="message-input-container">';
        echo '<input type="text" id="message-input" placeholder="' . lang('Common.placeholder_message') . '">';
        echo '<button id="send-button">' . lang('Common.chat') . '</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
<script>
const id = <?php 
        if (isset($idcontractor)) {
            echo $idcontractor;
        } else {
            echo $idclient;
        } 
        ?>;
const userId = <?php echo json_encode(session()->get('id')); ?>;

const url = `http://localhost:9000/message/${id}/${userId}`;

// socket.addEventListener('open', () => {
//     console.log('Connected to WebSocket server');
// });

// socket.addEventListener('message', (event) => {
//     const message = JSON.parse(event.data);
//     messages.push(message);
//     renderMessages();

//     if (message.idsender === id) {

//         const data = {
//             content: message.content,
//         };

//     }
// });

// socket.addEventListener('close', () => {
//     console.log('Disconnected from WebSocket server');
// });

// Sending a message when the button is clicked
const sendButton = document.getElementById('send-button');
sendButton.addEventListener('click', () => {
    const messageInput = document.getElementById('message-input');
    const messageContent = messageInput.value.trim();

    if (messageContent !== "") {
        const message = {
            content: messageContent
        };

        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Token': '<?php echo env('API_TOKEN'); ?>'
            },
            body: JSON.stringify(message),
        };

        fetch(url, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.log(error);
            });

        message.idsender = id;
        messages.push(message);
        renderMessages();

        // Clear the input field
        messageInput.value = '';
    }
});

var messages = <?php echo json_encode($messages); ?>;
const messageList = document.getElementById("message-list");
const messageInput = document.getElementById("message-input");
setInterval(getMessages, 1000);

// Function to render messages
function renderMessages() {
  messageList.innerHTML = "";

  // Display a limited number of messages initially
  const numMessagesToShow = 99999999;
  const startIndex = Math.max(0, messages.length - numMessagesToShow);

  for (let i = messages.length - 1; i >= startIndex; i--) {
    const message = messages[i];

    const messageElement = document.createElement("div");
    messageElement.classList.add("message");

    if (message.idsender !== id) {
      messageElement.classList.add("sender-a");
    } else {
      messageElement.classList.add("sender-b");
    }

    messageElement.textContent = message.content;
    messageList.appendChild(messageElement);
  }
}

function formatDate() {
    const currentDate = new Date();

    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');
    const hours = String(currentDate.getHours()).padStart(2, '0');
    const minutes = String(currentDate.getMinutes()).padStart(2, '0');
    const seconds = String(currentDate.getSeconds()).padStart(2, '0');

    const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

    return formattedDate;
}

function getMessages() {
    const options = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Token': '<?php echo env('API_TOKEN'); ?>'
            },
        };

        fetch(url, options)
            .then(response => response.json())
            .then(data => {
                if (data == null) {
                    messages = [{"idmessage":0,"content":"Start to type to chat with the other !","createdat":"2020-01-01 22:22:22","idsender":0,"idreceiver":0}];
                } else {
                    messages = data;
                }
                renderMessages();
            })
            .catch(error => {
                console.log(error);
            });
}

// Call the renderMessages function to initially display the messages
renderMessages();
</script>
</html>
