const server = require('http').createServer();
const io = require('socket.io')(server);

io.on('connection', (socket) => {
  console.log('New client connected');

  // Handle incoming messages from clients
  socket.on('message', (data) => {
    // Handle the received message and broadcast it to other clients
    socket.broadcast.emit('message', data);
  });

  // Handle client disconnection
  socket.on('disconnect', () => {
    console.log('Client disconnected');
  });
});

const port = 3000; // Specify the port number for your WebSocket server
server.listen(port, () => {
  console.log(`WebSocket server listening on port ${port}`);
});
