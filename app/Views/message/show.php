<?php

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;
    echo "<h1>" . $title . "<img alt='logo-lessons' class='ms-2 icons-medium' src=" . base_url("assets/images/users/" . $contractor['profilepicture'] . "") . " /></h1>";

    if (isset($messages) && is_array($messages) && count($messages) > 0){
        
        echo '<div id="chat-container">';
        echo '<div id="message-list">';
        echo '</div>';
        echo '<div id="load-more-messages">';
        echo '<button id="load-more-btn" class="btn btn-primary">Load more</button>';
        echo '<div id="input-container">';
        echo '<input type="text" id="message-input" placeholder="' . lang('Common.placeholder_message') . '">';
        echo '<button id="send-button">Send</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    } else {
        echo "<p>".lang('Common.notFound.messages')."</p>";
    }

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
<script>
const socket = new WebSocket('ws://localhost:8081');

socket.addEventListener('open', () => {
    console.log('Connected to WebSocket server');
});

socket.addEventListener('message', (event) => {
    const message = JSON.parse(event.data);
    console.log('Received message:', message);
});

socket.addEventListener('close', () => {
    console.log('Disconnected from WebSocket server');
});

// Sending a message when the button is clicked
const sendButton = document.getElementById('send-button');
sendButton.addEventListener('click', () => {
    const messageInput = document.getElementById('message-input');
    const messageContent = messageInput.value.trim();

    if (messageContent !== "") {
        const message = {
            content: messageContent,
            sender: 'client'
        };
        socket.send(JSON.stringify(message));

        // Clear the input field
        messageInput.value = '';
    }
});



// const messageList = document.getElementById("message-list");
// const loadMoreBtn = document.getElementById("load-more-btn");
// const messageInput = document.getElementById("message-input");
// const sendButton = document.getElementById("send-btn");

// // Function to handle sending a message
// function sendMessage() {
//   const messageContent = messageInput.value.trim();
//   if (messageContent !== "") {
//     // Implement your logic to send the message
//     const newMessage = {
//       content: messageContent,
//       sender: "currentUser" // Replace with your sender identification logic
//     };

//     // Add the new message to your messages array
//     messages.push(newMessage);

//     // Render the messages again
//     renderMessages();

//     // Clear the input field
//     messageInput.value = "";
//   }
// }

// // Event listener for the "Send" button click event
// sendButton.addEventListener("click", sendMessage);

// messageInput.addEventListener("keydown", function(event) {
//   if (event.key === "Enter") {
//     sendMessage();
//   }
// });

// // Function to render messages
// function renderMessages() {
//   messageList.innerHTML = "";

//   // Display a limited number of messages initially
//   const numMessagesToShow = 99999999;
//   const startIndex = Math.max(0, messages.length - numMessagesToShow);

//   for (let i = messages.length - 1; i >= startIndex; i--) {
//     const message = messages[i];

//     console.log(message.idreceiver);

//     const messageElement = document.createElement("div");
//     messageElement.classList.add("message");

//     if (message.idreceiver === sender) {
//       messageElement.classList.add("sender-a");
//     } else {
//       messageElement.classList.add("sender-b");
//     }

//     messageElement.textContent = message.content;
//     messageList.appendChild(messageElement);
//   }

//   // Show or hide the load more button based on the number of messages
//   if (startIndex > 0) {
//     loadMoreBtn.style.display = "block";
//   } else {
//     loadMoreBtn.style.display = "none";
//   }
// }

// // Function to load more messages
// function loadMoreMessages() {
//   // Implement your logic to load more messages
// }

// // Attach event listener to the load more button
// loadMoreBtn.addEventListener("click", loadMoreMessages);

// // Call the renderMessages function to initially display the messages
// renderMessages();
</script>
</html>
