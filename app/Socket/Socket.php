<?php

require __DIR__ . '/../../vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Controllers\WebSocketServer; // Adjust the namespace and file path accordingly

require __DIR__ . '/../Controllers/WebSocketServer.php'; // Adjust the file path accordingly

$websocketServer = new WebSocketServer();

$server = IoServer::factory(
    new HttpServer(
        new WsServer($websocketServer)
    ),
    8081 // Port number for the WebSocket server
);

$server->run();
